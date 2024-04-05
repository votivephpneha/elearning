 @extends('Front.layouts.layout')
@section('title', 'Quiz')

@section("current_page_js")
<script src="https://cdn.jsdelivr.net/npm/mathjax@3.0.0/es5/tex-mml-chtml.js"></script>
<script type="text/javascript">


  var total_questions = $(".pallate").length;
  $(".attempted").html($(".active-q").length+"/"+total_questions);
  var remaining_questions = $(".not-atempt,.skiped").length;
  $(".remaining_questions").html(remaining_questions);
  


  var quiz = [];
  var session_quiz_array1 = JSON.stringify(quiz);
  sessionStorage.setItem("quiz_json", session_quiz_array1);
  var timer = $(".ans_time-1");
  var seconds = 0;

  var q_timer = setInterval(function() {
    seconds++;
    timer.val(seconds);
  }, 1000);
  function next_btn(i,q_id){
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
      var question_id = $(".question_id-"+i).val();
      console.log("quiz",session_quiz_json);
      var session_quiz_array1 = JSON.parse(session_quiz_json);
      session_quiz_array1.push({"question_id":question_id,"question":question_title,"answer":answer_val});
      var quiz1 = JSON.stringify(session_quiz_array1);
      sessionStorage.setItem("quiz_json", quiz1);
      
    }else{
      var ans_time = $(".ans_time-"+i).val();
      if(ans_time <= 15){
        $(".pallate-color-"+i).removeClass("not-atempt");
        $(".pallate-color-"+i).addClass("skiped");
      }
    }

    //alert(q_id);
    var answer_val1 = $("input:radio[name='question_options-"+i+"']:checked").val();
    var course_id = "<?php echo $course_id; ?>";
    var topic_id = "<?php echo $topic_id; ?>";
    var subtopic_id = "<?php echo $st_id; ?>";
    var active_div = $('.qust-no .active-q').length;
    var total_questions = $(".pallate").length;
    var total_time = $(".timer").val();
    var ans_time = $(".ans_time-"+i).val();
    //alert(ans_time);
    $.ajax({
      type: "post",
      url: "{{ url('/user/submit_question_answer') }}",
      data: {"q_id":q_id,"answer_val1":answer_val1,"reference_id":'{{ $reference_id }}',"attempted_questions":active_div,"total_questions":total_questions,"course_id":course_id,"topic_id":topic_id,"subtopic_id":subtopic_id,"total_time":total_time,"ans_time":ans_time,"_token":"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         // if(data == 1){
         //   window.location.href = "{{ url('/user/session_analysis') }}/{{ base64_encode($course_id) }}/{{ base64_encode($topic_id) }}/{{ base64_encode($st_id) }}";
         // }
      }
    });

    
    
    //clearInterval(q_timer);
    //alert(".ans_time-"+(i+1));
    var timer1 = $(".ans_time-"+(i+1));
    var seconds1 = 0;

    var q_timer1 = setInterval(function() {
      seconds1++;
      timer1.val(seconds1);
    }, 1000);

    //clearInterval(q_timer1);

    if(total_div == (i+1)){
      $(".next-btn-"+(i+1)).removeAttr("onclick");
      //$(".submit-btn").attr("onclick","submit_quiz1()");
    }

    
    window.history.replaceState(null, null, "?question="+(i+1));

    
  }

  var url_string = window.location.href; 
  var url = new URL(url_string);
  var c = url.searchParams.get("question");
  console.log(c);
  $(".qustion-box-one").hide();
  $(".qustion-box-one-"+c).show();

  function prev_btn(i){
    //alert(i);
    if(i == 1){
      $(".pre-btn").removeAttr("onclick");
    }else{
      var next_box = i-1;
      $(".qustion-box-one").hide();
      $(".qustion-box-one-"+next_box).show();
    }

    window.history.replaceState(null, null, "?question="+(i-1));
    
  }

  function submit_quiz(){
    var question_title = $(".question_title").last().text();
    var total_div = $('.qustion-box-one').length;
    var question_id = $(".question_id-"+total_div).val();
    var answer_val = $("input:radio[name='question_options-"+total_div+"']:checked").val();
    var session_quiz_json = sessionStorage.getItem("quiz_json");
    console.log("quiz",total_div);
    var session_quiz_array1 = JSON.parse(session_quiz_json);
    if(answer_val != undefined){
      session_quiz_array1.push({"question_id":question_id,"question":question_title,"answer":answer_val});
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
           window.location.href = "{{ url('/user/session_analysis') }}/{{ base64_encode($course_id) }}/{{ base64_encode($topic_id) }}/{{ base64_encode($st_id) }}";
         }
      }
    });
  }

  function submit_quiz1(){
    var total_div = $('.qustion-box-one').length;
    var answer_val1 = $("input:radio[name='question_options-"+total_div+"']:checked").val();
    var q_id = $(".question_id-"+total_div).val();
    var active_div = $('.qust-no .active-q').length;
    
    var total_questions = $(".pallate").length;
    var total_time = $(".timer").val();
    var timer2 = "<?php echo $timer; ?>";
    var time_spend = timer2-total_time;
    
    var timer_checked = "<?php echo $subtopic_data->timer; ?>";

    if(timer_checked == "Timed"){
      var time_spent = time_spend.toFixed(2);
    }else{
      var minutes = $("#minutes").text();
      var seconds = $("#seconds").text();
      var time_spent = minutes+":"+seconds;
    }
    //alert(timer2-total_time);
    var course_id = "<?php echo $course_id; ?>";
    var topic_id = "<?php echo $topic_id; ?>";
    var subtopic_id = "<?php echo $st_id; ?>";
    var ans_time = $(".ans_time-"+total_div).val();
    $.ajax({
      type: "post",
      url: "{{ url('/user/submit_quiz') }}",
      data: {"q_id":q_id,"answer_val1":answer_val1,"attempted_questions":active_div,"total_questions":total_questions,"course_id":course_id,"topic_id":topic_id,"subtopic_id":subtopic_id,"total_time":time_spent,"ans_time":ans_time,"_token":"{{ csrf_token() }}"},
      cache: false,
      success: function(data){
         
           window.location.href = "{{ url('/user/session_analysis') }}/{{ base64_encode($course_id) }}/{{ base64_encode($topic_id) }}/{{ base64_encode($st_id) }}";
         
      }
    });
  }

  function answerClick(i,q_id){
    //alert(i);
    if($("input:radio[name='question_options-"+i+"']").is(":checked")) {
      $(".pallate-color-"+i).removeClass("not-atempt");
      $(".pallate-color-"+i).removeClass("skiped");
      $(".pallate-color-"+i).addClass("active-q");
      var active_div = $('.qust-no .active-q').length;
      var total_questions = $(".pallate").length;
      var attempted_div = active_div+"/"+total_questions;
      var remaining_questions = $('.qust-no .not-atempt').length;
      $(".attempted").html(attempted_div);
      $(".remaining_questions").html(remaining_questions);
      //next_btn(i,q_id);
    }

  }

  function question_pallate(i){
    $(".qustion-box-one").hide();
    $(".qustion-box-one-"+i).show();
  }

  <?php
    if($subtopic_data->timer != "Not Timed"){
      ?>
  var timer2 = "<?php echo $timer; ?>";
  console.log("timer2",timer2);
  
  var interval = setInterval(function() {

    var new_time = getCookie("quiz_time_minutes-"+"<?php echo $st_id; ?>");
    
    //console.log("quiz_time_minutes",new_time);
    if(new_time){
      var timer = new_time.split('.');
    }else{
      var timer = timer2.split('.');
    }
    
    //by parsing integer, I avoid all extra string processing
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);

    --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    
    
    
    if (minutes < 0) clearInterval(interval);
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    //minutes = (minutes < 10) ?  minutes : minutes;
    $('.countdown').html(minutes + '.' + seconds);
    timer2 = minutes + '.' + seconds;
    
    $(".timer").val(timer2);

    if(timer2 == "0.00"){
      var total_questions = $(".pallate").length;
      for(var i = 1;i<=total_questions;i++){
        var q_id = $(".question_id-"+i).val();
        if(i != total_questions){
          next_btn(i,q_id);
        }
        
      }
      submit_quiz1();
      //window.location.href = "{{ url('/user/session_analysis') }}/{{ $course_id }}/{{ $topic_id }}/{{ $st_id }}";
    }
    var now = new Date();
    var minutes1 = 120;
    now.setTime(now.getTime() + (minutes1 * 60 * 1000));
    document.cookie="quiz_time_minutes-"+"<?php echo $st_id; ?>"+"="+minutes+"."+seconds;  
    document.cookie = "expires=" + now.toUTCString() + ";"
  }, 1000);
   <?php
    }else{
      ?>
        var minutesLabel = document.getElementById("minutes");
        var secondsLabel = document.getElementById("seconds");
        var time_value = getCookie("quiz_time-"+"<?php echo $st_id; ?>");
        //alert(time_value);
        
        
        if(time_value){
          
          var totalSeconds = time_value;
          
        }else{

          var totalSeconds = 0;
        }
        
        
        setInterval(setTime, 1000);

        function setTime() {
          ++totalSeconds;
          secondsLabel.innerHTML = pad(totalSeconds % 60);
          minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
          var min = $("#minutes").text();
          var sec = $("#seconds").text();
          //sessionStorage.setItem("quiz_time", totalSeconds);
          var now = new Date();
          var minutes = 120;
          now.setTime(now.getTime() + (minutes * 60 * 1000));
          document.cookie="quiz_time-"+"<?php echo $st_id; ?>"+"="+totalSeconds;  
          document.cookie = "expires=" + now.toUTCString() + ";"
        }

        function pad(val) {
          var valString = val + "";
          if (valString.length < 2) {
            return "0" + valString;
          } else {
            return valString;
          }
        }
  
      <?php
    }
  ?>
  function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    let cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        
        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
    return null;
}
 
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
        @if($subtopic_data->timer != "Not Timed")
        <p class="m-0 fiv-con"><i class='bx bx-time-five'></i><span class="countdown"></span></p>
        @else
          <p class="m-0 fiv-con"><i class='bx bx-time-five'></i><span id="minutes">00</span>:<span id="seconds">00</span></p>
          
        @endif
        <input type="hidden" name="timer" class="timer" value="">
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
        <input type="hidden" name="question_id" class="question_id-{{ $i }}" value="{{ $qu->q_id }}">
        <input type="hidden" name="ans_time" class="ans_time-{{ $i }}" value="">
        <div class="question_marks_title">
        <h6 class="tp-q">Question {{ $i }}</h6>
          @if($qu->marks <= 1)
            <span class="question_marks question_marks-{{ $i }}">[{{ $qu->marks }} mark]</span>
          @else
            <span class="question_marks question_marks-{{ $i }}">[{{ $qu->marks }} marks]</span>
          @endif
          
        </div>  
        <span class="question_title question_title-{{ $i }}">{!! $qu->title !!}</span>
        
        
        
        <!-- <div class="q-img">
        <img src="https://mathifyhsc.com/dev/public/assets/img/image 318.png">
      </div> -->
      </div>
      <?php
        $options = DB::table("question_bank")->where("course_id",$qu->course_id)->where("topic_id",$qu->topic_id)->where("chapter_id",$qu->chapter_id)->where("topic_id",$qu->topic_id)->where("q_id",$qu->q_id)->get();

        $options_session = DB::table("question_analysis")->where("reference_id",$reference_id)->where("question_id",$qu->q_id)->first();

      ?>
      <div class="row">
        <div class="col-md-12">
            @foreach($options as $op)
            <label class="customradio"><span class="radiotextsty">{!! $op->Options !!}</span>
            <input type="radio" name="question_options-{{ $i }}" value="{!! $op->option_id !!}" onclick="answerClick({{ $i }},{{ $qu->q_id }})" @if(!empty($options_session)) @if($op->option_id == $options_session->student_answer) checked @endif @endif>
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
<a style="cursor: pointer;" class="next-btn next-btn-{{ $i }}" onclick="next_btn({{$i }},{{ $qu->q_id }})"> Next</a>
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

           <div class="col-md-3">
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
      <p> Attempted: <b class="attempted"><?php echo count($attempt_count);?></b></p>
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
          <?php
            $options_session = DB::table("question_analysis")->where("reference_id",$reference_id)->where("question_id",$qu->q_id)->first();
          ?>
          @if($options_session)
          @if($options_session->student_answer)
            <a style="cursor: pointer;" class="pallate pallate-color-{{ $i }} active-q" onclick="question_pallate({{ $i }})">{{ $i }}</a>
          @else  
            @if($options_session->student_answer == NULL)
              <a style="cursor: pointer;" class="pallate pallate-color-{{ $i }} skiped" onclick="question_pallate({{ $i }})">{{ $i }}</a>
            @endif
          @endif
          @else
            <a style="cursor: pointer;" class="pallate pallate-color-{{ $i }} not-atempt" onclick="question_pallate({{ $i }})">{{ $i }}</a>
          @endif
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
<center><a href="#" class="submit-btn" onclick="submit_quiz1()"> Submit</a></center>

         </div>
</div>

           </div>

          </div>



</div>
<br><br>

</div>
</section>
@endsection