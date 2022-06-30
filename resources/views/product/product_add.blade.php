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
                <label for="name" class="col-form-label">Name: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="name" placeholder="Enter name"
                    style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('name'))
                <div class="error">
                    <p>{{ $errors->first('name') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="concentration" class="col-form-label">Concentration: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="concentration" placeholder="Enter concentration"
                    style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('concentration'))
                <div class="error">
                    <p>{{ $errors->first('concentration') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="description" class="col-form-label">Description: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="description" placeholder="Enter description"
                    style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('description'))
                <div class="error">
                    <p>{{ $errors->first('description') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="model" class="col-form-label">Brand: <em style="color: red">*</em></label>
                <select name="brand_id">
                    <option value="" style="text-align: center">--Select brand--</option>
                    @foreach ($lstBrand as $item)
                        <option value="{{ $item->id }}">{{ $item->name_brand }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('brand_id'))
                <div class="error">
                    <p>{{ $errors->first('brand_id') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="model" class="col-form-label">Scent: <em style="color: red">*</em></label>
                <select name="scent_id">
                    <option value="" style="text-align: center">--Select scent--</option>
                    @foreach ($lstScent as $item)
                        <option value="{{ $item->id }}">{{ $item->name_scent }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('scent_id'))
                <div class="error">
                    <p>{{ $errors->first('scent_id') }}</p>
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
