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
    public $deleteAnnouncementId;
    public $announcementId;
    public $deleteMessage;
    public $disableButton = "No";

    public function createAnnouncement(){
        $this->validate();
        $type = "yv";
        $userId = Auth::user()->id;
        $announcement = Announcement::create([
            'user_id' => $userId,
            'title' => $this->title,
            'content' => $this->content,
            'type' => $type,
            'category' => $this->category,
        ]);

        if ($this->file) {
            $filePath = $this->file->storeAs('uploads/announcementFiles/files', $this->file->getClientOriginalName(), 'public_uploads');
            $announcement->update(['attached_file' => $filePath]);
        }
    
        if ($this->featured_image) {
            $imageName = uniqid() . '.' . $this->featured_image->getClientOriginalExtension();
            $imagePath = $this->featured_image->storeAs('uploads/announcementFiles/images', $imageName, 'public_uploads');
            $announcement->update(['featured_image' => $imagePath]);
        }

        $this->reset();
        session()->flash('success', 'Announcement created successfully');    
    }

    public function render(){
        $announcements = Announcement::join('users', 'announcement.user_id', '=', 'users.id')
            ->leftJoin('admin', 'users.id', '=', 'admin.user_id')
            ->where('announcement.type', 'yv')
            ->select('announcement.*', 'admin.first_name', 'admin.last_name', 'admin.middle_name', 'admin.profile_picture')
            ->search(trim($this->search))
            ->orderBy('announcement.created_at', 'asc')
            ->get();
        $announcements->transform(function ($announcement) {
            $dateString = $announcement->created_at;
            $date = new DateTime($dateString);
            $announcement->formatted_created_at = $date->format('d F Y');
            return $announcement;
        });

        return view('livewire.announcement-table', compact('announcements'));
    }

    public function openAddForm(){
        $this->openAddAnnouncementForm = true;
    }

    public function closeAddForm(){
        $this->openAddAnnouncementForm = null;
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
            $this->deleteAnnouncementId = null;
        }
    }

}
