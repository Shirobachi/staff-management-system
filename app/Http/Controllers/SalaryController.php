<?php

namespace App\Http\Controllers;

use App\Models\salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
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
        'salary' => 'integer|min:1',
        'fromDate' => 'date',
        'toDate' => 'date|nullable'
      ]);

      salary::create($r->all());

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
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit($date, request $r)
    {
      $r->validate([
        'empNo' => 'required',
        'salary' => 'integer|min:1',
        'fromDate' => 'date',
        'toDate' => 'date|nullable'
      ]);

      $temp = salary::find($date);

      $temp -> empNo = $r->empNo;
      $temp -> salary = $r->salary;
      $temp -> fromDate = $r->fromDate;
      $temp -> toDate = $r->toDate;

      $temp -> save();

      return redirect(url()->previous());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($date)
    {
      salary::findOrFail($date)->delete();

      return redirect(url()->previous());
    }
}
