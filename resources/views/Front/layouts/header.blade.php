<div class="container-fluid">
    <div class="row">
<div class="col-md-12 admin-profile">

  <div class="top-header">
 <nav class="navbar">
  <div class="container">
   <ul class="navbar-nav me-auto mb-2 mb-lg-0">
     <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
     <div class="mr-1z"> <label>
       <img src="{{ url('/public/assets/img') }}/user2-160x160.jpg">
     </label></div>
     <?php
        $user = Auth::guard("customer")->user();
     ?>
   <p>{{ $user->name }} <br><small>{{ $user->email }}</small></p> 
    </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="{{ url('/user/logout') }}">Logout</a></li>
           
          </ul>
        </li>
      </ul>
  </div>
</nav>

</div>
</div>
  </div>
</div>