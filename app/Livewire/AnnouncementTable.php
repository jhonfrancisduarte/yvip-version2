<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use Livewire\Component;
use DateTime;
use Illuminate\Support\Facades\Auth;

class AnnouncementTable extends Component
{
    use WithFileUploads;
    public $search;
    #[Rule('required|min:2|max:100')]
    public $title;
    #[Rule('required|min:2|max:1000')]
    public $content;
    #[Rule('required')]
    public $category;
    public $file;
    public $featured_image;
    public $openAddAnnouncementForm;
    public $openEditAnnouncementForm;
    public $deleteAnnouncementId;
    public $editAnnouncementId;
    public $announcementId;
    public $deleteMessage;
    public $disableButton = "No";
    public $popup_message;
    public $dashboardType;
    public $contentIndexes = [];

    public function createAnnouncement(){
        $this->validate();
        $userId = Auth::user()->id;
        $announcement = Announcement::create([
            'user_id' => $userId,
            'title' => $this->title,
            'content' => $this->content,
            'type' => $this->dashboardType,
            'category' => $this->category,
        ]);

        if ($this->file) {
            $filePath = $this->file->storeAs('announcementFiles/files', $this->file->getClientOriginalName(), 'public_uploads');
            $filePath = "uploads/" . $filePath;
            $announcement->update(['attached_file' => $filePath]);
        }
    
        if ($this->featured_image) {
            $imageName = uniqid() . '.' . $this->featured_image->getClientOriginalExtension();
            $imagePath = $this->featured_image->storeAs('announcementFiles/images', $imageName, 'public_uploads');
            $imagePath = "uploads/" . $imagePath;
            $announcement->update(['featured_image' => $imagePath]);
        }

        $this->reset();
        $this->popup_message = null;
        $this->popup_message = "Announcement created successfully";    
    }

    public function render(){
        if($this->dashboardType == "yv"){
            $announcements = Announcement::join('users', 'announcement.user_id', '=', 'users.id')
                ->leftJoin('admin', 'users.id', '=', 'admin.user_id')
                ->where('announcement.type', $this->dashboardType)
                ->select('announcement.*', 'admin.first_name', 'admin.last_name', 'admin.middle_name', 'admin.profile_picture')
                ->search(trim($this->search))
                ->orderBy('announcement.created_at', 'desc')
                ->get();
        }else{
            $announcements = Announcement::join('users', 'announcement.user_id', '=', 'users.id')
                ->leftJoin('admin', 'users.id', '=', 'admin.user_id')
                ->select('announcement.*', 'admin.first_name', 'admin.last_name', 'admin.middle_name', 'admin.profile_picture')
                ->search(trim($this->search))
                ->orderBy('announcement.created_at', 'desc')
                ->get();
        }

        if (empty($this->contentIndexes)) {
            foreach ($announcements as $announcement) {
                $this->contentIndexes[$announcement->id] = false;
            }
        }

        $announcements->transform(function ($announcement) {
            $currentTime = now();
            $announcementTime = $announcement->created_at;
            $difference = $currentTime->diffInSeconds($announcementTime);
            if ($difference < 60) {
                $announcement->formatted_created_at = $difference . ' seconds ago';
            } elseif ($difference < 3600) {
                $minutes = floor($difference / 60);
                $announcement->formatted_created_at = $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
            } elseif ($difference < 86400) {
                $hours = floor($difference / 3600);
                if ($hours >= 1 && $hours < 2) {
                    $announcement->formatted_created_at = '1 hour ago';
                } else {
                    $hoursDifference = round($hours);
                    $announcement->formatted_created_at = $hoursDifference . ' hours ago';
                }
            } else {
                $announcement->formatted_created_at = $announcementTime->format('d F Y');
            }
            return $announcement;
        });

        return view('livewire.announcement-table', [
            'announcements' => $announcements,
        ]);
    }

    public function toggleContent($announcementId){
        $this->contentIndexes[$announcementId] = !$this->contentIndexes[$announcementId];
    }

    public function openAddForm(){
        $this->openAddAnnouncementForm = true;
    }

    public function openEditForm($annsId){
        $this->openEditAnnouncementForm = Announcement::find($annsId);
        $this->openEditAnnouncementForm =  $this->openEditAnnouncementForm->getAttributes();
        $this->title = $this->openEditAnnouncementForm['title'];
        $this->content = $this->openEditAnnouncementForm['content'];
        $this->category = $this->openEditAnnouncementForm['category'];
        $this->editAnnouncementId = $annsId;
    }

    public function editAnnouncement(){
        if($this->editAnnouncementId){
            $this->validate();
            $userId = Auth::user()->id;
            $announcement = Announcement::find($this->editAnnouncementId);
            if ($announcement){
                $announcement->update([
                    'user_id' => $userId,
                    'title' => $this->title,
                    'content' => $this->content,
                    'category' => $this->category,
                ]);

                if ($this->file){
                    $filePath = $this->file->storeAs('announcementFiles/files', $this->file->getClientOriginalName(), 'public_uploads');
                    $filePath = "uploads/" . $filePath;
                    $announcement->update(['attached_file' => $filePath]);
                }
            
                if ($this->featured_image){
                    $imageName = uniqid() . '.' . $this->featured_image->getClientOriginalExtension();
                    $imagePath = $this->featured_image->storeAs('announcementFiles/images', $imageName, 'public_uploads');
                    $imagePath = "uploads/" . $imagePath;
                    $announcement->update(['featured_image' => $imagePath]);
                }
                $this->popup_message = null;
                $this->popup_message = 'Announcement edited successfully.';
                $this->openEditAnnouncementForm = null;
                $this->editAnnouncementId = null;
                $this->file = null;
                $this->featured_image = null;
            }else{
                $this->popup_message = null;
                $this->popup_message = 'Announcement edit unsuccessfully.';
                $this->openEditAnnouncementForm = null;
                $this->editAnnouncementId = null;
                $this->file = null;
                $this->featured_image = null;
            }
        }
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function closeAddForm(){
        $this->openAddAnnouncementForm = null;
        $this->title = null;
        $this->category = null;
        $this->content = null;
    }
    public function closeEditForm(){
        $this->openEditAnnouncementForm = null;
        $this->title = null;
        $this->category = null;
        $this->content = null;
    }

    public function deleteDialog($annsId){
        $this->deleteAnnouncementId = $annsId;
    }

    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteAnnouncementId = null;
        $this->disableButton = "No";
    }

    public function deleteAnnouncement(){
        if($this->deleteAnnouncementId){
            $announcement = Announcement::find($this->deleteAnnouncementId);
            if ($announcement){
                $announcement->delete();
                $this->deleteMessage = 'Announcement deleted successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Announcement deletion unsuccessfully.';
                $this->disableButton = "Yes";
            }
        }
    }
}
