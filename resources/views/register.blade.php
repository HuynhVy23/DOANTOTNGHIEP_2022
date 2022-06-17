@extends('layout.layout')

@section('main')
<div class="page-heading about-heading header-text" style="background-image: url(../images/heading-1-1920x500.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Register</h4>
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
            <h2>Form Register</h2>
          </div>
        </div>
       @if (isset($success))
       <h2 style="color: #f33f3f">You have successfully registered an account</h2>
       @endif
        <div class="col-md-6">
            <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
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
                    <label for="email" class="col-form-label">Email: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="email" placeholder="Enter Email" >
                  </div>
                  @if ($errors->first('email'))
                  <div class="error">
                  <p>{{$errors->first('email')}}</p>
                </div>
                  @endif
                <div class="form-group">
                  <label for="password" class="col-form-label">Password: <em style="color: red">*</em></label>
                  <input type="password" class="form-control" name="password" placeholder="Enter Password" >
                </div>
                @if ($errors->first('password'))
                <div class="error">
                <p>{{$errors->first('password')}}</p>
              </div>
                @endif
                <div class="form-group">
                    <label for="password_confirmation" class="col-form-label">Password Confirmation: <em style="color: red">*</em></label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter password" >
                  </div>
                  <div class="form-group">
                    <label for="address" class="col-form-label">Address: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="address" placeholder="Enter address" >
                  </div>
                  @if ($errors->first('address'))
                  <div class="error">
                  <p>{{$errors->first('address')}}</p>
                </div>
                  @endif
                  <div class="form-group">
                    <label for="address" class="col-form-label">Birthday:</label>
                    <input type="date" class="form-control" name="birthday" value="2010-12-31" min="1930-01-01" max="2010-12-31">
                  </div>
                  <div class="form-group">
                    <label for="phone" class="col-form-label">Phone: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="phone" onkeypress='return event.charCode>=48 && event.charCode<=57'>
                  </div>
                  @if ($errors->first('phone'))
                  <div class="error">
                  <p>{{$errors->first('phone')}}</p>
                </div>
                  @endif
                  <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                      <input type="radio" class="form-check-input" id="radio1" name="gender" value="0" checked>Male
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                      <input type="radio" class="form-check-input" id="radio2" name="gender" value="1">Female
                    </label>
                  </div>
                  <div class="form-group">
                    <label for="avatar" class="col-form-label">Avatar:</label>
                    <input type="file" class="form-control" name="avatar">
                  </div>
                <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@stop
