@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Brand</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name: </label><br>
                <input type="text" class="form-control" name="name_brand" placeholder="Enter name"
                    style="text-align: left; border-style:groove;width:200px">
            </div>
            @if ($errors->first('name_brand'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('name_brand') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="detail" class="col-form-label">Detail: </label><br>
                <input type="text" class="form-control" name="detail" placeholder="Enter detail"
                    style="text-align: left; border-style:groove;width:400px" >
            </div>
            @if ($errors->first('detail'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('detail') }}</p>
                </div>
            @endif
            <label for="file">Image : </label>
            <input type="file" name="image_brand" id="file" />
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>

@stop
