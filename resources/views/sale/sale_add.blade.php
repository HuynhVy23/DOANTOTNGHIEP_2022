@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Sale</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('salead.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name: </label><br>
                <input type="text" class="form-control" name="name" placeholder="Enter name"
                    style="text-align: left; border-style:groove; width:200px">
            </div>
            @if ($errors->first('name'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('name') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="date" class="col-form-label">Date Start:</label>
                <input type="date" class="form-control" name="date_start" value="2022-01-01" min="2022-01-01" style="border-style:groove; width:200px">
            </div>
            @if ($errors->first('date_start'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('date_start') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="date" class="col-form-label">Date End:</label>
                <input type="date" class="form-control" name="date_end" value="2022-01-01" min="2022-01-01" style="border-style:groove; width:200px">
            </div>
            @if ($errors->first('date_end'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('date_end') }}</p>
                </div>
            @endif

            <label for="file">Image : </label>
            <input type="file" name="image_banner" id="file" />
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>

@stop
