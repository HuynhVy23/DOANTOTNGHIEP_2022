
@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Add Brand</h3> </div>
</div>
@stop
@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="button-list">
        <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
            @csrf
Name : <pre></pre><input type="text" name="name_brand"/><em style="color:tomato">*</em></br></br>
<input class="btn btn-success" type="submit" name="submit" value="Add Brand"/></br></br>
<label style="color: red;"></label>
        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop