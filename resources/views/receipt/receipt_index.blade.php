@extends('layout_admin.layout')
@section('container')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Good Receipt</h3>
        </div>
    </div>
@stop
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="button-list">
                    <a class="btn btn-primary btn-rounded m-b-10 m-l-5" href="{{ route('addreceipt') }}">Add New Import Receipt</a>
                    <div class="card-body">
                        <div class="table-responsive m-t-40">
                            <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
                                width="100%" style="border-style:groove; text-align: center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Shipping Address</th>
                                        <th style="text-align: center">Shipping Phone</th>
                                        <th style="text-align: center">See Detail</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($lstInvoice as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->username }}</td>
                                            <td>{{ $invoice->shipping_address }}</td>
                                            <td>{{ $invoice->shipping_phone }}</td>
                                            <td style="text-align: center"><a class="btn btn-info btn-rounded"
                                                    href="{{ route('showreceipt',$invoice->id) }}"><i
                                                    class="fa fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                            {{ $lstInvoice->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
