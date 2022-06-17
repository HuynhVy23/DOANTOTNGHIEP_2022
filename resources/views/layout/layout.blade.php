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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
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
          <a class="navbar-brand" href="{{ route('product') }}"><h2>Store Perfume <em>Website</em></h2></a>
          {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button> --}}
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('product') }}">Home
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 

                <li class="nav-item"><a class="nav-link" href="{{ route('product') }}">Products</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More</a>
                    
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('aboutus') }}">About Us</a>
                      <a class="dropdown-item" href="{{ route('blog') }}">Blog</a>
                      <a class="dropdown-item" href="{{ route('testimonial') }}">Testimonials</a>
                      <a class="dropdown-item" href="{{ route('term') }}">Terms</a>
                    </div>
                </li>
                
                <li class="nav-item"><a class="nav-link" href="{{ route('checkout') }}">Checkout</a></li>

                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                <li class="nav-item" style="padding-left: 50px"><button style="background-color: #212529; border: none;  color: white; margin-top: 10px; "data-toggle="modal" data-target="#myModal" >Login</button></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Login</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form >
              <div class="form-group">
                <label for="username" class="col-form-label">Username:</label>
                <input type="text" class="form-control" name="username">
              </div>
              <div class="form-group">
                <label for="password" class="col-form-label">Password:</label>
                <input type="text" class="form-control" name="password">
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
        </div>
    
      </div>
    </div>
    @yield('main')
    <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="inner-content">
                <p>Copyright © 2020 Company Name - Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></p>
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
      <script type="text/javascript">
        $(function() {
            $('#datepicker').datetimepicker({
              timepicker:false,
              datepicker:true,
              format:'d-m-Y',
              value:'1-9-2000',
              week:true,
            });
        });
    </script>
    </body>
  </html>