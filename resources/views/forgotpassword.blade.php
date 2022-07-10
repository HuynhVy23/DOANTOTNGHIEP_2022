@extends('layout.layout')

@section('main')
<div class="page-heading about-heading header-text" style="background-image: url({{ url('images/heading-1-1920x500.jpg') }});">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Forgot Password</h4>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="best-features about-features">
    <div class="container">
      <div class="row">
        {{-- <div class="col-md-12">
          <div class="section-heading"style="margin-bottom: 15px;">
            <h2>Forgot Password</h2>
          </div>
        </div> --}}
        <div class="col-md-12">
          @error('success')
          <div class="alert alert-success alert-dismissible fade show" role="alert" id="success">
            {{$message}}
          </div>
          @enderror
      </div>
        <div class="col-md-6" >
            <form action="{{ route('forgotHandler') }}" method="POST" style="max-width: 60%;
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
                <div class="form-group">
                  <label for="email" class="col-form-label">Email : <em style="color: red">*</em></label>
                  <input type="text" class="form-control" name="email" placeholder="Enter Your Email Adress" value="{{ old('email') }}">
                </div>
                @if ($errors->first('email'))
                <div class="error">
                <p>{{$errors->first('email')}}</p>
              </div>
                @endif
                <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Send Password Link</button>
            </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@stop
