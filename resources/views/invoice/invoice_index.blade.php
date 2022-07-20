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
                    <div class="card-body">
                        <div class="row" style="margin-right:15px">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item" style="padding: 15px"> <a class="nav-link"
                                        href="{{ route('invoiceAdmin') }}?status=0">Pending<span
                                            class="label label-rouded label-primary pull-right"
                                            style="margin-left:10px">{{ $pending }}</span></a> </li>
                                <li class="nav-item" style="padding: 15px"> <a class="nav-link" href="{{ route('invoiceAdmin') }}?status=1">To
                                        Ship<span class="label label-rouded label-primary pull-right"
                                            style="margin-left:10px">{{ $toship }}</span></a> </li>
                                <li class="nav-item" style="padding: 15px"> <a class="nav-link" href="{{ route('invoiceAdmin') }}?status=2"
                                        role="tab">Complete<span class="label label-rouded label-primary pull-right"
                                            style="margin-left:10px">{{ $complete }}</span></a> </li>
                                <li class="nav-item" style="padding: 15px"> <a class="nav-link" href="{{ route('invoiceAdmin') }}?status=4"
                                        role="tab">Cancel<span class="label label-rouded label-danger pull-right"
                                            style="margin-left:10px">{{ $cancel }}</span></a> </li>
                                <li class="nav-item" style="padding: 15px"> <a class="nav-link" href="{{ route('invoiceAdmin') }}?status=3"
                                        role="tab">Cancelled<span class="label label-rouded label-primary pull-right"
                                            style="margin-left:10px">{{ $canceled }}</span></a> </li>
                        </div>
                        <div class="table-responsive m-t-40">
                            <table class="table table-bordered table-striped" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Shipping Address</th>
                                        <th style="text-align:center">Shipping Phone</th>
                                        <th style="text-align:center">Check Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstInvoice as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->username }}</td>
                                            <td>{{ $invoice->shipping_address }}</td>
                                            <td>{{ $invoice->shipping_phone }}</td>
                                            @if ($invoice->status != 2 && $invoice->status != 3)
                                                <td><a class="btn btn-warning btn-rounded"
                                                        href="{{ route('invoiceAdminn.edit',$invoice->id) }}"><i
                                                            class="fa fa-check"></i></a></td>
                                            @endif
                                            <td style="text-align: center"><a class="btn btn-info btn-rounded"
                                                    href="{{ route('showInvoiceAdmin', $invoice->id) }}"><i
                                                        class="fa fa-eye"></i></a>
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
