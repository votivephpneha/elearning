@extends('Front.layouts.layout')
@section('title', 'User Dashboard')


@section('content')
<div class="row">


<div class="col-md-12">

   <div class="chose-q">
   <div class="mb-4"> <h4 class="mb-1 p-0"><b>Choose your topics </b></h4>
            <p class="m-0 p-0"> Tick the Boxes to choose topics</p></div>

   <div class="tick-box">
    @foreach($topic_data as $t_data)
    <?php
      $topic_questions = DB::table("question_bank")->where("topic_id",$t_data->topic_id)->get();
    ?>
   <div class="tick-radio">
    <div>
    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
    <label for="vehicle1">{{ $t_data->title }}</label>
  </div>
  <small> {{ count($topic_questions) }} Questions</small>

   </div>
   @endforeach

      

      </div>

<div class="mt-4">
<div class="mb-2">
 <h4 class="mb-1 p-0"><b>Choose question type </b></h4>
            </div>
<div class="any-quest">
<div class="select-difi">
<input type="radio" class="btn-check" name="options-outlined-questions" id="success-outlinedx" autocomplete="off" >
<label class="btn btn-outline-success" for="success-outlinedx">Attempted</label>

<input type="radio" class="btn-check" name="options-outlined-questions" id="danger-outlinedy" autocomplete="off">
<label class="btn btn-outline-success" for="danger-outlinedy">Not attempted</label>

<input type="radio" class="btn-check" name="options-outlined-questions" id="success-outlinedbz" autocomplete="off" >
<label class="btn btn-outline-success" for="success-outlinedbz"> Any Questions</label>


</div>

</div>

</div>

<div class="mt-4">
<div class="mb-2">
 <h4 class="mb-1 p-0"><b>Select Difficulty </b></h4>
            </div>
<div class="select-difi">
<input type="radio" class="btn-check" name="options-outlined" id="success-outlined" autocomplete="off" >
<label class="btn btn-outline-success" for="success-outlined">Easy</label>

<input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
<label class="btn btn-outline-success" for="danger-outlined">Medium</label>

<input type="radio" class="btn-check" name="options-outlined" id="success-outlinedb" autocomplete="off" >
<label class="btn btn-outline-success" for="success-outlinedb">Hard</label>

<input type="radio" class="btn-check" name="options-outlined" id="danger-outlineda" autocomplete="off">
<label class="btn btn-outline-success" for="danger-outlineda">Mix it up</label>
</div>

</div>




<div class="mt-4">
<div class="mb-2">
 <h4 class="mb-1 p-0"><b>Session Length</b></h4>
            </div>
<div class="select-difi">
<input type="radio" class="btn-check" name="options-outlined1" id="success-outlinedy" autocomplete="off" >
<label class="btn btn-outline-success" for="success-outlinedy">Short
10 mins - 20 mins</label>

<input type="radio" class="btn-check" name="options-outlined1" id="danger-outlinedk" autocomplete="off">
<label class="btn btn-outline-success" for="danger-outlinedk">Medium
30 mins - 1 hour</label>

<input type="radio" class="btn-check" name="options-outlined1" id="success-outlinedbx" autocomplete="off" >
<label class="btn btn-outline-success" for="success-outlinedbx">Long
2 Hour - 3 hour</label>

</div>

</div>

<a href="{{ url('/user/start_quiz') }}/4" class="next-chose"> Next </a>


            </div>

          </div>



</div>
</div>
</div>
</section>







</div>
@endsection