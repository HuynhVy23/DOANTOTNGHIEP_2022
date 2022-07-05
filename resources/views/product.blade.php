@extends('layout.layout')
@section('main')
 <!-- Page Content -->
 <div class="page-heading about-heading header-text" style="background-image: url({{ url('images/heading-6-1920x500.jpg') }})">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h2>Product</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="products">
  <div class="row" >
    <div class="col-md-12"style="margin: 10px 0 20px 20%;width:1000px;">
      <form action="{{ route('product') }}" method="GET">
    <div class="search" style="width:800px;display: flex;float:left">
      <i class="fa fa-search"></i>
      <input type="text" class="form-control" placeholder="Perfume's name" name="name">
      <button class="btn btn-primary" type="submit">Search</button>
    </form>
    </div>
      <select name="sort" id="sort" class="form-control" style="width: 170px;height:50px;">
        <option value="{{ Request::url() }}?sort=az">A->Z</option>
        <option value="{{ Request::url() }}?sort=za">Z->A</option>
      </select>
    
  </div>
  </div>
  <div class="container" style="max-width:1500px">
    <div class="row">
      <div class="col-md-2">
        <div class="contact-form">
          <div >
            <h5>Brands</h5>
          </div>
          <div class="row">
            <div class="col-8">
              @foreach ($brand as $b)
                <a href="{{ route('branddetail',$b->id) }}">{{ $b->name_brand  }} ({{ $b->totalPerfume->count() }})</a><br>
              @endforeach
            </div>
          </div>
        </div>
        <br>

        <div>
          <h5>Scents</h5>
        </div>
        @foreach ($scent as $c)
        <a href="{{ route('scent',$c->id) }}">{{ $c->name_scent    }} ({{ $c->totalPerfume->count() }})</a><br>
      @endforeach
      <br>
      <div>
        <h5>Gender</h5>
      </div>
      <a href="{{ route('gender',0) }}">Men</a><br>
      <a href="{{ route('gender',1) }}">Women</a><br>
      <a href="{{ route('gender',2) }}">Unisex</a><br>
      </div>
      <div class="col-md-8">
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
        
      <div class="col-md-12">
        {{ $lstProduct->appends(request()->all())->links() }}
      </div>
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