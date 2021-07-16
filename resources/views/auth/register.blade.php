@extends('common')

@section('title', 'Log in!')

@section('content')

    <div class="row">
        <div class="offset-md-4 col-md-4 col-10 offset-1 mt-5">
            <form method="POST" action="{{url('register')}}">
                @csrf
                <input required name="login" type="text" placeholder="{{__('auth.loginPlaceholder')}}" class="form-control mb-3">
                <input required name="e-mail" type="email" placeholder="{{__('auth.mailPlaceholder')}}" class="form-control mb-3">
                <input required name="password" type="password" placeholder="{{__('auth.passwordPlaceholder')}}" class="form-control mb-3">
                <input required name="password2" type="password" placeholder="{{__('auth.rePasswordPlaceholder')}}" class="form-control mb-3">
                <button type="submit" class="btn btn-primary input-block-level form-control">{{__('auth.register')}}</button>
                <a class="link-success" href="{{url('/')}}">{{__('auth.login')}}</a>
            </form>
        </div>
    </div>

@endsection