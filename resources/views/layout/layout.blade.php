<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('images/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <title>Store Perfume</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ url('css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{ url('css/style.css')}}">
    <link rel="stylesheet" href="{{ url('css/owl.css')}}">

  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="{{ route('index') }}"><h2>Store Perfume <em>Website</em></h2></a>
          {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> --}}
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">Home
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 

                <li class="nav-item"><a class="nav-link" href="{{ route('product') }}">Products</a></li>

                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">More</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('aboutus') }}">About Us</a>
                      <a class="dropdown-item" href="{{ route('blog') }}">Blog</a>
                      <a class="dropdown-item" href="{{ route('testimonial') }}">Testimonials</a>
                      <a class="dropdown-item" href="{{ route('term') }}">Terms</a>
                    </div>
                </li> --}}

                <li class="nav-item"><a class="nav-link" href="{{ route('product') }}">Brand</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('checkout') }}">Cart</a></li>

                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                {{-- @if ( Auth::guard('user')->check() )
                <li class="nav-item" style="padding-left: 50px"><form><button type="submit" style="background-color: #212529; border: none;  color: white; margin-top: 10px; ">Log out</button></form></li>
                @else --}}
                <li class="nav-item dropdown" style="padding-left: 50px">
                  <a href="#">
                  <img  src="{{ url('images/about-1-570x350.jpg') }}" alt="" style="border-radius: 50%;" width="50px" height="50px"></a>
                  </li>
                {{-- @endif --}}
            </ul>
          </div>
        </div>
      </nav>
    </header>
    {{-- <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{ url('/login') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="username" class="col-form-label">Username:</label>
                <input type="text" class="form-control" name="username">
              </div>
              <div class="form-group">
                <label for="password" class="col-form-label">Password:</label>
                <input type="password" class="form-control" name="password">
              </div>
              <div style="text-align: center">
                <p>You do not already have an account? <a href="{{ route('account.create') }}"><strong>Register</strong></a></p> 
              <a href="#" style="font-size: 14px">Forgot password ?</a><br><br>
              <button type="submit" class="btn btn-primary">Submit</button>
         </div>
            </form>
          </div>
          {{-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           
          </div> --}}
        {{-- </div>
    
      </div>
    </div> --}}
    @yield('main')
    <footer>
        <div class="container">
          <div class="row" style="border-top: 1px solid rgb(0 0 0 / 25%);margin-top:20px">
            <div class="col-md-4">
              <div class="inner-content" style="text-align:left">
                <h6>Contact us :</h6>
                <p>Ms.Nhu : 0306191150@caothang.edu.vn</p>
                <p>Ms.Vy : 0306191195@caothang.edu.vn</p><br>
                <h6>Address :</h6>
                <p> 65 Huynh Thuc Khang Street, Ben Nghe Ward, District 1, Ho Chi Minh City</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="inner-content">
                
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.5178265418617!2d106.70135160000001!3d10.771595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f40a3b49e59%3A0xa1bd14e483a602db!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEvhu7kgdGh14bqtdCBDYW8gVGjhuq9uZw!5e0!3m2!1svi!2s!4v1655712309458!5m2!1svi!2s" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
            <div class="col-md-4">
              <div class="inner-content">
                {{-- <p>Copyright © 2020 Company Name - Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></p> --}}
              </div>
            </div>
          </div>
          
        </div>
      </footer>
  
  
      <!-- Bootstrap core JavaScript -->
      <script src="{{ url('jquery/jquery.min.js')}}"></script>
      <script src="{{ url('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
  
      <!-- Additional Scripts -->
      <script src="{{ url('js/custom.js')}}"></script>
      <script src="{{ url('js/owl.js')}}"></script>
    </body>
  </html>
  <script>
 document.getElementById("getprice").onchange = function(){
    var value = document.getElementById("getprice").value;
    var message = document.getElementById('price');
    message.innerHTML=document.getElementById('price'+value).value;
 }
//     function priceChanged()
// {
//     var message = document.getElementById('show_price');
//     var value = document.getElementById('getprice').value;
//     message.innerHTML=document.getElementById(value);
// }
  </script>