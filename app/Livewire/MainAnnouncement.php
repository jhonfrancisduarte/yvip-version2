<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;

class MainAnnouncement extends Component
{
    use WithPagination;
    public $contentIndexes = [];
    public $perPageCount = 10;

    public function render(){
        $announcements = Announcement::join('users', 'announcement.user_id', '=', 'users.id')
            ->leftJoin('admin', 'users.id', '=', 'admin.user_id')
            ->select('announcement.*', 'admin.first_name', 'admin.last_name', 'admin.middle_name', 'admin.profile_picture')
            ->orderBy('announcement.created_at', 'desc')
            ->take($this->perPageCount)
            ->get();

        $totalAnnouncements = Announcement::count();

        if (empty($this->contentIndexes) || count($this->contentIndexes) !== count($announcements)) {
            $this->contentIndexes = [];
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

        return view('livewire.main-announcement', [
            'announcements' => $announcements,
            'totalAnnouncements' => $totalAnnouncements,
        ]);
    }

    public function load(){
        $this->perPageCount += 10;
    }

    public function toggleContent($announcementId){
        $this->contentIndexes[$announcementId] = !$this->contentIndexes[$announcementId];
    }

}
