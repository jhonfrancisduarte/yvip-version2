<?php

namespace App\Livewire;

use App\Models\VolunteerSkills;
use App\Models\VolunteerCategory;
use App\Models\Volunteer;
use App\Models\Skills;
use App\Models\Categories;
use App\Models\VolunteerExperience;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryForm extends Component
{
    public $skills;
    public $selectedSkills = [];
    public $nature_of_event;
    public $participation;
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
        //$this->selectedSkillIds = [];
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

    public function submit(){
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
        $volunteerExperiences = VolunteerExperience::where('user_id', Auth::id())->get();
        $allSkills = Skills::all();

        $selectedSkillsWithCategories = DB::table('all_skills')
            ->whereIn('all_skills.id', $this->selectedSkillIds)
            ->join('all_categories', 'all_skills.category_id', '=', 'all_categories.id')
            ->select('all_skills.*', 'all_categories.all_categories_name')
            ->get();

        $groupedSkills = $selectedSkillsWithCategories->groupBy('all_categories_name');

        return view('livewire.forms.category-form', [
            'selectedSkillNames' => $selectedSkillNamesArray,
            'groupedSkills' => $groupedSkills,
            'userCategories' => $userCategories,
            'volunteerExperiences' => $volunteerExperiences,
            'allSkills' => $allSkills,
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
        try{
            $user = Auth::user();
            $this->validate([
                'nature_of_event' => ['required', 'min:5'],
                'participation' => ['required', 'min:5'],
            ]);
    
            VolunteerExperience::create([
                'user_id' => $user->id,
                'nature_of_event' => $this->nature_of_event,
                'participation' => $this->participation,
            ]);
    
            $this->nature_of_event = null;
            $this->participation = null;
            $this->addExperience = null;
            $this->popup_message = null;
            $this->popup_message = "Experience added successfully.";
        }catch(Exception $e){
            throw $e;
        }
    }
    
    public function rules()
    {
        return [
            'experience' => ['required', 'min:2'],
        ];
    }

    public function editExpForm($id){
        try{
            $exp = VolunteerExperience::find($id);
            if($exp){
                $this->editId = $id;
                $this->nature_of_event = $exp->nature_of_event;
                $this->participation = $exp->participation;
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function updateExp(){
        try{
            $this->validate([
                'nature_of_event' => ['required', 'min:5'],
                'participation' => ['required', 'min:5'],
            ]);
        
            $experience = VolunteerExperience::find($this->editId);
            if($experience){
                $experience->update([
                    'nature_of_event' => $this->nature_of_event,
                    'participation' => $this->participation,
                ]);
    
                $this->editId = null;
                $this->editContent = null;
                $this->popup_message = "Experience updated successfully.";
            }else{
                $this->editId = null;
                $this->editContent = null;
                $this->popup_message = "Experience update unsuccessfully.";
            }

        }catch(Exception $e){
            throw $e;
        }
    }

    public function closeEditExpForm()
    {
        $this->editId = null;
    }
}
