@extends('Front.layouts.layout')
@section('title', 'Start Quiz')

@section('content')
	<section class="quiz-man">
      <div class="container-fluid" data-aos="fade-up">
  <div class="class-box" style="top:0px;">
    <div class="row">
    <div class="col-md-9 m-auto">
      <a href="#" class="d-flex key-space" onclick="history.back()" style="position: relative;bottom: 28px;"><span class="material-symbols-outlined mr-2">
keyboard_backspace
</span> Back </a>
  <div class="col-md-6 m-auto">
<div class="theory-box-quiz">
<!--   <div class="eleps-circle">
<img src="{{ url('/public') }}/assets/img/ellipse.png">
 </div> -->
 <div class="text-quize">
<h5> Maths 101</h5>
<p>Function</p>
<p>Total marks <b>100 Marks</b></p>
<p class="alrm-ct"><b><i class='bx bx-alarm' style="font-size: 21px;position: relative;top: 2px;"></i> 30 mins <i class='bx bxs-circle' style="font-size: 8px;"></i></b> Total Question: <strong>16</strong> </p>

</div>
<a href="{{ url('/user/quiz') }}" class="start-quz">Start Quiz </a>
</div>
          </div>


</div>
</div>
</div>
</div>
</section>
@endsection