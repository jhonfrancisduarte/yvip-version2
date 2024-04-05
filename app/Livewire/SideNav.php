<?php

namespace App\Livewire;
use Livewire\Component;

class SideNav extends Component
{
    public $selectedNavItem = 'announcements';

    public function selectNavItem($navItem){
        $this->selectedNavItem = $navItem;
        // $this->emit('navItemSelected', $navItem);
    }

    public function render(){
        return view('livewire.side-nav', ['selectedNavItem' => $this->selectedNavItem]);
    }
}
