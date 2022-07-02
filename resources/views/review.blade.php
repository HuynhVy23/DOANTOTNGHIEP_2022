@extends('layout.layout')
@section('main')
    <div class="page-heading about-heading header-text" style="background-image: url(../images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Riview</h4>
              <h2>{{ $invoice->id }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products call-to-action">
        <div class="container">
            <div class="col-12">
              <h6>Id invoice : {{ $invoice->id }}</h6><br>
              <div class="inv">
              <p>Shipping Address : {{ $invoice->shipping_address }}</p><br>
              <p>Shipping Phone : {{ $invoice->shipping_phone }}</p><br>
              <p>Date payment : {{ $detail }}</p><br>
          </div>
               <div class="table-responsive">
                <form action="{{ route('review.store') }}" method="POST">
                    <input type="hidden" value="{{ $invoice->id }}" name="id">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Capacity</th>
                                <th>Review</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                                @csrf
                              @foreach ( $invoicedetail as $inv)
                              <tr>     
                              <td><img src="{{ $inv->image }}" alt="" width="100px" height="100px"></td>
                              <td>{{ $inv->name }}</td>
                              <td>{{ $inv->capacity }}</td>
                              <td><input type="hidden" value="{{ $inv->id }}" name="id{{ $inv->id }}"> <textarea name="review{{ $inv->id }}" cols="30" rows="10"></textarea></td>
                              @if ($errors->first('review'.$inv->id))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                You need to enter all information.
                              </button>
                            </div>
                        @endif
                           </tr>
                           @endforeach
                           
                             </tbody>
                        
                    </table>
                    <button type="submit" class="btn btn-info btn-rounded" >Submit</button>
                </form>
            </div>
      </div>
    </div>

  @stop
