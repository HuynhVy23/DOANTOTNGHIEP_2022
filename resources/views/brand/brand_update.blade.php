@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Update Brand</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('brand.update', $lstBrand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name" class="col-form-label">Name: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="name_brand" value="{{ $lstBrand->name_brand }}"
                        placeholder="Enter name" style="text-align: left; border-style:groove">
                </div>
                @if ($errors->first('name_brand'))
                    <div class="error">
                        <p>{{ $errors->first('name_brand') }}</p>
                    </div>
                @endif
                <div class="form-group">
                    <label for="detail" class="col-form-label">Detail: <em style="color: red">*</em></label>
                    <input type="text" class="form-control" name="detail" value="{{ $lstBrand->detail }}"
                        placeholder="Enter detail" style="text-align: left; border-style:groove">
                </div>
                @if ($errors->first('detail'))
                    <div class="error">
                        <p>{{ $errors->first('detail') }}</p>
                    </div>
                @endif
                <label for="file">Image : </label>
                <input type="file" name="image_brand" id="file" />
                <div style="text-align: center">
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>

        <div class="card">
            <img src="{{ $lstBrand->image_brand }}" width="500px" height="500px">
        </div>
    </div>
@stop
