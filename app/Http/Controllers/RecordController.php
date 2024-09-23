<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Record::where('date_rec', Carbon::now()->format('Y-m-d'))->orderBy('doctor_id')->get();

        $doctors = User::where('type', 'doctor')->get();

        if(Auth::user()->type == 'doctor') {
            $records = Record::where('date_rec', Carbon::now()->format('Y-m-d'))->where('doctor_id', Auth::user()->id)->orderBy('doctor_id')->get();
            $doctors = User::where('type', 'doctor')->where('id', Auth::user()->id)->get();
        }


        return view('index', compact('records', 'doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $last_record = Record::where('date_rec', $request->date_rec)->where('doctor_id', $request->doctor_id)->latest()->first();

        $num_rec = $request->num_rec;

        if($last_record != null) {
            if(($last_record->num_rec + 1) != $num_rec) {
                return redirect()->route('records.index')->with('danger', 'رقم الحجز غير صحيح');
            }
        }

        if($request->type == 'مراجعة') {
            $request->merge([
                'payment_type' => 'مجاني'
            ]);
        }
        $request->merge([
            'user_id' => $request->user()->id
        ]);

        Record::create($request->all());

        return redirect()->route('records.index')->with('success', 'تم إضافة حجز جديد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Record $record)
    {
        if($request->user()->type == 'doctor') {
            return redirect()->route('records.index')->with('danger', 'لا يمكن حذف الحجز');
        }
        $record->delete();
        return redirect()->route('records.index')->with('success', 'تم حذف الحجز');
    }


    public function print(Request $request) {

        $records  = $request->records;
        $records = json_decode($records, true);
        $day = $request->day;
        $pdf = PDF::loadView('report',['records' =>  $records, 'day' => $day],[],
        [
            'mode' => 'utf-8',
            'default_font_size' => 12,
            'default_font' => 'Arial',
        ]);
        return $pdf->stream();
    }

    public function printMali(Request $request) {
        $records = Record::whereBetween('date_rec', [$request->from_date, $request->to_date])->get();

        $days = Record::whereBetween('date_rec', [$request->from_date, $request->to_date])
        ->distinct()
        ->pluck('date_rec');

        $pdf = PDF::loadView('reportMali',['records' =>  $records, 'days' => $days, 'from_date' => $request->from_date, 'to_date' => $request->to_date],[],
        [
            'mode' => 'utf-8',
            'default_font_size' => 12,
            'default_font' => 'Arial',
        ]);
        return $pdf->stream();
    }

}
