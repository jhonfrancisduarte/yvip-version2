<?php

namespace App\Livewire\Tables;

use Livewire\Component;

class SkillsAndCategoriesTable extends Component
{
    public $deleteSkillsandCategories;
    public $openEditSkillsAndCategories;
    public $openAddSkillsAndCategories;
    public $popup_message;

    public function render(){
        $categories = null;

        return view('livewire.tables.skills-and-categories-table', [
            'categories' => $categories,
        ]);
    }

    public function closePopup(){
        $this->popup_message = null;
    }
}
