@extends('admin.layouts.layout')

@section('current_page_css')
<style type="text/css">
  .cke_contents{
    height:100px !important;
  }
</style>
@endsection

@section('js_bottom')
<script src="{{ url('/public') }}/ckeditor/ckeditor.js"></script>

<script>
        //$('textarea[name="DSC"]').ckeditor();
        CKEDITOR.replace('question_content', { mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' });
        CKEDITOR.replace('answer_explanation', { mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' });
        CKEDITOR.replace('options', { mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' });
        var counter = 1;
        function add_options(){
          $(".option_answer").append('<textarea name="DSC" class="materialize-textarea" id="options-'+counter+'"></textarea>');
          CKEDITOR.replace('options-'+counter, { mathJaxLib : 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' });
          counter++;
        }
        $("#cke_3_contents").removeAttr("style");
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
            $('#topic-dropdown').on('change', function () {
                var topic_id = this.value;
                var course_id = $("#course-dropdown").val();
                //alert(topic_id);
                $("#subtopic-dropdown").html('');
                $.ajax({
                    url: "{{url('/admin/fetch-subtopics')}}",
                    type: "POST",
                    data: {
                        course_id: course_id,
                        topic_id: topic_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        console.log("result",result.subtopics);
                        $('#subtopic-dropdown').html('<option value="">-- Select Chapter --</option>');
                        $.each(result.subtopics, function (key, value) {
                            $("#subtopic-dropdown").append('<option value="' + value
                                .st_id + '">' + value.title + '</option>');
                        });
                        //$('#city-dropdown').html('<option value="">-- Select City --</option>');
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
              <li class="breadcrumb-item active">Question Form</li>
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

            <form action="{{ url('/admin/post_questions_bank') }}" id="question_form" method="post">
                      {!! csrf_field() !!}
                       

            <div class="row">
              <!-- <div class="col-md-6">
                <label>Question Title</label>
                <div class="form-group">
                  <div class="input-group">
                    
                    <input type="text" class="form-control" name="question_title" >
                    @if (\Session::has('error'))
              <span class="" style="color:red">
                  {!! \Session::get('error') !!}
              </span>
          @endif
                  </div>
                </div>
              </div> -->
              <div class="col-md-12">
                <div class="form-group">
                  <label>Question Content</label>
                  <div class="input-group">
                    <textarea name="question_title" class="materialize-textarea" id="question_content"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary1" name="question_exam" value="Quiz">
                    <label for="radioPrimary1">
                      Quiz
                    </label>
                  </div><br><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="question_exam" value="Exam Builder">
                    <label for="radioPrimary2">
                      Exam Builder
                    </label>
                  </div><br><br>
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="question_exam" value="Both">
                    <label for="radioPrimary3">
                      Both
                    </label>
                  </div><br><br>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Select Course</label>
                  <div class="input-group">
                    <?php
                      $course = DB::table("courses")->get();
                    ?>
                    <select class="form-control" name="course" id="course-dropdown">
                      <option value="">Select Course</option>
                      @foreach($course as $cors)
                      <option value="{{ $cors->course_id }}">{{ $cors->title }}</option>
                      @endforeach
                      
                    </select>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Select Topics</label>
                  <div class="input-group">
                    <?php
                      $topics = DB::table("topics")->get();
                    ?>
                    <select class="form-control" name="topics" id="topic-dropdown">
                      <option value="">Select Topics</option>
                      
                      
                    </select>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-4">
              	<div class="form-group">
                  <label>Select Chapter</label>
                  <div class="input-group">
                    <?php
                      $topics = DB::table("topics")->get();
                    ?>
                    <select class="form-control" name="chapter" id="subtopic-dropdown">
                      <option value="">Select Topics</option>
                      
                      
                    </select>
                    
                  </div>
                  
                </div>
              </div>
              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Correct Answer Explanation</label>
                  <div class="input-group">
                    <textarea name="answer_explanation" class="materialize-textarea" id="answer_explanation"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Add Options</label>
                  <div class="input-group option_answer">
                    <textarea name="options" class="materialize-textarea" id="options" col="10"></textarea>
                  </div>
                  <button type="button" onclick="add_options()">Add options</button>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Time Length(Seconds)</label>
                  <div class="input-group">
                    <input type="text" name="time_length" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Difficulty Level</label>
                  <div class="input-group">
                    
                    <select class="form-control" name="difficulty_level" id="difficulty_level">
                      <option value="">Select Difficulty Level</option>
                      <option>Easy</option>
                      <option>Medium</option>
                      <option>Hard</option>
                    </select>
                    
                  </div>
                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Marks</label>
                  <div class="input-group">
                    <input type="text" name="marks" class="form-control">
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