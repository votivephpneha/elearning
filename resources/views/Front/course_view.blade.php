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
    <h4><b> {{ $course_title }} </b></h4>
              <ul>
                 @foreach($groupedData as $course)
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>{{$loop->iteration}}</span> {{ $course->topic_title }} <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    
                    <div class="course-ilsit">

                      <!-- <h3><a href="{{ url('/user/theory/') }}/{{ base64_encode(1) }}" class="d-flex align-items-center">  -->
                        <!-- <span class="material-symbols-outlined">menu_book</span>   -->
                        <?php $subtopics_id = explode(",",$course->chapter_id);
                        foreach($subtopics_id as $st_id){
                          $result = app()->call('App\Http\Controllers\UserController@theoryOrnot', ['course_id' => $course->course_id, 'topic_id' => $course->topic_id , 'st_id' => $st_id  ]);
                         }
                         ?> 
                         <!-- - Basic Trigonometry Ratios & Revisions (I) -->
                          </a></h3>
                      <ul> 
                        <?php $subtopics_list = explode(",",$course->subtopics_list);?>
                          <?php $subtopics_list = explode(",",$course->subtopics_list);?>
                          @foreach($subtopics_list as $list)
                           @if($result['check'] == "Theory")
                           <h3>
                          <a href="{{ url('/user/theory/') }}/{{ base64_encode($result['theory_id']) }}" class="d-flex align-items-center"> <span class="material-symbols-outlined">menu_book</span>  
                             {{$result['check']}}- {{$list}}
                          </a></h3>
                          @else
                           <li><a href="{{ url('/user/start_quiz') }}"><img src="{{ url('/public') }}/assets/img/ancre.png">{{$list}} </a> </li>
                          @endif


                        @endforeach

                      </ul>




                  </div>
                </li>
                @endforeach


              </ul>
            </div>

          </div>



</div>

@endsection