 @extends('Front.layouts.layout')
@section('title', 'Quiz')

@section('content')
   <section  style="background-color: #f8f8f8; height: 100vh; padding: 0px;" onload="startTime()" >
      <div class="container-fluid" data-aos="fade-up">
    <div class="row" style="padding-top: 33px; ">
  <div class="col-md-9 main-quest" >
    <div class="col-md-11 m-auto ">
      <div class="d-flex justify-content-between align-content-center func-tn">
        <h5 class="funt-far"> Functions</h5>
        <p class="m-0 fiv-con"><i class='bx bx-time-five'></i> 10:15:45</p>
    </div>
        <div class="qustion-box-one">
        <div class="question-main">
      <div class="title mb-3 mt-2">
        <h6 class="tp-q">Question 1</h6>
        <span>Question 1. Lorem ipsum do yo lorem acc actual expoumd bla bla ?</span>
        <div class="q-img">
        <img src="https://mathifyhsc.com/dev/public/assets/img/image 318.png">
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <label class="customradio"><span class="radiotextsty">(-3, -4)</span>
            <input type="radio" checked="checked" name="radio">
            <span class="checkmark"></span>
          </label><label class="customradio"><span class="radiotextsty">(-3, -4)</span>
            <input type="radio" name="radio">
            <span class="checkmark"></span>
          </label><label class="customradio"><span class="radiotextsty">(-3, -4)</span>
            <input type="radio"  name="radio">
            <span class="checkmark"></span>
          </label><label class="customradio"><span class="radiotextsty">(-3, -4)</span>
            <input type="radio" name="radio">
            <span class="checkmark"></span>
          </label>
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
<a href="#" class="pre-btn"> Previous</a>
<a href="#" class="next-btn"> Next</a>
</div>


        </div>


      </div>
      <!--./row-->
    </div>


 </div>
 </div>


          </div>

           <div class="col-md-3 p-0">
           <div class="elepsed-time">
            <div>
             <div class="watch-box">

<div class="profle-c">
  <h2>DL </h2>
</div>

     <div class="info-ex">
      <h5> Danny Luo</h5>
      <p> Attempted: <b> 3/16</b></p>
       <p> Remaining: <b> 13</b></p>

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
      <a href="#" class="active-q">1</a>
       <a href="#" class="active-q">2</a>
        <a href="#" class="active-q">3</a>
         <a href="#" class="not-atempt">4</a>
          <a href="#" class="skiped">5</a>
           <a href="#" class="skiped">6</a>
            <a href="#" class="not-atempt">7</a>
             <a href="#" class="not-atempt">8</a>
              <a href="#" class="not-atempt">9</a>
               <a href="#" class="not-atempt">10</a>
</div>
<center><a href="{{ url('/user/session_analysis') }}" class="submit-btn"> Submit</a></center>

         </div>
</div>

           </div>

          </div>



</div>
<br><br>

</div>
</section>
@endsection