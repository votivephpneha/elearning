 @extends('Front.layouts.layout')
@section('title', 'Quiz')

@section("current_page_js")
<script type="text/javascript">
  var total_questions = $(".pallate").length;
  $(".attempted").html("0/"+total_questions);
  $(".remaining_questions").html(total_questions);
  


  var quiz = [];
  var session_quiz_array1 = JSON.stringify(quiz);
  sessionStorage.setItem("quiz_json", session_quiz_array1);
  function next_btn(i){
    //alert(i);
    var total_div = $('.qustion-box-one').length;
    if(i == total_div){
      $(".next-btn").removeAttr("onclick");
    }else{
      var next_box = i+1;
      $(".qustion-box-one").hide();
      $(".qustion-box-one-"+next_box).show();
    }

    var question_title = $(".question_title-"+i).text();
    //alert(question_title);

    if($("input:radio[name='question_options-"+i+"']").is(":checked")) {
      
      var j;
      var answer_val = $("input:radio[name='question_options-"+i+"']:checked").val();
      var session_quiz_json = sessionStorage.getItem("quiz_json");
      console.log("quiz",session_quiz_json);
      var session_quiz_array1 = JSON.parse(session_quiz_json);
      session_quiz_array1.push({"question":question_title,"answer":answer_val});
      var quiz1 = JSON.stringify(session_quiz_array1);
      sessionStorage.setItem("quiz_json", quiz1);
      
    }
    
    

    
    

    
  }
  function prev_btn(i){
    //alert(i);
    if(i == 1){
      $(".pre-btn").removeAttr("onclick");
    }else{
      var next_box = i-1;
      $(".qustion-box-one").hide();
      $(".qustion-box-one-"+next_box).show();
    }
    
  }

  function submit_quiz(){
    var question_title = $(".question_title").last().text();
    var total_div = $('.qustion-box-one').length;
    var answer_val = $("input:radio[name='question_options-"+total_div+"']:checked").val();
    var session_quiz_json = sessionStorage.getItem("quiz_json");
    console.log("quiz",total_div);
    var session_quiz_array1 = JSON.parse(session_quiz_json);
    if(answer_val != undefined){
      session_quiz_array1.push({"question":question_title,"answer":answer_val});
      var quiz1 = JSON.stringify(session_quiz_array1);
    }else{
      var quiz1 = session_quiz_json;
    }
    
    console.log("quiz1",quiz1);
    var total_div = $('.qustion-box-one').length;
    var student_id = "<?php echo Auth::guard('customer')->user()->id; ?>";
    var course_id = "<?php echo $course_id; ?>";
    var topic_id = "<?php echo $topic_id; ?>";
    var subtopic_id = "<?php echo $st_id; ?>";
    
    var active_div = $('.qust-no .active-q').length;
    
    var data = {"student_id":student_id,"course_id":course_id,"topic_id":topic_id,"subtopic_id":subtopic_id,"total_questions":total_div,"attempted":active_div,"quiz_json":quiz1,"_token":"{{ csrf_token() }}"};
    //console.log("data",data);
    $.ajax({
      type: "post",
      url: "{{ url('/user/submit_quiz') }}",
      data: data,
      cache: false,
      success: function(data){
         if(data == 1){
           window.location.href = "{{ url('/user/session_analysis') }}";
         }
      }
    });
  }

  function answerClick(i){
    //alert(i);
    if($("input:radio[name='question_options-"+i+"']").is(":checked")) {
      $(".pallate-color-"+i).removeClass("not-atempt");
      $(".pallate-color-"+i).addClass("active-q");
      var active_div = $('.qust-no .active-q').length;
      var total_questions = $(".pallate").length;
      var attempted_div = active_div+"/"+total_questions;
      var remaining_questions = $('.qust-no .not-atempt').length;
      $(".attempted").html(attempted_div);
      $(".remaining_questions").html(remaining_questions);
    }

  }

  function question_pallate(i){
    $(".qustion-box-one").hide();
    $(".qustion-box-one-"+i).show();
  }

  var timer2 = "<?php echo $timer; ?>";
  console.log("timer2",timer2);
  var interval = setInterval(function() {


    var timer = timer2.split(':');
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);

    --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    if (minutes < 0) clearInterval(interval);
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $('.countdown').html(minutes + ':' + seconds);
    timer2 = minutes + ':' + seconds;
    console.log("timer2",timer2);
    if(timer2 == "0:00"){
      submit_quiz();
      window.location.href = "{{ url('/user/session_analysis') }}";
    }
  }, 1000);
</script>
@endsection

@section('content')
   <section  style="background-color: #f8f8f8; height: 100vh; padding: 0px;" onload="startTime()" >
      <div class="container-fluid" data-aos="fade-up">
    <div class="row quiz_questions" style="padding-top: 33px; ">
  <div class="col-md-9 main-quest" >
    <div class="col-md-11 m-auto ">
      <div class="d-flex justify-content-between align-content-center func-tn">
        <h5 class="funt-far"> Functions</h5>
        <p class="m-0 fiv-con"><i class='bx bx-time-five'></i><span class="countdown"></span></p>
    </div>
        <?php
            $i = 1;
          ?>
          @foreach($quiz as $qu)
          @if($qu->status == 1 && $qu->deleted_at == NULL)
          @if($qu->quiz_exam == "Quiz" || $qu->quiz_exam == "Both")
        <div class="qustion-box-one qustion-box-one-{{ $i }}" style="@if($i != 1) display: none;@endif">
          
        <div class="question-main">
      <div class="title mb-3 mt-2">
        <h6 class="tp-q">Question {{ $i }}</h6>
        <span class="question_title question_title-{{ $i }}">{!! $qu->title !!}</span>
        <!-- <div class="q-img">
        <img src="https://mathifyhsc.com/dev/public/assets/img/image 318.png">
      </div> -->
      </div>
      <?php
        $options = DB::table("question_bank")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("topic_id",$qu->topic_id)->where("q_id",$qu->q_id)->get();
      ?>
      <div class="row">
        <div class="col-md-12">
            @foreach($options as $op)
            <label class="customradio"><span class="radiotextsty">{!! $op->Options !!}</span>
            <input type="radio" name="question_options-{{ $i }}" value="{!! $op->Options !!}" onclick="answerClick({{ $i }})">
            <span class="checkmark"></span>
            </label>
            @endforeach
          
         <!--  <div class="cat-ans">
         <input type="radio" id="cat" name="animal" value="" />
<label for="cat"><span>1</span>  bla bla</label>
</div>

   <div class="cat-ans">
         <input type="radio" id="cat2" name="animal" value="" />
<label for="cat2"><span>2</span> cat Lorem ipsum do bla bla</label>
</div>

   <div class="cat-ans">
         <input type="radio" id="cat3" name="animal" value="" />
<label for="cat3"><span>3</span>  lorem acc actual expoumd bla bla</label>
</div>   

 <div class="cat-ans">
         <input type="radio" id="cat4" name="animal" value="" />
<label for="cat4"><span>4</span>  lorem acc actual expoumd bla bla</label>
</div> -->   
<div class="nex-pre-btn">
<a style="cursor: pointer;" class="pre-btn" onclick="prev_btn({{ $i }})"> Previous</a>
<a style="cursor: pointer;" class="next-btn next-btn-{{ $i }}" onclick="next_btn({{$i }})"> Next</a>
</div>


        </div>


      </div>
      <!--./row-->
    </div>
    

 </div>
 <?php
      $i++;
    ?>
    @endif
    @endif
    @endforeach
 </div>


          </div>

           <div class="col-md-3 p-0">
           <div class="elepsed-time">
            <div>
             <div class="watch-box">
<?php
          $user = Auth::guard("customer")->user();
          //echo $user->name;die;
          $user_name = explode(" ",$user->name);
          //print_r($user);die;
          
          
       ?> 
<div class="profle-c">
  <h2>
    <?php
      if(count($user_name)>1){
        echo strtoupper($user_name[0][0])."".strtoupper($user_name[1][0]);
      }else{
        echo strtoupper($user_name[0][0]);
      }
    ?>
  </h2>
</div>
     
     <div class="info-ex">
      <?php

      ?>
      <h5>{{ $user->name }}</h5>
      <p> Attempted: <b class="attempted"> 3/16</b></p>
       <p> Remaining: <b class="remaining_questions"> 13</b></p>

    </div>





         </div>
         <div class="watch-quet">
       <h5> Questions</h5>
  <div class="staus-que">

<p><span class="atp"></span> Attempted </p>
<p><span class="atp1"></span> Skipped </p>
<p><span class="atp2"></span> Not Attempted </p>


  </div>

     <div class="qust-no">
      <?php
            $i = 1;
          ?>
          @foreach($quiz as $qu)
          @if($qu->status == 1 && $qu->deleted_at == NULL)
          @if($qu->quiz_exam == "Quiz" || $qu->quiz_exam == "Both")
      <a style="cursor: pointer;" class="pallate pallate-color-{{ $i }} not-atempt" onclick="question_pallate({{ $i }})">{{ $i }}</a>
      <?php
      $i++;
    ?>
    @endif
    @endif
    @endforeach
       <!-- <a href="#" class="active-q">2</a>
        <a href="#" class="active-q">3</a>
         <a href="#" class="not-atempt">4</a>
          <a href="#" class="skiped">5</a>
           <a href="#" class="skiped">6</a>
            <a href="#" class="not-atempt">7</a>
             <a href="#" class="not-atempt">8</a>
              <a href="#" class="not-atempt">9</a>
               <a href="#" class="not-atempt">10</a> -->
               
</div>
<center><a href="#" class="submit-btn" onclick="submit_quiz()"> Submit</a></center>

         </div>
</div>

           </div>

          </div>



</div>
<br><br>

</div>
</section>
@endsection