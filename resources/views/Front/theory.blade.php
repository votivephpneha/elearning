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
 
  <p>  Theory - Basic Trigonometry Ratios & Revisions (I)</p>

 <center> 
         <embed src="{{ url('/public') }}/assets/img/Einstein_Relativity.pdf#toolbar=0" width="100%" height="500"> 
        </embed> 
    </center> 

  </div>

</div>
          </div>



</div>
@endsection