@extends('layout.layout')
@section('main')

    <div class="page-heading about-heading header-text" style="background-image: url(../images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Brand</h4>
              <h2>{{ $brand->name_brand }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="products">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="section-heading">
                <h2>{{ $brand->name_brand }}</h2>
              </div>
            </div>

            <div class="col-md-8">
              @foreach ($brand->detail as $dt)
                  <p>{{ $dt }}</p><br>
              @endforeach
            </div>

            {{-- <div class="col-md-4">
              <div class="left-content">
                <h4>Lorem ipsum dolor sit amet.</h4>

                <br>
                
                <p>Lorem ipsum dolor sit amet, consectetur adipisic elit. Sed voluptate nihil eumester consectetur similiqu consectetur.<br><br>Lorem ipsum dolor sit amet, consectetur adipisic elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti.</p>
                
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, minus?</p>
              </div>
            </div> --}}
        </div>

        <br>
        
        <div>
          <img src="{{ $brand->image_brand }}" class="img-fluid" alt="" width="930px" height="339px">
        </div>
      </div>
    </div>

    <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Product of brand</h2>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
          @foreach ($product as $pd)
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

    {{-- <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Leave a Comment</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="email" type="text" class="form-control" id="email" placeholder="E-Mail Address" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="filled-button">Submit</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-4">
              <div class="left-content">

                <p>Lorem ipsum dolor sit amet, consectetur adipisic elit. Sed voluptate nihil eumester consectetur similiqu consectetur. Lorem ipsum dolor sit amet, consectetur adipisic elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti.</p>

                <br> 

                <ul class="social-icons">
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a href="#"><i class="fa fa-behance"></i></a></li>
                </ul>
              </div>
            </div>
        </div>
      </div>
    </div> --}}

    @stop