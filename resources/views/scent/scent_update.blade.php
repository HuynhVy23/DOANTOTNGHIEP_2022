@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Scent Update</h3> </div>
</div>
@stop
@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="button-list">
            <form action="{{ route('scent.update',$lstScent->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            Name  :<pre></pre><input type="text" value="{{ $lstScent->name_scent }}" name="name_scent"></br></br>
               <input class="btn btn-success" type="submit" name="submit" value="Done">
    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop