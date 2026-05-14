<?php

namespace App\Livewire\User;

use App\Models\Attendance as ModelsAttendance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Attendance extends Component

{
   public $status;


   public function render()
    {
        $attendance = ModelsAttendance::all();
        return view('livewire.user.attendance', compact('attendance'));
    }

    public function save(){
        $this->validate([
            'status'=>'required'
        ]);
        
        ModelsAttendance::create([
            'user_id'=> Auth::user()->id,
            'date'=>now()->toDateString(),
            'status'=>$this->status

        ]);
        session()->flash('message','berhasil tambah attendance');
    }
}
