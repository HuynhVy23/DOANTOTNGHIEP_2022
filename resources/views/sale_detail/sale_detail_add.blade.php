@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add Promotion Detail</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="col-md-6">
        <form action="{{ route('sale_detailad.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="model" class="col-form-label">Promotion: <em style="color: red">*</em></label>
                <select name="sale_id">
                    <option value="" style="text-align: center">--Select promotion--</option>
                    @foreach ($lstSale as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('sale_id'))
                <div class="error">
                    <p>{{ $errors->first('sale_id') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="model" class="col-form-label">Promotion: <em style="color: red">*</em></label>
                <select name="product_detail_id">
                    <option value="" style="text-align: center">--Select capacity--</option>
                    @foreach ($lstProductDetail as $item)
                        <option value="{{ $item->id }}">{{ $item->capacity }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('product_detail_id'))
                <div class="error">
                    <p>{{ $errors->first('product_detail_id') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="price" class="col-form-label">Price Sale: <em style="color: red">*</em></label>
                <input type="number" class="form-control" name="price_sale" placeholder="Enter price" style="text-align: left">
            </div>
            @if ($errors->first('price_sale'))
                <div class="error">
                    <p>{{ $errors->first('price_sale') }}</p>
                </div>
            @endif

            
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>

@stop
