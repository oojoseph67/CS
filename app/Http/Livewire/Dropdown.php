<?php

namespace App\Http\Livewire;

use App\Models\College;
use App\Models\Department;
use Livewire\Component;

class Dropdown extends Component
{
    public $selectedCollege = null;
    public $selectedDepartment = null;
    //public $department = null;


    public function render()
    {
        return view('livewire.dropdown', [
            'college' => College::all()
        ]);
    }

    public function updatedSelectedCollege($college_id)
    {
        return view('livewire.dropdown', [
            'department' =>  Department::where('college_id', $college_id)->get()
        ]);
       // $department = Department::where('college_id', $college_id)->get();
    }
}
