<?php

namespace App\Http\Controllers;

use App\Models\deptManager;
use Illuminate\Http\Request;

class deptManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $r)
    {
      $r->validate([
        'empNo' => 'required',
        'deptNo' => 'required',
        'fromDate' => 'date',
        'toDate' => 'date|nullable',
      ]);

      deptManager::create($r->all());

      return redirect(url()->previous());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\deptManager  $deptManager
     * @return \Illuminate\Http\Response
     */
    public function show(deptManager $deptManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deptManager  $deptManager
     * @return \Illuminate\Http\Response
     */
    public function edit($id, request $r)
    {
      $r->validate([
        'empNo' => 'required',
        'deptNo' => 'required',
        'fromDate' => 'date',
        'toDate' => 'date|nullable',
      ]);

      $temp = deptManager::findOrFail($id);

      $temp -> empNo = $r->empNo;
      $temp -> deptNo = $r->deptNo;
      $temp -> fromDate = $r->fromDate;
      $temp -> toDate = $r->toDate;

      $temp -> save();

      return redirect(url()->previous());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\deptManager  $deptManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deptManager $deptManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deptManager  $deptManager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        deptManager::findOrFail($id) -> delete(); 

        return redirect(url()->previous());
    }
}
