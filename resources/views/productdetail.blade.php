@extends('layout.layout')
@section('main')
    <!-- Page Content -->
    <div class="page-heading about-heading header-text" style="background-image: url(../images/heading-5-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Product Detail</h4>
              <h2>{{ $product[0]->name }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row">
         <div class="col-md-12">
          @if($errors->any())
          @error('success')
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @enderror
          @error('fail')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @enderror
          @endif
         </div>
          <div class="col-md-4 col-xs-12">
            <div>
              <img src="{{ $product[0]->image }}" alt="" class="img-fluid wc-image" width="370px" height="370px">
            </div>
            <br>
            <div class="row">
            </div>
          </div>

          <div class="col-md-8 col-xs-12">
            <form method="post" class="form" action="{{ route('cart.store') }}">
              @csrf
              <h2>{{ $product[0]->name }}</h2>

              <br>

              <p class="lead">
                {{-- <small><del> $999.00</del></small><strong class="text-primary">$779.00</strong> --}}
                @if (empty($detail))
                <strong  style="color: #f33f3f">Out Stock</strong>
                @else
                <strong id="price" style="color: #f33f3f">{{ number_format( $detail[0]->price , 0, ',', '.') . " VND" }}</strong>
                @endif
                
                @foreach ($detail as $dt)
                <input id="price{{ $dt->id }}" style="display: none;opacity:0" type="hidden" value=" {{ number_format( $dt->price , 0, ',', '.') . " VND" }}"/>
                @endforeach
              </p>
              <br>
              <p class="lead"><strong>Brand : </strong>{{ $product[0]->name_brand }}</p>
              <p class="lead"><strong>Scent : </strong>{{ $product[0]->name_scent }}</p>
              <br>
              @foreach ($array as $a)
              <p class="lead">
                {{ $a }}
              </p><br>
              @endforeach
              <br> 
              @if (!empty($detail))
              <div class="row">
                <div class="col-sm-4">
                  <label class="control-label">Choose capacity</label>
                  <div class="form-group">
                    <select class="form-control" id="getprice" name="idproduct">
                      @foreach ($detail as $dt)
                      <option value="{{ $dt->id }}">{{ $dt->capacity }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
               
                <div class="col-sm-8">
                  <label class="control-label">Quantity</label>
                  <div class="row">
                    <div class="col-sm-6">
                      
                      <div class="form-group">
                        <input id="quantity" name="quantity" type="number" class="form-control" min="1" max="{{ $detail[0]->stock }}" value="1">
                      </div>
                     
                      
                    </div>
                    @foreach ($detail as $dt)
                <input id="stock{{ $dt->id }}" style="display: none;opacity:0" type="hidden" value="{{ $dt->stock }}"/>
                @endforeach
                    <div class="col-sm-6">
                      <button class="btn btn-primary btn-block" type="submit">Add to cart</button>
                      {{-- <a href="#" class="btn btn-primary btn-block">Add to Cart</a> --}}
                    </div>
                  </div>
                </div>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Similar Products</h2>
              <a href="{{ route('product') }}">view more <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          @for ($i=0;$i<3;$i++)
          <div class="col-md-4">
            <div class="product-item">
              <a href="{{route('productdetail',$all[$i]->id)}}"><img src="{{ $all[$i]->image }}" width="250px" height="210px" alt=""></a>
              <div class="down-content">
                <a href="{{route('productdetail',$all[$i]->id)}}"><h4>{{ $all[$i]->name }}</h4></a>
                {{-- <h6><small><del>$999.00 </del></small> $779.00</h6> --}}
                <p><strong>Description : </strong>{{ $all[$i]->description }}</p>
              </div>
            </div>
          </div>
          @endfor
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
