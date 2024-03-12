@extends('Front.layouts.layout')
@section('title', 'Exam Builder')

@section('content')
<div class="row">
<div class="col-md-12">
<div class="add-box">
  <div class="d-flex justify-content-between align-items-center">
    <div>
<h3>Select a Course</h3>
<p> You’ve learned 70% of your goal this week! Keep it up and improve your progress.</p>

</div>

<a href="#">See more</a>
</div>

</div>
</div>


<?php
  $i = 1;
?>
@foreach($course_data as $c_data)

@if($c_data->status == 1 && $c_data->deleted_at == NULL)
<div class="col-md-4">
<div class="subject-box">
  <div class="img-subject">
<img src="{{ url('/public') }}/uploads/courses/{{ $c_data->course_img }}">

</div>
<div class="sub-name-about">
<h5>{{ $c_data->title }}</h5>
<p class="dash_con">{!! $c_data->description !!}</p>
</div>

<div class="btm-btn">
<a href="<?php if($i == 1){ ?>{{ url('/user/exam_builder_view') }}<?php }else{ echo "#"; } ?>">View</a> <p>23,350+ Enrolled </p>
  </div>
</div>
</div>
<?php
  $i++;
?>
@endif

@endforeach
</div>
@endsection