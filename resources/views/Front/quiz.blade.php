 @extends('Front.layouts.layout')
@section('title', 'Quiz')

@section('content')
   <section  style="background-color: #FFF; height: 100vh; padding: 0px;" onload="startTime()" >
      <div class="container-fluid" data-aos="fade-up">
    <div class="row">
  <div class="col-md-9 main-quest">
    <div class="col-md-8 m-auto ">
        <h5 class="funt-far"> Functions</h5>
        <div class="qustion-box-one">
        <div class="question-main">
      <div class="title mb-3 mt-2"><span>Question 1. Lorem ipsum do yo lorem acc actual expoumd bla bla ?</span></div>
      <div class="row">
        <div class="col-md-12">
          <div class="cat-ans">
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
</div>    <!--answer-->

 <div class="cat-ans">
         <input type="radio" id="cat4" name="animal" value="" />
<label for="cat4"><span>4</span>  lorem acc actual expoumd bla bla</label>
</div>    <!--answer-->
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

           <div class="col-md-3">
           <div class="elepsed-time">
            <div>
             <div class="watch-box">
         <h5> Elapsed Time</h5>
      <div class="w-100 d-flex justify-content-center">  <div class="timer"><p>00: 00: 00 </p></div></div>
         </div>
         <div class="watch-quet">
       <h5> Questions</h5>
     <div class="qust-no">
      <a href="#" class="active-q">1</a>
       <a href="#">2</a>
        <a href="#">3</a>
         <a href="#">4</a>
          <a href="#">5</a>
           <a href="#">6</a>
            <a href="#">7</a>
             <a href="#">8</a>
              <a href="#">9</a>
               <a href="#">10</a>
</div>
<center><a href="{{ url('/user/session_analysis') }}" class="submit-btn"> Submit</a></center>

         </div>
</div>

           </div>

          </div>



</div>
</div>
</section>
@endsection