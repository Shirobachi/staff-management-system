<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\deptEmp;
use App\Models\department;
use App\Models\salary;
use Illuminate\Http\Request;
use DB;

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
      $data = salary::where('empNo', $id)-> get();
      
      // change field to still apply if to date is null (mean still apply)
      foreach ($data as $value)
        if(!$value->toDate)
          $value->toDate = __('salaries.now');

      // get employee' name and title
      $employee = DB::table('employees')
      -> where('employees.id', $id)
      -> leftJoin('titles', 'titles.empNo', 'employees.id')
      -> orderBy('fromDate', 'desc')
      -> limit(1)
      -> select('firstName', 'lastName', 'title')
      -> first();

      // get employee dept code
      $empDept = deptEmp::where('empNo', $id) -> orderBy('fromDate', 'desc') -> first();

      // if dept code exist (employee has assign dept) get dept name
      if($empDept)
        $dept = department::where('deptNo', $empDept -> deptNo) 
                            -> first() 
                            -> deptName;
          
      // specify header depended by has or not title and dept
      if(isset($employee->title) && isset($dept))
        $header = $employee -> firstName . " " . $employee -> lastName. ', ' . $employee -> title . " " . __('employees.at') . " " . $dept;
      else if(!isset($employee->title) && isset($dept))
        $header = $employee -> firstName . " " . $employee -> lastName. ', ' . __('employees.empOf') . " " . $dept;
      else if(isset($employee->title) && !isset($dept))
        $header = $employee -> title . " " . $employee -> firstName . " " . $employee -> lastName;
      else
        $header = $employee -> firstName . " " . $employee -> lastName;

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
    
      $html = \View::make('dashboard.exportEmp') -> with('data', $data);
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
