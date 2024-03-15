@extends('Front.layouts.layout')
@section('title', 'Session Analysis')

@section('content')
	<div class="col-md-12">
   <div class="class-box-se" style="background-color: inherit;">
    <h3 class="setion-ana">Session Analysis </h3>

<div class="flex-br">
<div class="seesion-box">
  <div class="d-flex">
  <div class="mr-3a a1">
<label> <i class='bx bx-task'></i></label>
</div>
<div class="tex-bk">
<h5> 5/10</h5>
<p>Completed</p>
</div>
</div>
</div>


<div class="seesion-box">
  <div class="d-flex ">
  <div class="mr-3a a2">
<label> <i class='bx bx-check-double'></i></label>
</div>

<div class="tex-bk">
<h5> 8%</h5>
<p>Correct</p>
</div>
</div>
</div>

<div class="seesion-box">
  <div class="d-flex ">
<div class="mr-3a a3">
<label> <i class='bx bx-time-five'></i></label>
</div>

<div class="tex-bk">
<h5> 10 <small>Seconds</small></h5>
<p>Avg. Time per Questions</p>
</div>
</div>
</div>

<div class="seesion-box">
  <div class="d-flex ">
 <div class="mr-3a a4">
<label> <i class='bx bx-stopwatch'></i></label>
</div>

<div class="tex-bk">
<h5>10 <small>minutes</small></h5>
<p>Total Time Spent</p>
</div>
</div>
</div>
</div>

<!-- <div class="funct-box">

<div class="seesion-box">
  <div class="d-flex  align-content-center">
 <div class="mr-3a a5">
<label><i class='bx bx-book-open'></i></label>
</div>

<div class="tex-bk">
<h5>Functions (I), Functions (II)</h5>
<p>Recommended Topics to Study</p>
</div>
</div>
</div>
</div> -->



<div class="col-md-12 mt-4">
<div class="recomend-topic">
<h5 class="pb-2 pt-2"> Recommended topics to study</h5>

<div class="topic-bar">

<!-- <div class="chepter-box">
  <a href="#">
  <div class="box1 bx1-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-open.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div> -->
<!-- <div class="chepter-box">
  <a href="#">
  <div class="box1 bx2-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-openred.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div> -->
<div class="chepter-box">
  <a href="#">
  <div class="box1 bx3-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-openyelow.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div>
<div class="chepter-box">
  <a href="#">
  <div class="box1 bx4-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-open-green.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div>
<div class="chepter-box">
  <a href="#">
  <div class="box1 bx5-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-open-yellow.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div>


</div>


</div>
</div>
<?php
  $i = 1;
?>
@foreach($questions as $qu)
@if($qu->status == 1 && $qu->deleted_at == NULL)
@if($qu->quiz_exam == "Quiz" || $qu->quiz_exam == "Both")
<div class="attempt-quesa">
  <div class="rel-funct">
    <p class="atmpt"> Attempted </p>
<h3>Question {{ $i }} - <span>{!! $qu->title !!}</span> </h3>

<?php
  $quiz_array = json_decode($session_analysis->quiz_json);
  //print_r($quiz_array);
?>
<div class="color-bx"> <label> Average Time: 1.0 seconds</label> <label> 100% got it correct</label> <label> You spent : 5 seconds</label>  </div>
</div>
<?php
  $options = DB::table("question_bank")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("topic_id",$qu->topic_id)->where("q_id",$qu->q_id)->get();
  
?>
<!-- @foreach($quiz_array as $q_array)
  @foreach($options as $op)
    @if($op->correct_answer == "correct")
      @if($q_array->answer == $op->Options)
        <div class="correct-ans">
        <p><i class="bx bxs-check-circle clr"></i> <label>{!! $op->Options !!}</label></p>
        <p style="color: #00BD65;"><i class="bx bx-check-double clr"></i> Correct</p>
      </div>
      @endif
    @endif
  @endforeach
@endforeach -->
@foreach($options as $op)
  
    @if($op->correct_answer == "correct")
      <div class="correct-ans">
        <p><i class="bx bxs-check-circle clr"></i> <label>{!! $op->Options !!}</label></p>
        <p style="color: #00BD65;"><i class="bx bx-check-double clr"></i> Correct</p>
      </div>
    @else
        <div class="correct-ans-incor">
        <p><i class="bx bx-radio-circle blscr"></i> <label>{!! $op->Options !!} </label></p>

        </div>
    @endif
  


<!-- <div class="correct-ans-incor">
<p><i class="bx bx-radio-circle blscr"></i> <label>{!! $op->Options !!}</label></p>

</div> -->
@endforeach
<!-- <div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> X = Y </label></p>

</div>
<div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> X = Y </label></p>

</div>
<div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> X = Y </label></p>

</div> -->
<p class="mt-2 f-p"><b> Explanation :</b> <br>
  {!! $qu->correct_answer_explanation !!}

</p>
</div>
<?php
  $i++;
?>
@endif
@endif
@endforeach

<!-- 
<div class="attempt-quesa">
  <div class="rel-funct">
    <p class="atmpt"> Attempted </p>
<h3>Question 2 - What is the value of dy/dx (sin⁡ x tan⁡ x)? ? </h3>

<div class="color-bx"> <label> Average Time: 1.0 seconds</label> <label> 100% got it correct</label> <label> You spent : 5 seconds</label>  </div>
</div>

<div class="correct-ans">
<p><i class='bx bxs-check-circle clr'></i> <label> sin⁡ x + tan⁡ x sec⁡ x </label></p>
<p style="color: #00BD65;"><i class='bx bx-check-double clr'></i> Correct</p>
</div>

<div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> sin⁡ x + tan⁡ x sec⁡ x </label></p>

</div>
<div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> sin⁡ x + tan⁡ x sec⁡ x </label></p>

</div>
<div class="incore-ans">
<p><i class='bx bxs-check-circle clrpx'></i> <label> sin⁡ x + tan⁡ x sec⁡ x </label></p>
<p style="color: #F44336;"><i class='bx bx-x clr-cancel'></i> Incorrect</p>
</div>
<p class="mt-2 f-p"><b> Explanation :</b> <br>
  We follow product rule 𝑑𝑑𝑥 (f.g) = g.𝑑𝑑𝑥 (f) + f.𝑑𝑑𝑥 (g) Here, f = sin⁡ x and g = tan⁡ x 𝑑𝑑𝑥 (sin⁡ x tan⁡ x) = cos⁡ x tan⁡ x + sec2⁡ x sinx 𝑑𝑑𝑥 (sin⁡ x tan⁡ x) = sin⁡ x + tan⁡ x sec⁡ x

</p>
</div> -->

</div>
</div>
@endsection