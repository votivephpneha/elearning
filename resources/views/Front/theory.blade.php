@extends('Front.layouts.layout')
@section('title', 'Course view')

@section("current_page_js")

@endsection
@section('content')

<div class="row">
      <a href="#" class="d-flex key-space" onclick="history.back()"><span class="material-symbols-outlined mr-2">
keyboard_backspace
</span> Back </a>
  <div class="col-md-8 m-auto">
<div class="theory-box">

  <div class="pdf-line">
 	<?php
 		$theory = DB::table("subtopics")->where("st_id",$queries->st_id)->first();
 	?>
  <p>  Theory - {{ $theory->title }}</p>

 <center> 
         <embed src="{{ url('/public') }}/assets/img/{{ $queries->theory_pdf }}#toolbar=0" width="100%" height="500"> 
        </embed> 
    </center> 

  </div>

</div>
          </div>



</div>
@endsection