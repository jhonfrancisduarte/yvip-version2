<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Categories;
use App\Models\Skills;
use Exception;
use Livewire\Attributes\Rule;

class SkillsAndCategoriesTable extends Component
{
    public $deleteSkillsandCategories;
    public $openEditSkillsAndCategories;
    public $openAddSkillsAndCategories;
    public $popup_message;
    public $search;
    public $skills;
    #[Rule('required|min:2')]
    public $category_name;
    #[Rule('required|min:2')]
    public $description;
    #[Rule('required|min:2')]
    public $newSkills = [''];
    public $editCategoryId;
    public $deleteCategoryId;
    public $deleteMessage;
    public $disableButton = "No";

    public function addSkill(){
        $this->newSkills[] = '';
    }

    public function removeSkill($index){
        unset($this->newSkills[$index]);
    }


    public function mount(){
        $this->skills = Skills::all();
    }

    public function render(){
        $categories = Categories::with('all_skills')
                    ->whereNotIn('id', [1])
                    ->search(trim($this->search))
                    ->get();

        return view('livewire.tables.skills-and-categories-table', [
            'categories' => $categories,
        ]);
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function openAddForm(){
        $this->openAddSkillsAndCategories = true;
    }

    public function closeAddForm(){
        $this->openAddSkillsAndCategories = null;
        $this->newSkills = [''];
        $this->category_name = null;
        $this->description = null;
    }

    public function createCategory(){
        try{
            $category = Categories::create([
                'all_categories_name' => $this->category_name,
                'description' => $this->description,
            ]);

            foreach ($this->newSkills as $skillName) {
                $category->all_skills()->create([
                    'all_skills_name' => $skillName,
                ]);
            }
            $this->popup_message = null;
            $this->popup_message = "Category and skills added successfully.";
        }catch(Exception $e){
            throw $e;
        }
    }

    public function editCategory(){
        $category = Categories::find($this->editCategoryId);
        if($category){
            $category->update([
                'all_categories_name' => $this->category_name,
                'description' => $this->description,
            ]);
    
            $category->all_skills()->delete();

            foreach ($this->newSkills as $skillName) {
                $category->all_skills()->create([
                    'all_skills_name' => $skillName,
                ]);
            }
            $this->openEditSkillsAndCategories = null;
            $this->editCategoryId = null;
            $this->popup_message = null;
            $this->popup_message = "Category and skills updated successfully.";
        }
    }
    

    public function openEditForm($catId){
        $this->openEditSkillsAndCategories = true;
        $category = Categories::find($catId);
        if($category){
            $this->category_name = $category->all_categories_name;
            $this->description = $category->description;
            $this->newSkills = $category->all_skills()->pluck('all_skills_name')->toArray();
            $this->editCategoryId = $catId;
        }
    }

    public function closeEditForm(){
        $this->openEditSkillsAndCategories = null;
        $this->editCategoryId = null;
        $this->newSkills = [''];
        $this->category_name = null;
        $this->description = null;
    }

    public function deleteDialog($catId){
        $this->deleteCategoryId = $catId;
    }

    public function hideDeleteDialog(){
        $this->deleteMessage = null;
        $this->deleteCategoryId = null;
        $this->newSkills = [''];
        $this->disableButton = "No";
        $this->category_name = null;
        $this->description = null;
    }

    public function deleteCategory(){
        if($this->deleteCategoryId){
            $category = Categories::find($this->deleteCategoryId);
            if ($category){
                $category->delete();
                $this->deleteMessage = 'Category and skills deleted successfully.';
                $this->disableButton = "Yes";
            }else{
                $this->deleteMessage = 'Category and skills deletion unsuccessfully.';
                $this->disableButton = "Yes";
            }
        }
    }
}
