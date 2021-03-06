@extends('layout.layout')

@section('main')
<div class="page-heading about-heading header-text" style="background-image: url({{ url('images/heading-1-1920x500.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Login</h4>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="best-features about-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Form Login</h2>
          </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('handlelogin') }}" method="POST">
              @csrf
              @if($errors->any())
          @error('fail')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            </button>
          </div>
          @enderror
          @endif
                <div class="form-group">
                  <label for="username" class="col-form-label">Username: <em style="color: red">*</em></label>
                  <input type="text" class="form-control" name="username" placeholder="Enter Username">
                </div>
                @if ($errors->first('username'))
                <div class="error">
                <p>{{$errors->first('username')}}</p>
              </div>
                @endif
                <div class="form-group">
                  <label for="password" class="col-form-label">Password: <em style="color: red">*</em></label><a href="{{ route('forgotpassword') }}" style="padding-left: 50%;">Forgot Password?</a>
                  <input type="password" class="form-control" name="password" placeholder="Enter Password" >
                </div>
                @if ($errors->first('password'))
                <div class="error">
                <p>{{$errors->first('password')}}</p>
              </div>
                @endif
                <div style="text-align: center;">
                <p>Do not have an account? <a href="{{ route('account.create') }}"> Register</a></p></div>
                <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@stop
