<?php

namespace App\Http\Controllers;

use App\Models\deptEmp;
use Illuminate\Http\Request;

class deptEmpController extends Controller
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

      deptEmp::create($r->all());

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
     * @param  \App\Models\deptEmp  $deptEmp
     * @return \Illuminate\Http\Response
     */
    public function show(deptEmp $deptEmp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\deptEmp  $deptEmp
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

      $temp = deptEmp::findOrFail($id);

      $temp -> empNo = $r -> empNo;
      $temp -> deptNo = $r -> deptNo;
      $temp -> fromDate = $r -> fromDate;
      $temp -> toDate = $r -> toDate;

      $temp -> save();

      return redirect(url()->previous());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\deptEmp  $deptEmp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deptEmp $deptEmp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\deptEmp  $deptEmp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      deptEmp::findOrFail($id) -> delete();

      return redirect(url()->previous());
    }
}
