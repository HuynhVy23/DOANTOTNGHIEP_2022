@extends('layout.layout')

@section('main')
<div class="page-heading about-heading header-text" style="background-image: url({{ url('images/heading-6-1920x500.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Personal information</h4>
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
            <h2>Personal information</h2>
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
            <form action="{{ route('handleupdateuser') }}" method="POST" enctype="multipart/form-data">
              @csrf   
              <input type="hidden"  name="id" value="{{ $user->id }}">
                <div class="form-group">
                  <label for="username" class="col-form-label">Username: </label>
                  <input type="text" class="form-control" name="username" value="{{ $user->username }}" readonly>
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email: </label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="address" class="col-form-label">Address: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="address" value="{{ $user->address }}" >
                  </div>
                  @if ($errors->first('address'))
                  <div class="error">
                  <p>{{$errors->first('address')}}</p>
                </div>
                  @endif
                  <div class="form-group">
                    <label for="address" class="col-form-label">Birthday:</label>
                    <input type="date" class="form-control" name="birthday" value="{{ $user->birthday }}" min="1930-01-01" max="2010-12-31">
                  </div>
                  <div class="form-group">
                    <label for="phone" class="col-form-label">Phone: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" onkeypress='return event.charCode>=48 && event.charCode<=57'>
                  </div>
                  @if ($errors->first('phone'))
                  <div class="error">
                  <p>{{$errors->first('phone')}}</p>
                </div>
                  @endif
                  <div class="form-group">
                    <label for="address" class="col-form-label">Gender:</label><br>
                  <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                      <input type="radio" class="form-check-input" id="radio1" name="gender" value="0" @if ($user->gender==0)checked
                      @endif>Male
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                      <input type="radio" class="form-check-input" id="radio2" name="gender" value="1"@if ($user->gender==1)checked
                      @endif>Female
                    </label>
                  </div>
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
        <div class="col-md-6" style="text-align: center">
            <img src="{{ $user->avatar }}" alt=""  style="width:300px;height:300px">
        </div>
      </div>
    </div>
  </div>
@stop
