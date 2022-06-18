@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Add New Perfume Model</h3> 
    </div>
</div>
@stop
@section('main')
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="button-list">
        <form action="{{ route('productad.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            Name : <input type="text" name="name"/>
            <em style="color: red"></em></br></br>

            Concentration : <input type="text" name="concentration"/>
            <em style="color: red"></em></br></br>

            Description : <input type="text" name="description" />
            <em style="color: red"></em></br></br>

            Brand : <select name="brand_id">
                <option value="">--Select brand--</option>
                @foreach ($lstBrand as $item)
                    <option value="{{ $item->id }}">{{ $item->name_brand }}</option>
                @endforeach
            </select></br></br>

            Scent : <select name="scent_id">
                <option value="">--Select scent--</option>
                @foreach ($lstScent as $item)
                    <option value="{{ $item->id }}">{{ $item->name_scent }}</option>
                @endforeach
            </select></br></br>

            <label for="file">Image : </label>
            <input type="file" name="hinh_anh" id="file"/>
            <br/>
            <input class="tg-btn" type="submit" name="submit" value="Submit"/>
        </form>
        </div>
            </div>
    </div>
</div>
@stop