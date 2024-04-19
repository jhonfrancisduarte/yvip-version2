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

class CategoryForm extends Component
{
    public $skills;
    public $selectedSkills = [];
    #[Rules\Min(5)]
    public $experience;
    public $addSkillForm;
    public $editExperience;
    public $popup_message;
    public $ruleForExp;

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
        $this->editExperience = true;
    }

    public function closeExperienceForm()
    {
        $this->editExperience = null;
    }

    public function closePopup(){
        $this->popup_message = null;
    }

    public function mount()
    {
        $this->skills = Skills::all();
    }

    public function submit()
    {
        $user = Auth::user();
    
        $selectedSkillIds = $this->selectedSkills;
        $categoryIds = Skills::whereIn('id', $selectedSkillIds)->pluck('category_id')->unique();
        $categoryNames = Categories::whereIn('id', $categoryIds)->pluck('all_categories_name')->toArray();
        $concatenatedCategoryNames = implode(', ', $categoryNames);
    
        VolunteerCategory::updateOrCreate(
            ['user_id' => $user->id],
            ['category_name' => $concatenatedCategoryNames]
        );

        $selectedSkillNames = Skills::whereIn('id', $selectedSkillIds)->pluck('all_skills_name')->toArray();
        $concatenatedSkillNames = implode(', ', $selectedSkillNames);

        VolunteerSkills::updateOrCreate(
            ['user_id' => $user->id],
            ['skill_name' => $concatenatedSkillNames]
        );
        $this->selectedSkills = VolunteerSkills::where('user_id', $user->id)->pluck('skill_name')->toArray();
    
        $this->popup_message = null;
        $this->popup_message = "Skills added successfully.";
        $this->addSkillForm = null;
    }

    public function render()
    {
        $user = Auth::user();

        $selectedSkillNames = VolunteerSkills::where('user_id', $user->id)->pluck('skill_name')->first();
        $selectedSkillNamesArray = explode(', ', $selectedSkillNames);
        $userCategories = VolunteerCategory::where('user_id', $user->id)->pluck('category_name')->first();
        $volunteerExperiences = Volunteer::where('user_id', Auth::id())->get();

        return view('livewire.forms.category-form', [
            'selectedSkillNames' => $selectedSkillNamesArray,
            'userCategories' => $userCategories,
            'volunteerExperiences' => $volunteerExperiences,
        ]);
    }

    public function updateCategoryDescription()
    {
        $user = Auth::user();

        $this->validate();

        Volunteer::create([
            'user_id' => $user->id,
            'volunteer_experience' => $this->experience,
        ]);

        $this->experience = '';
        $this->editExperience = null;
        $this->popup_message = null;
        $this->popup_message = "Experience added successfully.";
    }
    
    public function rules()
    {
        return [
            'experience' => ['required', 'min:5'],
        ];
    }
}
