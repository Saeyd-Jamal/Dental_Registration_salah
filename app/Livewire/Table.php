<?php

namespace App\Livewire;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Livewire\Component;

class Table extends Component
{
    public $records;
    public $doctors;

    public $day;
    public $doctor_id = '';
    public $payment_type = '';


    public function mount($records, $doctors){

        $this->records = $records;
        $this->doctors = $doctors;

        $this->day = Carbon::now()->format('Y-m-d');
    }

    public function filterPaymentType(){
        if($this->payment_type != '') {
            if($this->doctor_id != '') {
                $this->records = Record::where('payment_type', $this->payment_type)->where('doctor_id', '=', $this->doctor_id)->where('date_rec', $this->day)->orderBy('doctor_id')->get();
            }else{
                $this->records = Record::where('payment_type', $this->payment_type)->where('date_rec', $this->day)->orderBy('doctor_id')->get();
            }
        }else{
            if($this->doctor_id != '') {
                $this->records = Record::where('doctor_id', '=', $this->doctor_id)->where('date_rec', $this->day)->orderBy('doctor_id')->get();
            }else{
                $this->records = Record::where('date_rec', $this->day)->get();
            }
        }
    }

    public function filterDoctor(){
        if($this->doctor_id != '') {
            $this->records = Record::where('doctor_id', '=', $this->doctor_id)->where('date_rec', $this->day)->orderBy('doctor_id')->get();
        }else{
            $this->records = Record::where('date_rec', $this->day)->orderBy('doctor_id')->get();
        }
    }
    public function filterDay(){

        if(Auth::user()->type != 'doctor') {
            if($this->doctor_id != '') {
                $this->records = Record::where('doctor_id', '=', $this->doctor_id)->where('date_rec', $this->day)->orderBy('doctor_id')->get();
            }else{
                $this->records = Record::where('date_rec', $this->day)->orderBy('doctor_id')->get();
            }
        }else{
            $this->records = Record::where('date_rec', $this->day)->where('doctor_id', Auth::user()->id)->orderBy('doctor_id')->get();
        }
    }

    public function filterName($name){


        if(Auth::user()->type != 'doctor') {
            $this->records = Record::where('patient_name', 'LIKE', '%'.$name.'%')->orderBy('doctor_id')->get();
            if($name == '') {
                $this->records = Record::where('date_rec', $this->day)->orderBy('doctor_id')->get();
            }
        }else{
            $this->records = Record::where('patient_name', 'LIKE', '%'.$name.'%')->where('doctor_id', Auth::user()->id)->orderBy('doctor_id')->get();
            if($name == '') {
                $this->records = Record::where('date_rec', $this->day)->where('doctor_id', Auth::user()->id)->orderBy('doctor_id')->get();
            }
        }
    }

    public function render()
    {
        return view('livewire.table');
    }
}
