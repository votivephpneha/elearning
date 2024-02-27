@extends('Front.layouts.layout')
@section('title', 'User Dashboard')
@section('content')
<div class="row">
<div class="col-md-12">
<div class="add-box">
  <div class="d-flex justify-content-between align-items-center" style="padding-right: 49px;">
    <div>
<h3> Welcome to Mathify!</h3>
<p> You’ve learned 70% of your goal this week! Keep it up and improve your progress.</p>

</div>

<a href="#">See more</a>
</div>

</div>
</div>

<div class="col-md-3">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/assets/img/maths.png">

</div>
<div class="sub-name-about">
<h5>Maths 101 </h5>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do. </p>
</div>

<div class="btm-btn">
<a href="#">View</a> <p>2,340+ Enrolled </p>
  </div>
</div>
</div>


<div class="col-md-3">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/assets/img/maths1.png">

</div>
<div class="sub-name-about">
<h5>Maths Advanced </h5>
<p>It is a long established fact that a reader will be distracted.</p>
</div>

<div class="btm-btn">
<a href="#">View</a> <p>23,350+ Enrolled </p>
  </div>
</div>
</div>

<div class="col-md-3">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/assets/img/maths2.png">

</div>
<div class="sub-name-about">
<h5>Maths Basics </h5>
<p>Contrary to popular belief, Lorem Ipsum is not simply random text. </p>
</div>

<div class="btm-btn">
<a href="#">View</a> <p>13,250+ Enrolled </p>
  </div>
</div>
</div>
<div class="col-md-3">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/assets/img/maths3.png">

</div>
<div class="sub-name-about">
<h5>Maths 101 </h5>
<p>Psychology and Consultation: How to solve anxiety problem </p>
</div>

<div class="btm-btn">
<a href="#">View</a> <p>3,149+ Enrolled </p>
  </div>
</div>
</div>

<div class="col-md-3">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/assets/img/maths.png">

</div>
<div class="sub-name-about">
<h5>Functional Maths </h5>
<p>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet.."</p>
</div>

<div class="btm-btn">
<a href="#">View</a> <p>3,149+ Enrolled </p>
  </div>
</div>
</div>


<div class="col-md-3">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/assets/img/maths4.png">

</div>
<div class="sub-name-about">
<h5>Functional Maths </h5>
<p>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet.."</p>
</div>

<div class="btm-btn">
<a href="#">View</a> <p>3,149+ Enrolled </p>
  </div>
</div>
</div>



<div class="col-md-3">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/assets/img/maths4.png">

</div>
<div class="sub-name-about">
<h5>Functional Maths </h5>
<p>The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet.."</p>
</div>

<div class="btm-btn">
<a href="#">View</a> <p>3,149+ Enrolled </p>
  </div>
</div>
</div>
</div>
@endsection