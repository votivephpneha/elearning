<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>mathify</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('/public') }}/assets/img/favicon.png" rel="icon">
  <link href="{{ url('/public') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('/public') }}/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <!-- Template Main CSS File -->
  <link href="{{ url('/public') }}/assets/css/style.css" rel="stylesheet">
  @yield('current_page_css')
  <?php
  if($_SERVER['REQUEST_URI'] != "/e-learning/login" and $_SERVER['REQUEST_URI'] != "/git/elearning/register" and $_SERVER['REQUEST_URI'] != "/git/elearning/user/start_quiz"){
    ?>
    <style type="text/css">
      body{
            background-color: #f7f7f7;
      }
    </style>
    <?php
  }
?>
<?php
  if($_SERVER['REQUEST_URI'] == "/git/elearning/user/start_quiz"){
    ?>
    <style type="text/css">
      body{
            background-color: #F7FBFF;
      }
    </style>
    <?php
  }
?>
<style type="text/css">
  .nav-custome {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
</style>  
</head>

<body>

<!-- End About Section -->

<?php
  
  if($_SERVER['REQUEST_URI'] != "/git/elearning/" and $_SERVER['REQUEST_URI'] != "/git/elearning/register" and !strpos($_SERVER['REQUEST_URI'],'start_quiz') and !strpos($_SERVER['REQUEST_URI'],'quiz')){
    ?>
    @include('Front.layouts.header')
    <?php if($_SERVER['REQUEST_URI'] != "/git/elearning/user/user_status" and $_SERVER['REQUEST_URI'] != "/git/elearning/user/settings" and $_SERVER['REQUEST_URI'] != "/git/elearning/user/change_password"){ ?>
      <div id="main" style="margin-left: 250px;">
    <div class="class-box <?php if(strpos($_SERVER['REQUEST_URI'],'course_view')){ ?>topics<?php } ?>">
    <?php } ?>
    
    <?php
  }
?>
@yield('content')
<?php
  if($_SERVER['REQUEST_URI'] != "/git/elearning/" and $_SERVER['REQUEST_URI'] != "/git/elearning/register" and !strpos($_SERVER['REQUEST_URI'],'start_quiz') and !strpos($_SERVER['REQUEST_URI'],'quiz')){
    ?>
    @include('Front.layouts.sidebar')
    <?php if($_SERVER['REQUEST_URI'] != "/git/elearning/user/user_status"  and $_SERVER['REQUEST_URI'] != "/git/elearning/user/settings" and $_SERVER['REQUEST_URI'] != "/git/elearning/user/change_password"){ ?>
    </div>
  </div>
  <?php
  }
?>
    <?php
  }
?>




  <!-- Vendor JS Files -->
  <script src="{{ url('/public') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{ url('/public') }}/assets/vendor/aos/aos.js"></script>
  <script src="{{ url('/public') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('/public') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{ url('/public') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ url('/public') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ url('/public') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <!-- Template Main JS File -->
  <script src="{{ url('/public') }}/assets/js/main.js"></script>
  @yield('current_page_js')
  <script type="text/javascript">
  
  var mini = true;
  
function toggleSidebar() {
  if (mini) {
    console.log("opening sidebar");
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    this.mini = false;
  } else {
    console.log("closing sidebar");
    document.getElementById("mySidebar").style.width = "80px";
    document.getElementById("main").style.marginLeft = "80px";
    this.mini = true;
  }
}

</script>
</body>

</html>  