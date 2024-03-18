@extends('Front.layouts.layout')
@section('title', 'Course view')
@section('content')

<style type="text/css">
  
  .topics {
    padding: 0;
     margin-top: 5px; 
}
.class-box {
    padding: 25px;
    position: relative;
     top: 4px; 
}
@media (min-width: 320px) and (max-width: 767px){
  .class-box {
    padding: 10px;
    position: relative;
     top: 4px; 
}

}
</style>
<div class="row">


<div class="col-md-12">

   <div class="accordion-list">
    <h4><b>{{ $course_title->title }} </b></h4>
    <?php
      $i = 1;
    ?>
    <ul>

      @foreach($topics as $topic)
      @if($topic->status == 1 && $topic->deleted_at == NULL)
      <li>
        <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-{{ $i }}"><span><?php echo $i; ?></span> {{ $topic->title }} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
        <div id="accordion-list-{{ $i }}" class="collapse" data-bs-parent=".accordion-list">
          
          <div class="course-ilsit">
            <?php

              $chapter = DB::table("theory")->where("topic_id",$topic->topic_id)->get();


            ?>
            @foreach($chapter as $chep)
            @if($chep->status == 1 && $chep->deleted_at == NULL)
            <?php
              $chapter_name = DB::table("subtopics")->where("st_id",$chep->st_id)->first();
            ?>
            <h3><a href="{{ url('/user/theory/') }}/{{ base64_encode($chapter_name->st_id) }}" class="d-flex align-items-center "> <span class="material-symbols-outlined">
menu_book
</span>{{ $chapter_name->title }} </a></h3>
            @endif
            @endforeach
            <?php

              $chapters = DB::table("question_bank")->where("topic_id",$topic->topic_id)->groupBy('chapter_id')->get();
              $chapter_id = array();
              
            ?>
            <ul> 
              <?php $j = 0; ?>
              @foreach($chapters as $chep)
              <?php
                $chapter_id[$j] = $chep->chapter_id;
                $j++;
              ?>
              @if($chep->status == 1 && $chep->deleted_at == NULL)
              <?php
                $chapter_name = DB::table("subtopics")->where("st_id",$chep->chapter_id)->first();
                //print_r($chapter_name);
              ?>
              @if(!empty($chapter_name))
             <li><a href="{{ url('/user/start_quiz') }}/{{ base64_encode($chep->course_id) }}/{{ base64_encode($chep->topic_id) }}/{{ base64_encode($chep->chapter_id) }}"><img src="{{ url('/public') }}/assets/img/ancre.png"> {{ $chapter_name->title }} </a> </li>
             @endif
             @endif
              @endforeach
              <?php
                
                $chapters_topic = DB::table("subtopics")->where("topic_id",$topic->topic_id)->whereNotIn("st_id",$chapter_id)->get();
                //print_r($chapters_topic);
              ?>
              @foreach($chapters_topic as $ch_topic)
                 @if(!empty($ch_topic->title))
                 <li><a href="{{ url('/user/start_quiz') }}/{{ base64_encode($ch_topic->course_id) }}/{{ base64_encode($ch_topic->topic_id) }}/{{ base64_encode($ch_topic->st_id) }}"><img src="{{ url('/public') }}/assets/img/ancre.png"> {{ $ch_topic->title }} </a> </li>
                 @endif
              @endforeach
              
            </ul>
        </div>
      </li>
      <?php
        $i++;
      ?>
      @endif
      @endforeach
      
    </ul>
            </div>

          </div>



</div>

@endsection