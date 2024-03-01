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
  <div class="eleps-circle">
<img src="{{ url('/public') }}/assets/img/ellipse.png">
 </div>
 <div class="text-quize">
<h5> Maths 101</h5>
<p><b>10</b> Questions</p>
<p><b>10</b> Marks</p>
<p>Recommended Time :<b>30</b>mins</p>

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