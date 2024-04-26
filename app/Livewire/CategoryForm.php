<?php

namespace App\Livewire;

use App\Models\VolunteerSkills;
use App\Models\VolunteerCategory;
use App\Models\Volunteer;
use App\Models\Skills;
use App\Models\Categories;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class CategoryForm extends Component
{
    public $skills;
    public $selectedSkills = [];
    public $experience;
    public $addSkillForm;
    public $addExperience;
    public $popup_message;
    public $ruleForExp;
    public $selectedSkillIds = [];
    public $editId;
    public $editContent;
    public $actionForm;

    public function openActionForm(){
        if($this->actionForm){
            $this->actionForm = null;
        }else{
            $this->actionForm = true;
        }
    }

    public function closeActionForm()
    {
        $this->actionForm = null;
    }

    public function openAddSkillForm($userId)
    {
        $this->addSkillForm = true;
    }

    public function closeAddSkillForm()
    {
        $this->addSkillForm = null;
    }

    public function openExperienceForm($userId)
    {
        $this->addExperience = true;
    }

    public function closeExperienceForm()
    {
        $this->addExperience = null;
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function mount()
    {
        $this->skills = Skills::all();
        $user = Auth::user();
        $selectedSkillNames = VolunteerSkills::where('user_id', $user->id)->pluck('skill_name')->first();

        if ($selectedSkillNames) {
            $selectedSkillNamesArray = explode(',', $selectedSkillNames);
            $this->selectedSkillIds = Skills::whereIn('all_skills_name', $selectedSkillNamesArray)->pluck('id')->toArray();
        }

        $this->initializeSelectedSkillIds();
        $this->selectedSkills = $this->selectedSkillIds;
    }

    public function submit()
    {
        $user = Auth::user();

        if (!empty($this->selectedSkillIds)) {
            $categoryIds = Skills::whereIn('id', $this->selectedSkillIds)->pluck('category_id')->unique();
            $categoryNames = Categories::whereIn('id', $categoryIds)->pluck('all_categories_name')->toArray();
            $concatenatedCategoryNames = implode(', ', $categoryNames);
            VolunteerCategory::updateOrCreate(
                ['user_id' => $user->id],
                ['category_name' => $concatenatedCategoryNames]
            );

            $selectedSkillNames = Skills::whereIn('id', $this->selectedSkillIds)->pluck('all_skills_name')->toArray();
            $concatenatedSkillNames = implode(', ', $selectedSkillNames);
            VolunteerSkills::updateOrCreate(
                ['user_id' => $user->id],
                ['skill_name' => $concatenatedSkillNames]
            );
        } else {
            VolunteerSkills::where('user_id', $user->id)->delete();
        }

        $this->storeSelectedSkillIds();
        $this->popup_message = null;
        $this->popup_message = "Skills added successfully.";
        $this->addSkillForm = null;
    }

    public function render()
    {
        $user = Auth::user();
        $selectedSkillNames = VolunteerSkills::where('user_id', $user->id)->pluck('skill_name')->first();
        $selectedSkillNamesArray = $selectedSkillNames ? explode(',', $selectedSkillNames) : [];
        $userCategories = VolunteerCategory::where('user_id', $user->id)->pluck('category_name')->first();
        $volunteerExperiences = Volunteer::where('user_id', Auth::id())->get();

        return view('livewire.forms.category-form', [
            'selectedSkillNames' => $selectedSkillNamesArray,
            'userCategories' => $userCategories,
            'volunteerExperiences' => $volunteerExperiences,
        ]);
    }

    protected function initializeSelectedSkillIds()
    {
        $userId = Auth::id();
        $this->selectedSkillIds = Cache::get("user_{$userId}_selected_skill_ids", []);
    }

    protected function storeSelectedSkillIds()
    {
        $userId = Auth::id();
        Cache::put("user_{$userId}_selected_skill_ids", $this->selectedSkillIds);
    }

    public function updatedSelectedSkillIds($value)
    {
        $this->storeSelectedSkillIds();
    }

    public function addExp()
    {
        $user = Auth::user();

        $this->validate();

        Volunteer::create([
            'user_id' => $user->id,
            'volunteer_experience' => $this->experience,
        ]);

        $this->experience = '';
        $this->addExperience = null;
        $this->popup_message = null;
        $this->popup_message = "Experience added successfully.";
    }
    
    public function rules()
    {
        return [
            'experience' => ['required', 'min:2'],
        ];
    }

    public function editExpForm($id)
    {
        // $this->edit = true;
        $this->editId = $id;
        $this->editContent = Volunteer::find($id)->volunteer_experience;
    }

    public function updateExp()
    {
        $this->validate([
            'editContent' => ['required', 'min:5'],
        ]);
    
        $experience = Volunteer::find($this->editId);
        $experience->volunteer_experience = $this->editContent;
        $experience->save();
    
        $this->editId = null;
        $this->editContent = '';
    
        $this->popup_message = "Experience updated successfully.";
    }

    public function closeEditExpForm()
    {
        $this->editId = null;
    }
}
