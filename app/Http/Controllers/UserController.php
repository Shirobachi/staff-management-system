<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $r)
    {
      $user = user::where('login', $r->login) -> first();

      if($user && Hash::check($r->password, $user->password)){
          session()->put('userID', $user->id);
          return redirect(url(env('DASHBOARD', 'dashboard')));
      }
      else{
          $info['desc'] = __('auth.loginNo');
          $info['type'] = 'danger';

          return view('login', compact('info'));
      }
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $r)
    {
      $r -> validate([
          'login' => "min:3|max:15|required|unique:users",
          'e-mail' => "email:rfc,dns|unique:users",
          'password'  => 'min:6|max:50',
          'password2' => 'same:password'
      ]);
  
      $temp = $r -> all();
      $temp['password'] = Hash::make($r->password);
      unset($temp['password2']);
  
      user::create($temp);
  
      $info['desc'] = __('auth.registerOk');
  
      return(view('login', compact('info')));
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
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
