@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Add New Perfume</h3> 
    </div>
</div>
@stop
@section('main')
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="button-list">
        <form action="{{ route('product_detail.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            Capacity : <input type="text" name="capacity"/>
            <em style="color: red"></em></br></br>

            Price : <input type="text" name="price"/>
            <em style="color: red"></em></br></br>

            Stock : <input type="text" name="stock"/>
            <em style="color: red"></em></br></br>

            Model : <select name="product_id">
                <option value="">--Select catagory--</option>
                @foreach ($lstProduct as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select></br></br>

            Status : <input type="text" name="status"/>
            <em style="color: red"></em></br></br>
            
            <input class="tg-btn" type="submit" name="submit" value="Submit"/>
        </form>
        </div>
            </div>
    </div>
</div>
@stop