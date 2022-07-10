@extends('layout.layout')

@section('main')
<div class="page-heading about-heading header-text" style="background-image: url({{ url('images/heading-1-1920x500.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Reset Password</h4>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="best-features about-features">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @if($errors->any())
          @error('success')
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{$message}}
            </button>
          </div>
          @enderror
          @error('fail')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            </button>
          </div>
          @enderror
          @endif
          </div>
        </div>
        <div class="col-md-6" >
            <form action="{{ route('resetHandler') }}" method="POST" style="max-width: 60%;
            padding-bottom: 30px;">
              @csrf
              @if($errors->any())
          @error('fail')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            </button>
          </div>
          @enderror
          @endif
          <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                  <label for="email" class="col-form-label">Email : <em style="color: red">*</em></label>
                  <input type="text" class="form-control" name="email" placeholder="Enter Your Email Adress" value="{{ $email ?? old('email') }}">
                </div>
                @if ($errors->first('email'))
                <div class="error">
                <p>{{$errors->first('email')}}</p>
              </div>
                @endif
                <div class="form-group">
                    <label for="password" class="col-form-label">New Password: <em style="color: red">*</em></label>
                    <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                  </div>
                  @if ($errors->first('password'))
                  <div class="error">
                  <p>{{$errors->first('password')}}</p>
                </div>
                  @endif
                  <div class="form-group">
                    <label for="password_confirmation" class="col-form-label">Confirm Password : <em style="color: red">*</em></label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Confirm Password">
                  </div>
                <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@stop
