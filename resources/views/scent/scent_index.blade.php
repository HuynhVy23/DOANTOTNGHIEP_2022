@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Scent</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="button-list">
                    <a type="submit" class="btn btn-primary btn-rounded m-b-10 m-l-5"
                        href="{{ route('scentad.create') }}">Add New Scent</a>
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table class="table table-bordered table-striped" style="text-align: center; border-style:groove">
                                <thead>
                                    <tr>
                                        <th class="col-4">ID</th>
                                        <th class="col-5" style="text-align: center">Name</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstScent as $scent)
                                        <tr>
                                            <td>{{ $scent->id }}</td>
                                            <td>{{ $scent->name_scent }}</td>
                                            <td><a class="btn btn-info btn-rounded"
                                                    href="{{ route('scentad.edit', $scent->id) }}"><i class="fa fa-edit"></a></td>
                                            <td>
                                                <form method="post" action="{{ route('scentad.destroy', $scent->id) }}" style="text-align: center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"class="btn btn-info btn-rounded btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
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
