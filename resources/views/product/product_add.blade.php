@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add New Perfume Model</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('productad.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="col-form-label">Name: </label><br>
                <input type="text" class="form-control" name="name" placeholder="Enter name"
                    style="text-align: left; border-style:groove; width: 200px ">
            </div>
            @if ($errors->first('name'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('name') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="concentration" class="col-form-label">Concentration: </label><br>
                <input type="text" class="form-control" name="concentration" placeholder="Enter concentration"
                    style="text-align: left; border-style:groove;width: 200px">
            </div>
            @if ($errors->first('concentration'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('concentration') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="description" class="col-form-label">Description: </label><br>
                <input type="text" class="form-control" name="description" placeholder="Enter description"
                    style="text-align: left; border-style:groove;width: 200px">
            </div>
            @if ($errors->first('description'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('description') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="model" class="col-form-label">Gender: </label><br>
                <select class="custom-select" style="width: 200px" name="gender">
                    <option value="" style="text-align: center">--Select gender--</option>
                    <option value="0" style="text-align: center">Male</option>
                    <option value="1" style="text-align: center">Female</option>
                    <option value="2" style="text-align: center">Unisex</option>
                </select>
            </div>
            @if ($errors->first('gender'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('gender') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="model" class="col-form-label">Brand: </label><br>
                <select class="custom-select" style="width: 200px" name="brand_id">
                    <option value="" style="text-align: center">--Select brand--</option>
                    @foreach ($lstBrand as $item)
                        <option value="{{ $item->id }}">{{ $item->name_brand }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('brand_id'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('brand_id') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="model" class="col-form-label">Scent: </label><br>
                <select class="custom-select" style="width: 200px" name="scent_id">
                    <option value="" style="text-align: center">--Select scent--</option>
                    @foreach ($lstScent as $item)
                        <option value="{{ $item->id }}">{{ $item->name_scent }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('scent_id'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('scent_id') }}</p>
                </div>
            @endif
            <label for="file">Image : </label>
            <input type="file" name="image" id="file" />
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
@stop
