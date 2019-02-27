@extends('layouts.sidebar')
@section('content')
    <div class="d-flex justify-content-center">
        <form action="/ApiRegister" method="post" class="col-8 mt-4 pt-3" style="background-color: rgba(255,255,255,0.1); height: 100%;">
            @csrf
            <div class="form-group">
                <label class="text-input-label">User name</label>
                <input name="userName" type="text" class="form-control text-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User name">
            </div>
            <div class="form-group">
                <label class="text-input-label">Email address</label>
                <input name="email" type="email" class="form-control text-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@mail.com">
            </div>
            <div class="form-group">
                <label class="text-input-label">Password</label>
                <input name="password" type="password" class="form-control text-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="••••••••••••••">
            </div>
            <div class="form-group">
                <label class="text-input-label">Confirm Password</label>
                <input type="password" class="form-control text-input" id="exampleInputPassword1" placeholder="••••••••••••••">
            </div>
            <div class="row d-flex justify-content-center pt-3">
                <button type="submit" class="btn btn-primary red-btn col-6 mr-4 mb-5">Sign up</button>
                <button type="reset" class="btn btn-secondary light-btn col-4 ml-4">Reset</button>
            </div>

        </form>
    </div>
@stop
