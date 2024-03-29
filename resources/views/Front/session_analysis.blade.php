@extends('Front.layouts.layout')
@section('title', 'Session Analysis')

@section('current_page_css')
<style type="text/css">
  .label_one{
    background-color: #4F8AC7 !important;
    padding: 5px 12px !important;
    color: #FFF !important;
    border-bottom-left-radius: 20px !important;
    border-top-left-radius: 20px !important;
    font-size: 14px !important;
  }

  .label_two{
    background-color: #67AA6F !important;
    padding: 5px 12px !important;
    font-size: 15px !important;
    color: #FFF !important;
    margin-left: 2px !important;
    margin-right: 2px !important;
    font-size: 14px !important;
  }

  .label_three{
    background-color: #D9D9D9 !important;
    padding: 8px !important;
    color: #FFF !important;
    padding: 5px 12px !important;
    border-bottom-right-radius: 20px !important;
    border-top-right-radius: 20px !important;
    font-size: 15px !important;
    font-size: 14px !important;
  }
</style>
@endsection

@section('current_page_js')
<script src="https://cdn.jsdelivr.net/npm/mathjax@3.0.0/es5/tex-mml-chtml.js"></script>
<script type="text/javascript">
  var correct_answer = $(".correct_answer").val();
  var correct_ans = correct_answer/"<?php echo $session_analysis1->total_questions; ?>";
  console.log("correct_answer",correct_ans.toFixed(2));
  $(".correct_answer_session").html(correct_ans.toFixed(2)*100+"%");
  // $(".label_incorrect").show();
  // $(".label_incorrect").siblings().remove();
  var questions_length = $(".attempt-quesa").length;
  for(var i = 1;i<=questions_length;i++){
    if ($('.label_correct-'+i).length){
        $(".label_incorrect-"+i).remove();
    }
    if ($('.label_attempted-'+i).length){
        $(".label_incorrect-"+i).remove();
    }
  }
</script>
@endsection

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
<h5> {{ $session_analysis1->attempted_questions}}/{{ $session_analysis1->total_questions}}</h5>
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
<h5 class="correct_answer_session">
  <?php
    // $attempted_questions = $session_analysis1->attempted_questions;
    // $total_questions = $session_analysis1->total_questions;
    // $correct_answers = $attempted_questions/$total_questions * 100;
    // echo number_format((float)$correct_answers, 2, '.', '')."%";
  ?>
</h5>
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
  <?php 
  $subtopic_data = DB::table("subtopics")->where("st_id",$st_id)->first();

  if($subtopic_data->quiz_time == "Timed"){
    $avg_mins = $session_analysis1->time_spent_seconds /$session_analysis1->total_questions;
    $mins1 = $avg_mins/60;
    ?>
    <h5> {{ $mins1 }} <small>minutes</small></h5>
    <p>Avg. Time per Questions</p>
    <?php
  }else{
    $sum = 0;

    foreach($session_analysis as $s_an){
      
      $sum = $sum + $s_an->time_spent_seconds;
    }

    $sum1 = $sum/count($session_analysis);
    ?>

    <h5><?php echo number_format((float)$sum1, 2, '.', ''); ?> Seconds</small></h5>
    <p>Avg. Time per Questions</p>
    <?php
  }  
  
  ?>

</div>
</div>
</div>

<div class="seesion-box">
  <div class="d-flex ">
 <div class="mr-3a a4">
<label> <i class='bx bx-stopwatch'></i></label>
</div>

<div class="tex-bk">
  <?php
  if($subtopic_data->quiz_time == "Timed"){
    $mins = $session_analysis1->time_spent_seconds /60;
    ?>
    <h5>{{ $mins }} <small>minutes</small></h5>
    <p>Total Time Spent</p>
    <?php
  }else{
    ?>
    <h5><?php echo $session_analysis1->time_spent_seconds; ?> minutes</small></h5>
    <p>Total Time Spent</p>
    <?php
  }  
  
  ?>
  

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



<!-- <div class="col-md-12 mt-4">
<div class="recomend-topic">
<h5 class="pb-2 pt-2"> Recommended topics to study</h5>

<div class="topic-bar">


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
</div> -->
<?php
  $i = 1;
  $j = 1;
  $correct_answer = array();
?>
@foreach($session_analysis as $qu)
<?php

  $options = DB::table("question_analysis")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("question_id",$qu->question_id)->where("student_id",Auth::guard("customer")->user()->id)->where("reference_id",$reference_id)->get();
  
?>
<div class="attempt-quesa">
  <div class="rel-funct">
    
    <p class="atmpt"> @if($qu->attempted_status != NULL)
     Attempted 
     @else
      Not Attempted 
    @endif</p>
<h3>Question {{ $i }} - <span>{!! $qu->questions !!}</span> </h3>

<div class="color-bx"> <label class="label_one"> Average Time: {{ $qu->time_spent_seconds }} seconds</label>
@if($qu->attempted_status == NULL)
 <label class="label_two label_attempted-{{ $i }}">0% got it Correct</label>  
@endif  
<label class="label_two label_incorrect-{{ $i }}">0% got it Correct</label>  
@foreach($options as $op)
  @if($op->correct_answer == "correct" && $op->student_answer == $op->option_id)
     <label class="label_two label_correct-{{ $i }}"> 100% got it Correct</label> 
     <?php
      $correct_answer[$j] = "correct";
      $j++;
     ?> 
  @else

  @endif
  
@endforeach

<label class="label_three"> You spent : {{ $qu->time_spent_seconds }} seconds</label>  </div>
</div>
<br>

@foreach($options as $op)
    
    @if($op->correct_answer == "correct")
      <div class="correct-ans"> <div class="d-flex">
        <p><i class="bx bxs-check-circle clr"></i> <label>{!! $op->options !!}</label></p></div>
        <p style="color: #00BD65;"><i class="bx bx-check-double clr"></i> Correct</p>
      </div>
    @else
      @if($op->option_id == $op->student_answer)
      <div class="incore-ans">
       <div class="d-flex"> <p><i class="bx bxs-check-circle clrpx"></i> <label>{!! $op->options !!}</label></p>
       </div>
        <p style="color: #F44336;"><i class="bx bx-x clr-cancel"></i> Incorrect</p>
      </div>
      @else
        <div class="correct-ans-incor">
           <div class="d-flex">
          <p><i class="bx bx-radio-circle blscr"></i> <label>{!! $op->options !!}</label></p>
        </div>

        </div>
      @endif
    @endif
  

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
<?php
  $questions_data = DB::table("question_bank")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("q_id",$qu->question_id)->groupBy('q_id')->first();
?>
<p class="mt-2 f-p"><b> Explanation :</b> <br>
  {!! $questions_data->correct_answer_explanation !!}

</p>
</div>
<?php
  $i++;
?>

@endforeach

<input type="hidden" name="correct_answer" class="correct_answer" value="<?php echo count($correct_answer); ?>">
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