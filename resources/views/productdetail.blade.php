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
          <div class="alert alert-success alert-dismissible fade show" role="alert" id="success">
            {{$message}}
          </div>
          @enderror
          {{-- @error('fail')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @enderror --}}
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
            <form  method="post" action="{{ route('cart.store') }}" >
              @csrf
              <h2>{{ $product[0]->name }}</h2>
              <input type="hidden" name="id" value="{{ $product[0]->id }}">

              <br>

              <p class="lead">
                {{-- <small><del> $999.00</del></small><strong class="text-primary">$779.00</strong> --}}
                @if (count($detail)==0)
                <strong  style="color: #f33f3f">Out Stock</strong>
                @elseif(isset($sale[$detail[0]->id]['product_detail_id']))
                <small><del id="pricesale">{{ number_format($detail[0]->price , 0, ',', '.') . " VND" }}</del></small><strong id="price" style="color: #f33f3f">{{ number_format( $sale[$detail[0]->id]['price_sale'] , 0, ',', '.') . " VND" }}</strong>
                @else
                <small><del id="pricesale"></del></small><strong id="price" style="color: #f33f3f">{{ number_format( $detail[0]->price , 0, ',', '.') . " VND" }}</strong>
                @endif
                
                @foreach ($detail as $dt)
                <input id="price{{ $dt->id }}" style="display: none;opacity:0" type="hidden" value=" {{ number_format( $dt->price , 0, ',', '.') . " VND" }}"/>
                @endforeach
              </p>
              <br>
              <p class="lead"><strong>Brand : </strong><a href="{{ route('branddetail',$product[0]->id_brand) }}">{{ $product[0]->name_brand }}</a></p>
              <p class="lead"><strong>Scent : </strong><a href="{{ route('scent',$product[0]->id_scent) }}">{{ $product[0]->name_scent }}</a></p>
              <br>
              @foreach ($product[0]->description as $a)
              <p class="lead">
                {{ $a }}
              </p><br>
              @endforeach
              <br> 
              @if (count($detail)!=0)
              <div class="row">
                <div class="col-sm-4">
                  <label class="control-label">Choose capacity</label>
                  <div class="form-group">
                    <select class="form-control" id="getprice" name="idproduct" onchange="showprice({{ $sale }})">
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
                      <button class="btn btn-primary btn-block " type="submit">Add to cart</button>
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
              <h2>Review</h2>
            </div>
          </div>
          @foreach ($review as $r)
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
              <img src="{{ $r->avatar }}"style="border-radius: 50%;" width="100px" height="100px" alt="">
              <p style="margin-left:20px">{{ $r->username }}</p>
            </div>
              <div class="col-md-8">
                  <p>Date : {{ $date[$r->id] }}</p>
                  <br>
                  <p style="overflow: hidden;text-overflow: ellipsis;line-height: 25px;max-height: 100px;max-width: 20cm;-webkit-box-orient: vertical;-webkit-line-clamp: 3;display: -webkit-box;">{{ $r->content }}</p>
              </div>
            </div>
            <div class="col-md-12">
              {{ $review->appends(request()->all())->links() }}
            </div>
          </div>
        
          @endforeach
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
@stop
