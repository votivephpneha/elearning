@extends('Front.layouts.layout')
@section('title', 'User Dashboard')


@section('content')
<div id="main">

      <section  class="topics section-bg pt-5">
      <div class="container-fluid">
   <div class="row">
    <div class="col-md-12">
<div class="chose-q user-detal">
   <div class="mb-4"> <h4 class="mb-1 p-0"><b>Settings </b></h4>
            <p style="color: #256ad6;"> User Details</p>
            <form action="" class="w-50-half ">
              <div class="mt-3">
              <label>First Name</label>
              <input type="text" name="" class="form-control" placeholder="Danny"></div>
              <div class="mt-3">
              <label>Last Name</label>
              <input type="text" name="" class="form-control" placeholder="Lau"></div>
               <div class="mt-3">
              <label>Email Address </label>
              <input type="text" name="" class="form-control" placeholder="danny@domain.com"></div>
              <div class="mt-3">
                 <p style="color: #256ad6; margin: 0;">Payment Details</p>
              <label>Subscription</label>
              <input type="text" name="" class="form-control" placeholder="None"></div>

            </form>
</div>
</div>

 <div class="foter-suport">    
          <h3> <p> Contact Support </p>
          <small>sales@mathify.com </small></h3>
        </div>
</div>
</div>
   </div>

</section>
</div>
@endsection