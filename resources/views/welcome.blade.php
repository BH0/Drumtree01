<!-- Turn this page into "Sign-in/up" --> 
@extends('layouts.master') 

@section('title') 
    Drumtree 
@endsection 


@section('content') 

    <div class="container"> 
        <div class="row"> 
            <div class="col-md-12"> 
                <form action="{{ route('signup') }}" method="post"> 
                    <b>Please use a username and password more than 8 characters long</b> 
                    <br /> 
                    <input type="email" name="email" placeholder="email"/> 
                    <input type="text" name="username" placeholder="username"/> 
                    <input type="password" name="password" placeholder="password" /> 
                    <input type="password" name="password-confirmation" placeholder="confirm your password"/> 
                    <input type="submit" value="Signup" 
                        class="btn btn-primary"
                    /> 
                    <input type="hidden" name="_token" value="{{ Session::token() }}" /> 
                </form> 

                <form action="{{ route('signin') }}" method="post"> 
                    <input type="text" name="email" placeholder="email or username"/> 
                    <input type="password" name="password" placeholder="password" />         
                    <input type="submit" value="Signin" 
                        class="btn btn-success"
                    /> 
                    <input type="hidden" name="_token" value="{{ Session::token() }}" /> 
                </form> 
            </div> 
        </div> 
    </div> 

@endsection 