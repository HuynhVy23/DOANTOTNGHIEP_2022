@extends('layout.layout')
@section('main')
    <div class="page-heading about-heading header-text" style="background-image: url(../images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Wellcome to</h4>
              <h2>All brand</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container" >
        <div class="row">
         
          <div class="col-md-12">
            <div class="row">
              
              @foreach ($brand as $br)
              <div class="col-md-4">
                <div class="service-item">
                  <a href="{{ route('branddetail',$br->id) }}" class="services-item-image" >
                    <div style="width:290px;height:212px; background-image: url({{ $br->image_brand }});" class="imagebrand" >
                      {{-- <img src="{{ $br->image_brand }}" style="object-fit:cover;position: absolute;background-size: cover;display: block;background-position: center center;width: 290px;height: 212px;" class="img-fluid" alt=""> --}}
                      </div></a>

                  <div class="down-content">
                    <h4><a href="{{ route('branddetail',$br->id) }}">{{ $br->name_brand }}</a></h4>

                    <p style="margin: 0;"> {{ $br->detail }}</p>
                  </div>
                </div>
              </div>
              @endforeach
              
              {{-- <div class="col-md-6">
                <div class="service-item">
                  <a href="blog-details.html" class="services-item-image"><img src="../images/blog-2-370x270.jpg" class="img-fluid" alt=""></a>

                  <div class="down-content">
                    <h4><a href="blog-details.html">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h4>

                    <p style="margin: 0;"> John Doe &nbsp;&nbsp;|&nbsp;&nbsp; 12/06/2020 10:30 &nbsp;&nbsp;|&nbsp;&nbsp; 114</p>
                  </div>
                </div>
              </div> --}}

              <div class="col-md-12">
                {{ $brand->appends(request()->all())->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    @stop