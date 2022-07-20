@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Update Perfume</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('product_detail.update', $productDetail->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="capacity" class="col-form-label">Capacity: </label><br>
                <input type="text" class="form-control" name="capacity" value="{{ $productDetail->capacity }}"
                    placeholder="Enter capacity" style="text-align: left; border-style:groove;width: 200px">
            </div>
            @if ($errors->first('capacity'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('capacity') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="price" class="col-form-label">Price: </label><br>
                <input type="number" class="form-control" name="price" value="{{ $productDetail->price }}"
                    placeholder="Enter price" style="text-align: left; border-style:groove;width: 200px">
            </div>
            @if ($errors->first('price'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('price') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="stock" class="col-form-label">Stock: </label><br>
                <input type="number" class="form-control" name="stock" value="{{ $productDetail->stock }}"
                    placeholder="Enter stock" style="text-align: left; border-style:groove;width: 200px">
            </div>
            @if ($errors->first('stock'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('stock') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="model" class="col-form-label">Model: </label><br>
                <select class="custom-select" style="width: 200px;border-style:groove" name="product_id">
                    @foreach ($lstProduct as $item)
                        <option value="{{ $item->id }}" @if ($item->id == $productDetail->product_id) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('product_id'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('product_id') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="status" class="col-form-label">Status: </label><br>
                <input type="text" class="form-control" name="status" value="{{ $productDetail->status }}" placeholder="Enter status"
                    style="text-align: left;width: 200px;border-style:groove" readonly>
            </div>
            @if ($errors->first('status'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('status') }}</p>
                </div>
            @endif
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
@stop
