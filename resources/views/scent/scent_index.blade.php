
@extends('layout_admin.layout')
@section('container')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Scent</h3> </div>
</div>
@stop
@section('main')
<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="button-list">
        <a type="submit" class="btn btn-primary btn-rounded m-b-10 m-l-5" href="{{ route('scent.create') }}">Add New Scent</a>
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lstScent as $scent)
                            <tr>
                                <td>{{ $scent->id }}</td>
                                <td>{{ $scent->name_scent }}</td>
                                <td><a class="btn btn-info btn-rounded" href="{{ route('scent.edit',$scent->id)}}"> Update</a></td>
                                <td><form method="post" action="{{route('scent.destroy',$scent->id)}}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit"class="btn btn-info btn-rounded"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

@stop