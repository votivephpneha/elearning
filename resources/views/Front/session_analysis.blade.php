@extends('Front.layouts.layout')
@section('title', 'Session Analysis')

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
<h5> 5/10</h5>
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
<h5> 8%</h5>
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
<h5> 10 <small>Seconds</small></h5>
<p>Avg. Time per Questions</p>
</div>
</div>
</div>

<div class="seesion-box">
  <div class="d-flex ">
 <div class="mr-3a a4">
<label> <i class='bx bx-stopwatch'></i></label>
</div>

<div class="tex-bk">
<h5>10 <small>minutes</small></h5>
<p>Total Time Spent</p>
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



<div class="col-md-12 mt-4">
<div class="recomend-topic">
<h5 class="pb-2 pt-2"> Recommended topics to study</h5>

<div class="topic-bar">

<!-- <div class="chepter-box">
  <a href="#">
  <div class="box1 bx1-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-open.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div> -->
<!-- <div class="chepter-box">
  <a href="#">
  <div class="box1 bx2-c">
<h2><img src="{{ url('/public') }}/assets/img/folder-openred.png"> Functions </h2>

<p class="m-0"><i class="bx bx-chevron-right"></i> </p>
</div>
</a>
</div> -->
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
</div>

<div class="attempt-quesa">
  <div class="rel-funct">
    <p class="atmpt"> Attempted </p>
<h3>Question 1 - Which is Real Function ? </h3>

<div class="color-bx"> <label> Average Time: 1.0 seconds</label> <label> 100% got it correct</label> <label> You spent : 5 seconds</label>  </div>
</div>

<div class="correct-ans">
<p><i class='bx bxs-check-circle clr'></i> <label> X = Y </label></p>
<p style="color: #00BD65;"><i class='bx bx-check-double clr'></i> Correct</p>
</div>

<div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> X = Y </label></p>

</div>
<div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> X = Y </label></p>

</div>
<div class="correct-ans-incor">
<p><i class='bx bx-radio-circle blscr'></i> <label> X = Y </label></p>

</div>
<p class="mt-2 f-p"><b> Explanation :</b> <br>
  Lorem ipsum dolor sit amet consectetur. Lacinia pulvinar semper orci neque sit ac vitae. Quis risus placerat justo amet commodo molestie congue. Fringilla malesuada id eu sed fermentum. Elit eu at neque velit in faucibus tortor eu nunc.

</p>
</div>



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
</div>

</div>
</div>
@endsection