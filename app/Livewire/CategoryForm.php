<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\VolunteerCategory;

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

    public function render()
    {
        $this->selectedSkills = Session::get('selectedSkills', []);
        return view('livewire.forms.category-form');
    }

    public function submit()
    {
        $categoriesString = implode(', ', $this->getSelectedCategories());

        // Check if there is an existing record
        $existingCategory = VolunteerCategory::first();

        if ($existingCategory) {
            // Update the existing record
            $existingCategory->update([
                'category_name' => $categoriesString,
                // Update other fields as needed
            ]);
        } else {
            // Create a new record
            VolunteerCategory::create([
                'category_name' => $categoriesString,
                // Add other fields as needed
            ]);
        }

        // Remain the selectedskills after the form submission
        Session::put('selectedSkills', $this->selectedSkills);
        
        return redirect()->route('my-category');
    }

    public function updateCategoryDescription()
    {
        // Find the existing category record
        $existingCategory = VolunteerCategory::first();

        // Update the description column
        if ($existingCategory) {
            $existingCategory->update([
                'description' => $this->description,
            ]);
        }

        Session::put('description', $this->description);
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
        // Retrieve all categories data from the database
        $this->categoriesData = VolunteerCategory::all();

        $this->description = Session::get('description', '');
    }
}
