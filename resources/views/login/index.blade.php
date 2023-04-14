<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <style>
      html,body{
        width: 100%;
        height: 100%;
        margin: 0;
      }
    </style>
  </head>

  <body>
    <div class="container h-100 w-100">
      
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-4 bg-light p-5 rounded">
      
          @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
      
          @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
      
          <main class="form-signin">
            <h1 class="h3 mb-5 fw-normal text-center font-weight-bold">Istana HP Dashboard</h1>
            <form action="/login" method="post">
              @csrf
              <div class="form-floating">
                <input type="text" name="username" class="form-control @error('email') is-invalid @enderror" id="username" placeholder="username" autofocus required value="{{ old('username') }}">
                <label for="username">Username</label>
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
          
              <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            {{-- <small class="d-block text-center mt-3">Not registered? <a href="/register">Register Now!</a></small> --}}
          </main>
        </div>
      </div> 
    </div>   

     <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="libs/jquery/jquery.js"></script>
    <script src="libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="js/main.js"></script>


    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>