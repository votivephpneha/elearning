@extends('Front.layouts.layout')
@section('title', 'Session History')

@section('current_page_js')
<script type="text/javascript">
  function resumeTest(course_id,topic_id,chapter_id){
    window.location.href = "/git/elearning/user/quiz/"+course_id+"/"+topic_id+"/"+chapter_id+"?question=1";
  }
</script>
@endsection

@section('current_page_css')
<style type="text/css">
.sesn label {
    color: #939393;
    font-size: 16px;
}
.box-senvb h4 {
    text-align: center;
    font-size: 14px;
    border-bottom: 1px solid #e7e7e7;
    padding: 7px;
}
.topics-sesion .accordion-list {
    padding: 12px;
    background: #FFF;
    border-radius: 5px;
}
.topics-sesion {
    padding: 0;
    margin-top: 85px;
}
.resime-box p{
margin-bottom: 0px;
}
.resume-btn {
    border: 1px solid #ccc;
    background: #efefef;
    border-radius: 2px;
    padding: 4px 9px;
    font-size: 14px;
}
</style>
@endsection

@section('content')
      <section  class="topics-sesion section-bg pt-5">
      <div class="container">
   <div class="row">
 
    <div class="sesn"><h4><b>Attempt History </b><br></h4></div>
    @foreach($session_history as $session_his)
    <?php
      $total_question = DB::table("question_bank")->where("chapter_id",$session_his->chapter_id)->groupBy('q_id')->get();

      $attempted_question = DB::table("question_analysis")->where("student_id",Auth::guard("customer")->user()->id)->where("reference_id",$session_his->reference_id)->groupBy('question_id')->get();

      $date=date_create($session_his->created_at);
      
      //echo $session_his->created_at;
      $session_progress = count($attempted_question)/count($total_question)*100;
      
    ?>
    <div>
    <div class="box-senvb">
   <h4>{{ date_format($date,"M d, Y") }}</h4>
</div>
<div class="accordion-list">
  <p><strong>Study mode:  </strong> Custom session</p>
    <div class="d-flex justify-content-between align-items-center resime-box">
  <span class="material-symbols-outlined">
more_time
</span>

<div class="progress" style="height:15px; width: 80%;">
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
       style="width:{{ $session_progress }}%;"
       role="progressbar"
       aria-valuenow="90"
       aria-valuemin="0"
       aria-valuemax="100"> </div> 
</div>
<p> <?php echo count($attempted_question); ?>/<?php echo count($total_question); ?> 
<?php
  $test_status_data = DB::table("session_analysis")->where("reference_id",$session_his->reference_id)->first();
?>
@if($test_status_data)
<button type="button" class="resume-btn">
Complete
</button>
@else
<button type="button" class="resume-btn" onclick="resumeTest('{{ base64_encode($session_his->course_id) }}','{{ base64_encode($session_his->topic_id) }}','{{ base64_encode($session_his->chapter_id) }}')">
Resume
</button>
@endif
</p>

</div>
          
</div>

</div>
@endforeach
 

</div>
   </div>

</section>
@endsection