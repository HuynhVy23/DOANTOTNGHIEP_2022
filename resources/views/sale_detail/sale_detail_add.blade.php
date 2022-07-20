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
                <label for="model" class="col-form-label">Promotion: </label><br>
                <select class="custom-select" style="width: 200px;border-style:groove" name="sale_id">
                    <option value="" style="text-align: center">--Select promotion--</option>
                    @foreach ($lstSale as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->first('sale_id'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('sale_id') }}</p>
                </div>
            @endif

            <div class="form-group">
                <label for="model" class="col-form-label">Product Model: </label><br>
                <select class="custom-select" style="width: 200px;border-style:groove" name="product_detail_id" id="idproduct" style="border-style:groove" onchange="hidecapacity({{ $lstProductDetail }})">
                    <option value="" style="text-align: center">--Select product--</option>
                    @foreach ($pd as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <p style="opacity: 0;display:none;">{{ $lstProductDetail }}</p>
            </div>

            <div class="form-group">
                <label for="model" class="col-form-label">Capacity: </label><br>
                <select id="capacity" name="capacity" style="border-style:groove; width: 200px" class="custom-select"  >
                </select>
            </div>

            <div class="form-group">
                <label for="price" class="col-form-label">Price Sale: </label><br>
                <input type="number" class="form-control" name="price_sale" placeholder="Enter price" style="text-align: left;width: 200px;border-style:groove">
            </div>
            @if ($errors->first('price_sale'))
                <div class="error">
                    <p style="color: red">{{ $errors->first('price_sale') }}</p>
                </div>
            @endif

            
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
        </form>
    </div>

@stop
