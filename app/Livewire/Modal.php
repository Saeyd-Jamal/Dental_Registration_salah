<?php

namespace App\Livewire;

use App\Models\Constant;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Modal extends Component
{

    public $num_saher;
    public $num_dodo;

    public $num_in_saher;
    public $num_in_dodo;


    public $date_rec;
    public $num_rec;
    public $doctors;

    public $type;
    public $doctor_id = '';


    public function filterDay()
    {
        $day = Carbon::parse($this->date_rec);
        $this->filterDoctor($day);
    }
    public function filterDoctor($day = null)
    {

        $date = $day != null ? $this->date_rec : Carbon::now()->addDay();

        // تحقق إذا كان اليوم التالي هو يوم الجمعة
        $date = Carbon::parse($date)->copy();
        if ($date->isFriday()) {
            $date = Carbon::parse($date)->addDay()->format('Y-m-d');
        }else{
            $date = Carbon::parse($date)->format('Y-m-d');
        }

        $records_count = Record::where('date_rec', $date)->where('doctor_id', $this->doctor_id)->count();

        if($this->doctor_id == 2) {
            $count = $this->num_saher;
        }
        if($this->doctor_id == 3) {
            $count = $this->num_dodo;
        }
        if(isset($count)){
            while($records_count >= $count) {
                $date = Carbon::parse($date)->addDay()->format('Y-m-d');
                $records_count = Record::where('date_rec', $date)->where('doctor_id', $this->doctor_id)->count();
            }
        }


        if($this->type == "مراجعة"){
            $records_count = Record::where('date_rec', $date)->where('doctor_id', $this->doctor_id)->where('type', 'مراجعة')->count();

            if($this->doctor_id == 2) {
                $count = $this->num_in_saher;
            }
            if($this->doctor_id == 3) {
                $count = $this->num_in_dodo;
            }

            if(isset($count)){
                while($records_count >= $count) {
                    $date = Carbon::parse($date)->addDay()->format('Y-m-d');
                    $records_count = Record::where
                    ('date_rec', $date)->where('doctor_id', $this->doctor_id)->where('type', 'مراجعة')->count();
                }
            }
        }


        $last_record = Record::where('date_rec', $date)->where('doctor_id', $this->doctor_id)->latest()->first();

        $num_rec = $last_record != null ? ($last_record->num_rec ?? 0) + 1 : 1;



        $this->num_rec = $num_rec;
        $this->date_rec = $date;
    }

    public function mount(){

        $this->date_rec = Carbon::now()->addDay()->format('Y-m-d');

        $this->num_saher = Constant::where('key', 'num_saher')->first()->value;
        $this->num_dodo = Constant::where('key', 'num_dodo')->first()->value;

        $this->num_in_saher = Constant::where('key', 'num_in_saher')->first()->value;
        $this->num_in_dodo = Constant::where('key', 'num_in_dodo')->first()->value;

        $doctors = User::where('type', 'doctor')->get();

        $user = Auth::user();

        if($user->type == 'doctor') {
            $this->type = "مراجعة";
            $this->doctor_id = $user->id;
            $this->filterDoctor();
        }else{
            $this->type = "كشفية";
        }

        $this->doctors = $doctors;

    }
    public function render()
    {
        return view('livewire.modal');
    }
}
