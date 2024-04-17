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
        return view('livewire.forms.category-form');
    }

    public function submit()
    {
        $categoriesString = implode(', ', $this->getSelectedCategories());
        $skillsString = implode(', ', $this->selectedSkills);

        $user = Auth::user();

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


    public function updateVolunteerExperience()
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

        $this->selectedSkills = Session::get('selectedSkills', []);

        $this->experience = $user->volunteer->volunteer_experience;
    }
}
