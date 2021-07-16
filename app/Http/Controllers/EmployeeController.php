<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        'birthDate' => 'date',
        'firstName' => 'min:3|max:14',
        'lastName' => 'min:3|max:16',
        'gender' => 'in:M,F',
        'hireDate' => 'date'
      ]);

      employee::create($r->all());

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
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id, request $r)
    {
      $r->validate([
        'birthDate' => 'date',
        'firstName' => 'min:3|max:14',
        'lastName' => 'min:3|max:16',
        'gender' => 'in:M,F',
        'hireDate' => 'date'
      ]);

      $temp = employee::findOrFail($id);

      $temp -> birthDate = $r->birthDate;
      $temp -> firstName = $r->firstName;
      $temp -> lastName = $r->lastName;
      $temp -> gender = $r->gender;
      $temp -> hireDate = $r->hireDate;

      $temp -> save();

      return redirect(url()->previous());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      employee::findOrFail($id)->delete();

      return redirect(url()->previous());
    }
}
