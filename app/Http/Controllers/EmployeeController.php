<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\deptEmp;
use App\Models\department;
use App\Models\salary;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index($mode, $id)
    {
      // show or download or #404
      if($mode == 'show')
        $mode = 'I';
      else if($mode == 'download')
        $mode = 'D';
      else
        return abort(404);

      // get salaries
      $data = salary::export($id);
      
      if (count ($data) == 0)
        return abort(404);

      $employee = employee::export($id);

      // specify header depended by has or not title and dept
      $header = $employee -> firstName . " " . $employee -> lastName. ', ' . $employee -> title . " " . __('employees.at') . " " . $employee->deptName;

      // mpdf staff
      $fileName = 'Export.pdf';

      $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 15,
        'margin_bottom' => 20,
        'margin_header' => 10,
        'margin_footer' => 10,
      ]);

      $html = \View::make('exportEmp') -> with('data', $data);
      $html = $html -> render();

      $mpdf -> setHeader('|' . $header . '|{PAGENO}');
      $mpdf -> setFooter('Generate time: ' . now()->format('F j, Y, g:iA'));

      $css = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');

      $mpdf -> WriteHTML($css, 1); // 0 (default) - paste whole html, 1 - parse html and css | More: https://mpdf.github.io/reference/mpdf-functions/writehtml.html
    
      $mpdf -> WriteHTML($html, 2);
      $mpdf -> Output($fileName, $mode); // I - Show PDF; D - Download PDF 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
      //
    }
}
