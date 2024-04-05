
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
       <?php
          $user = Auth::guard("customer")->user();
          //echo $user->name;die;
          $user_name = explode(" ",$user->name);
          //print_r($user);die;
          if(count($user_name)>1){
            echo strtoupper($user_name[0][0])."".strtoupper($user_name[1][0]);
          }else{
            echo strtoupper($user_name[0][0]);
          }
          
       ?>
       <!-- <img src="{{ url('/public/assets/img') }}/user2-160x160.jpg"> -->
     </label></div>
     <?php
        $user = Auth::guard("customer")->user();
     ?>
   <p>{{ $user->name }} <br><small>{{ $user->email }}</small></p> 
    </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ url('/user/settings') }}">Profile</a></li>

            <li><a class="dropdown-item" href="{{ url('/user/change_password') }}">Change Password</a></li>            <li><a class="dropdown-item" href="{{ url('/user/logout') }}">Logout</a></li>
           
          </ul>
        </li>
      </ul>
  </div>
</nav>

</div>
<?php
if($_SERVER['REQUEST_URI'] == "/dev/user/exam_builder"){
      ?>
      </div>
    </div>
      <?php
    }
   ?> 
</div>
  </div>
</div>