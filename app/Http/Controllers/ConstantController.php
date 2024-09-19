<?php

namespace App\Http\Controllers;

use App\Models\Constant;
use Illuminate\Http\Request;

class ConstantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $constants = Constant::get();
        return view('constants', compact('constants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Constant::updateOrCreate([
            'key' => 'num_saher',
        ],[
            'value' => $request->num_saher
        ]);
        Constant::updateOrCreate([
            'key' => 'num_in_saher',
        ],[
            'value' => $request->num_in_saher
        ]);
        Constant::updateOrCreate([
            'key' => 'num_dodo',
        ],[
            'value' => $request->num_dodo
        ]);
        Constant::updateOrCreate([
            'key' => 'num_in_dodo',
        ],[
            'value' => $request->num_in_dodo
        ]);
        return redirect()->route('constants.index')->with('success', 'تم تعديل البيانات بنجاح');
    }


}
