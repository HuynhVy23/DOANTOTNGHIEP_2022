@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Invoice</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="button-list">
                    <a type="submit" class="btn btn-primary btn-rounded m-b-10 m-l-5"
                        href="">Add
                        New Invoice</a>
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table class="table table-bordered table-striped" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Shipping Address</th>
                                        <th>Shipping Phone</th>
                                        <th>Type</th>
                                        <th style="text-align: center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstInvoice as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->username }}</td>
                                            <td>{{ $invoice->shipping_address }}</td>
                                            <td>{{ $invoice->shipping_phone }}</td>
                                            <td>{{ $invoice->type }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td><a class="btn btn-info btn-rounded"
                                                    href="{{ route('showInvoiceAdmin', $invoice->id) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>
                                            <td>
                                                <form method="post" action="" style="text-align: center">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"class="btn btn-info btn-rounded"><i
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
