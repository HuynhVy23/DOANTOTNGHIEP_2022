<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>PHPJabbers.com | Free Online Store Website Template</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../css/fontawesome.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/owl.css">

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
          <a class="navbar-brand" href="{{ route('product') }}"><h2>Online Store <em>Website</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
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
            </ul>
          </div>
        </div>
      </nav>
    </header>
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
      <script src="../jquery/jquery.min.js"></script>
      <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  
  
      <!-- Additional Scripts -->
      <script src="../js/custom.js"></script>
      <script src="../js/owl.js"></script>
    </body>
  </html>