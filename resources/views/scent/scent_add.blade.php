@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Scent</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('scentad.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="name_scent"
                    placeholder="Enter name" style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('name_scent'))
                <div class="error">
                    <p>{{ $errors->first('name_scent') }}</p>
                </div>
            @endif
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
@stop
