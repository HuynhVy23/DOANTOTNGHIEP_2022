@extends('layout.layout')
@section('main')
 <!-- Page Content -->
 <div class="page-heading about-heading header-text" style="background-image: url({{ url('images/heading-6-1920x500.jpg') }})">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>Scent</h4>
          <h2>{{ $title }}</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
      @foreach ($lstProduct as $pd)
      <div class="col-md-4">
        <div class="product-item">
          <a href="{{route('productdetail',$pd->id)}}"><img src="{{ $pd->image }}" width="350px" height="350px"></a>
              <div class="down-content">
                <a href="{{route('productdetail',$pd->id)}}"><h4>{{ $pd->name }}</h4></a>
                {{-- <h6><small><del>$999.00 </del></small> $779.00</h6> --}}
                  <p><strong>Description : </strong>{{ $pd->description }}</p>
              </div>
            </div>
          </div>  
      @endforeach
    </div>
  </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Book Now</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="contact-form">
          <form action="#" id="contact">
              <div class="row">
                   <div class="col-md-6">
                      <fieldset>
                        <input type="text" class="form-control" placeholder="Pick-up location" required="">
                      </fieldset>
                   </div>

                   <div class="col-md-6">
                      <fieldset>
                        <input type="text" class="form-control" placeholder="Return location" required="">
                      </fieldset>
                   </div>
              </div>

              <div class="row">
                   <div class="col-md-6">
                      <fieldset>
                        <input type="text" class="form-control" placeholder="Pick-up date/time" required="">
                      </fieldset>
                   </div>

                   <div class="col-md-6">
                      <fieldset>
                        <input type="text" class="form-control" placeholder="Return date/time" required="">
                      </fieldset>
                   </div>
              </div>
              <input type="text" class="form-control" placeholder="Enter full name" required="">

              <div class="row">
                   <div class="col-md-6">
                      <fieldset>
                        <input type="text" class="form-control" placeholder="Enter email address" required="">
                      </fieldset>
                   </div>

                   <div class="col-md-6">
                      <fieldset>
                        <input type="text" class="form-control" placeholder="Enter phone" required="">
                      </fieldset>
                   </div>
              </div>
          </form>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Book Now</button>
      </div>
    </div>
  </div>
</div>
@stop