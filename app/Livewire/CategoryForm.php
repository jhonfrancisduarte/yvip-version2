<?php

namespace App\Livewire;

use App\Models\VolunteerSkills;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\VolunteerCategory;
use Illuminate\Support\Facades\Auth;

class CategoryForm extends Component
{
    public $categories = [
        'Support' => ['Encoding/Typing', 'Printing', 'Photocopying of Documents'],
        'Logistics' => ['Ushers', 'Program Runners', 'Physical Set-Up', 'Cleaning', 'Maintenance', 'Marshalls', 'Photo Documentation', 'Packing of Relief Goods'],
        'Management' => ['Organizer/Partner', 'Organization', 'Disaster Relief', 'Mobilization'],
        'Highly Technical' => ['Artists', 'Educators', 'Performers', 'Hosting', 'Medical Practitioners', 'Expert Resource', 'Speakers', 'Paramedics']
    ];

    public $categoriesData;
    public $selectedSkills = [];
    public $selectedCategories = [];
    public $description;
    public $experience;
    //public $selectedSkillsByCategory = [];

    public function render()
    {
        $this->selectedSkills = Session::get('selectedSkills', []);
        return view('livewire.forms.category-form');
    }

    // public function submit()
    // {
    //     $categoriesString = implode(', ', $this->getSelectedCategories());
    //     $skillsString = implode(', ', $this->selectedSkills);

    //     // Retrieve the authenticated user
    //     $user = Auth::user();

    //     // Retrieve the associated category record for the authenticated user
    //     $existingCategory = $user->volunteerCategory;

    //     if ($existingCategory) {
    //         // If a category record exists, update it with the new category
    //         $existingCategory->update([
    //             'category_name' => $categoriesString,
    //             // Update other fields as needed
    //         ]);
    //     } else {
    //         // If no category record exists, create a new one
    //         $user->volunteerCategory()->create([
    //             'category_name' => $categoriesString,
    //             // Add other fields as needed
    //         ]);
    //     }

    //     // Save the selected skills to the database
    //     $existingSkills = $user->volunteer_skills;

    //     if ($existingSkills) {
    //         // If skills records exist, update them with the new set of skills
    //         $existingSkills->each(function ($skill) use ($skillsString) {
    //             $skill->update([
    //                 'skill_name' => $skillsString,
    //                 // Add other fields as needed
    //             ]);
    //         });
    //     } else {
    //         // If no skills records exist, create a new one
    //         $user->volunteer_skills()->create([
    //             'user_id' => $user->id, // Associate the skill with the current user
    //             'skill_name' => $skillsString,
    //             // Add other fields as needed
    //         ]);
    //     }

    //     // Remain the selected skills after the form submission
    //     Session::put('selectedSkills', $this->selectedSkills);

    //     return redirect()->route('my-category');
    // }

    public function submit()
    {
        $categoriesString = implode(', ', $this->getSelectedCategories());
        $skillsString = implode(', ', $this->selectedSkills);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Update or create the category record for the authenticated user
        $user->volunteerCategory()->updateOrCreate(
            ['user_id' => $user->id],
            ['category_name' => $categoriesString]
        );

        // Update or create the skills record for the authenticated user
        $user->volunteer_skills()->updateOrCreate(
            ['user_id' => $user->id],
            ['skill_name' => $skillsString]
        );

        // Remain the selected skills after the form submission
        Session::put('selectedSkills', $this->selectedSkills);

        return redirect()->route('my-category');
    }


    public function updateCategoryDescription()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Update the volunteer_experience column
        $user->volunteer->update([
            'volunteer_experience' => $this->experience,
        ]);

        // Update the session variable
        Session::put('experience', $this->experience);

        // Redirect back to category dashboard
        return redirect()->route('my-category');
    }

    private function getSelectedCategories()
    {
        $selectedCategories = [];

        foreach ($this->categories as $category => $skills) {
            $categorySelected = false;

            foreach ($this->selectedSkills as $selectedSkill) {
                if (in_array($selectedSkill, $skills)) {
                    $categorySelected = true;
                    break;
                }
            }

            if ($categorySelected) {
                $selectedCategories[] = $category;
            }
        }

        if (empty($selectedCategories)) {
            $selectedCategories[] = 'No category selected';
        }

        return $selectedCategories;
    }

    public function mount()
    {
        // Retrieve categories data associated with the authenticated user
        $user = Auth::user();
        $this->categoriesData = $user->volunteerCategory()->get();

        $this->experience = $user->volunteer->volunteer_experience;
    }
}
