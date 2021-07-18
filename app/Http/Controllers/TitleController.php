<?php

namespace App\Http\Controllers;

use App\Models\title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TitleController extends Controller
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
        'title' => 'min:3|max:50',
        'fromDate' => 'date',
        'toDate' => 'date|nullable'
      ]);

      title::create($r->all());

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
     * @param  \App\Models\title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(title $title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\title  $title
     * @return \Illuminate\Http\Response
     */
    public function edit($title, $date, request $r)
    {
      $r->validate([
        'empNo' => 'required',
        'title' => 'min:3|max:50',
        'fromDate' => 'date',
        'toDate' => 'date|nullable'
      ]);

      if( $r->toDate)
        $r->toDate = "toDate = '" . $r -> toDate . "'";
      else    
        $r->toDate = "toDate = null";

      // because primary key contain from two column I didn't know how to do that with save(). I am more than happy to get it to know
      DB::statement(
        "UPDATE titles 
          SET empNo = '$r->empNo',
              title = '$r->title',
              fromDate = '$r->fromDate',
              $r->toDate,
              updated_at = CURRENT_TIMESTAMP()
          
          WHERE title = '$title' 
            AND fromDate = '$date'"
      );

      return redirect(url()->previous());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy($title, $date)
    {
      // I don't how to (if possible) do it by ::find / ::findOrFail
      title::where([['title', $title], ['fromDate', $date]]) -> delete();

      return redirect(url()->previous());
    }
}
