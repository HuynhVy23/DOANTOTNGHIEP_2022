@extends('layout.layout')

@section('main')
<div class="page-heading about-heading header-text" style="background-image: url(../images/heading-1-1920x500.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Change Password</h4>
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
            <h2>Form Change Password</h2>
          </div>
          @if (isset($success))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Well done!</strong> You have successfully updated your information.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       @endif
        </div>
        <div class="col-md-6">
            <form action="{{ route('changepassform') }}" method="POST">
              @csrf
              <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                  <label for="username" class="col-form-label">Current password :<em style="color: red">*</em></label>
                  <input type="password" class="form-control" name="password">
                </div>
                @if ($errors->first('password'))
                <div class="error">
                <p>{{$errors->first('password')}}</p>
              </div>
                @endif
                <div class="form-group">
                  <label for="newpassword" class="col-form-label">New password : <em style="color: red">*</em></label>
                  <input type="password" class="form-control" name="newpassword">
                </div>
                @if ($errors->first('newpassword'))
                <div class="error">
                <p>{{$errors->first('newpassword')}}</p>
              </div>
                @endif
                <div class="form-group">
                    <label for="newpassword" class="col-form-label">Confirm password : <em style="color: red">*</em></label>
                    <input type="password" class="form-control" name="newpassword_confirmation">
                  </div>
                <div style="password-align: center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@stop
