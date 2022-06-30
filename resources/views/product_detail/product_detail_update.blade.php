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
                <label for="capacity" class="col-form-label">Capacity: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="capacity" value="{{ $productDetail->capacity }}"
                    placeholder="Enter capacity" style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('capacity'))
                <div class="error">
                    <p>{{ $errors->first('capacity') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="price" class="col-form-label">Price: <em style="color: red">*</em></label>
                <input type="number" class="form-control" name="price" value="{{ $productDetail->price }}"
                    placeholder="Enter price" style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('price'))
                <div class="error">
                    <p>{{ $errors->first('price') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="stock" class="col-form-label">Stock: <em style="color: red">*</em></label>
                <input type="number" class="form-control" name="stock" value="{{ $productDetail->stock }}"
                    placeholder="Enter stock" style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('stock'))
                <div class="error">
                    <p>{{ $errors->first('stock') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="model" class="col-form-label">Model: <em style="color: red">*</em></label>
                <select name="product_id">
                    @foreach ($lstProduct as $item)
                        <option value="{{ $item->id }}" @if ($item->id == $productDetail->product_id) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('product_id'))
                <div class="error">
                    <p>{{ $errors->first('product_id') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label for="status" class="col-form-label">Status: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="status" value="{{ $productDetail->status }}" placeholder="Enter status"
                    style="text-align: left">
            </div>
            @if ($errors->first('status'))
                <div class="error">
                    <p>{{ $errors->first('status') }}</p>
                </div>
            @endif
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
@stop
