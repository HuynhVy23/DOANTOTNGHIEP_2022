@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Update Perfume</h3> </div>
</div>
@stop
@section('main')
<div class="row">
    <div class="col-6">
        <div class="card">
        <div class="button-list">
                        <form action="{{ route('product_detail.update',$productDetail->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            Capacity : <input type="text" name="capacity" value="{{ $productDetail->capacity }}"/></br></br>

                            Price : <input type="text" name="price" value="{{ $productDetail->price }}"/></br></br>

                            Stock : <input type="text" name="stock" value="{{ $productDetail->stock }}"/></br></br>

                            Model : <select name="product_id">
                                @foreach ($lstProduct as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$productDetail->product_id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select></br></br>

                            Status : <input type="text" name="status" value="{{ $productDetail->status }}"/></br></br>

                            <input class="btn btn-primary btn-rounded m-b-10 m-l-5" type="submit" name="submit" value="Update"/>
                        </form>
                        </div>
                    </div>
                </div>
</div>
                @stop