@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Good Receipt</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="model" class="col-form-label">Product Model: <em style="color: red">*</em></label>
                <select class="form-control" name="product_id" id="idproduct" style="border-style:groove" onchange="hidecapacity({{ $pddt }})">
                    <option value="" style="text-align: center">--Select product--</option>
                    @foreach ($pd as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <p style="opacity: 0;display:none;">{{ $pddt }}</p>
            </div>
            @if ($errors->first('product_id'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('product_id') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="model" class="col-form-label">Capacity: <em style="color: red">*</em></label>
                <select id="capacity" name="capacity" style="border-style:groove" >
                </select>
            </div>

            <div class="form-group">
                <label for="price" class="col-form-label">Price: <em style="color: red">*</em></label>
                <input type="text" class="form-control" name="price" placeholder="Enter price"
                    style="text-align: left; border-style:groove">
            </div>
            @if ($errors->first('price'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('price') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="quantity" class="col-form-label">Quantity: <em style="color: red">*</em></label>
                <input type="number" class="form-control" name="quantity"  style="text-align: left; border-style:groove"
                    placeholder="Enter quantity">
            </div>
            @if ($errors->first('quantity'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('quantity') }}</p>
                </div>
            @endif

            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>
@stop
