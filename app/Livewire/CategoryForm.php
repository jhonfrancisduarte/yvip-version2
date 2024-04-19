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

class CategoryForm extends Component
{
    public $skills;
    public $selectedSkills = [];
    public $experience;

    public function mount()
    {
        // Fetch skills data for checkboxes
        $this->skills = Skills::all();
    }

    public function submit()
    {
        // Get the currently authenticated user
        $user = Auth::user();
    
        // Fetch selected skill names directly without IDs
        $selectedSkillIds = $this->selectedSkills;
    
        // Fetch category IDs associated with the selected skills
        $categoryIds = Skills::whereIn('id', $selectedSkillIds)->pluck('category_id')->unique();
    
        // Fetch category names from the all_categories table
        $categoryNames = Categories::whereIn('id', $categoryIds)->pluck('all_categories_name')->toArray();
    
        // Concatenate category names into a single string
        $concatenatedCategoryNames = implode(', ', $categoryNames);
    
        // Store concatenated category names in the volunteer_categories table
        VolunteerCategory::updateOrCreate(
            ['user_id' => $user->id],
            ['category_name' => $concatenatedCategoryNames]
        );

        $selectedSkillNames = Skills::whereIn('id', $this->selectedSkills)->pluck('all_skills_name')->toArray();
    
        // Check if a record for the user already exists
        $existingRecord = VolunteerSkills::where('user_id', $user->id)->first();
    
        // Prepare data for update or create
        $data = [
            'skill_name' => implode(', ', $selectedSkillNames),
            // You can add other fields if needed
        ];

        Volunteer::create([
            'user_id' => $user->id,
            'volunteer_experience' => $this->experience,
        ]);
    
        // Fetch the selected skills again after submission
        $this->selectedSkills = VolunteerSkills::where('user_id', $user->id)->pluck('skill_name')->toArray();
    
        // Clear selected skills after submission
        $this->selectedSkills = [];
    
        // Redirect or perform any other actions after submission
        return redirect()->route('my-category');
    }

    public function render()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch the selected skills for the user
        $selectedSkillNames = VolunteerSkills::where('user_id', $user->id)->pluck('skill_name')->toArray();
        $userCategories = VolunteerCategory::where('user_id', $user->id)->pluck('category_name')->first();
        $volunteerExperiences = Volunteer::where('user_id', Auth::id())->get();


        return view('livewire.forms.category-form', [
            'selectedSkillNames' => $selectedSkillNames,
            'userCategories' => $userCategories,
            'volunteerExperiences' => $volunteerExperiences,
        ]);
    }

    public function updateCategoryDescription()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Store the volunteer experience in the volunteers table
        Volunteer::create([
            'user_id' => $user->id,
            'volunteer_experience' => $this->experience,
        ]);

        // Reset the experience input field
        $this->experience = '';

        // Redirect or perform any other actions after submission
       return redirect()->route('my-category');
    }
}
