@extends('admin.layouts.layout')

@section('js_bottom')
<script>
        $(document).ready(function () {
          $('#course-dropdown').on('change', function () {
                var course_id = this.value;
                
                $("#topic-dropdown").html('');
                $.ajax({
                    url: "{{url('/admin/fetch-topics')}}",
                    type: "POST",
                    data: {
                        country_id: course_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#topic-dropdown').html('<option value="">-- Select Topic --</option>');
                        $.each(result.topics, function (key, value) {
                            $("#topic-dropdown").append('<option value="' + value
                                .topic_id + '">' + value.title + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
          });
    </script>

@endsection

@section('content')
<div class="wrapper">


  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Question Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Course Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Questions</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/post_questions') }}" id="question_form" method="post">
                      {!! csrf_field() !!}
                       

            <div class="row">
              <div class="col-md-6">
              	<div class="form-group">
              		<div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary1">
                    <label for="checkboxPrimary1">
                      Quiz
                    </label>
                  </div><br><br>
                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary1">
                    <label for="checkboxPrimary1">
                      Exam Builder
                    </label>
                  </div><br><br>
              		
              	</div>
                <div class="form-group">
                  <label>Select Course</label>
                  <div class="input-group">
                    <?php
                      $course = DB::table("courses")->get();
                    ?>
                    <select class="form-control" name="difficulty_level" id="course-dropdown">
                      <option value="">Select Course</option>
                      @foreach($course as $cors)
                      <option value="{{ $cors->course_id }}">{{ $cors->title }}</option>
                      @endforeach
                      
                    </select>
                    
                  </div>
                </div>
                <div class="form-group">
                  <label>Select Topics</label>
                  <div class="input-group">
                    <?php
                      $topics = DB::table("topics")->get();
                    ?>
                    <select class="form-control" name="difficulty_level" id="topic-dropdown">
                      <option value="">Select Topics</option>
                      
                      
                    </select>
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- /.row -->

              

        
         
            <!-- /.row -->
          </div>
           <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Submit" id="">
          </div>
        </form>
            <!-- /.row -->
          </div>


        
          <!-- /.card-body -->
         
        </div>
        <!-- /.card -->

    

    
       
       
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
@endsection