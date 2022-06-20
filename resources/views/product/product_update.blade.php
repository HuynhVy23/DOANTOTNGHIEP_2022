@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Update Perfume Model</h3> </div>
</div>
@stop
@section('main')
<div class="row">
    <div class="col-6">
        <div class="card">
        <div class="button-list">
                        <form action="{{ route('productad.update',$product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            Name : <input type="text" name="name" value="{{ $product->name }}"/></br></br>

                            Concentration : <input type="text" name="concentration" value="{{ $product->concentration }}"/></br></br>

                            Description : <input type="text" name="description" value="{{ $product->description }}"/></br></br>

                            Brand : <select name="brand_id">
                                @foreach ($lstBrand as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$product->brand_id) selected @endif>{{ $item->name_brand }}</option>
                                @endforeach
                            </select></br></br>

                            Scent : <select name="scent_id">
                                @foreach ($lstScent as $item)
                                    <option value="{{ $item->id }}" @if($item->id==$product->scent_id) selected @endif>{{ $item->name_scent }}</option>
                                @endforeach
                            </select></br></br>

                            <label for="file">Image : </label>
                            <input type="file" name="hinh_anh" id="file"/>
                            <br/>
                            <input class="btn btn-primary btn-rounded m-b-10 m-l-5" type="submit" name="submit" value="Update"/>
                        </form>
                        </div>
                    </div>
                </div>
                    <div class="card">
                        <img src="{{ $product->image }}" width="500px" height="500px">
                    </div>
</div>
                @stop