@extends('admin.layouts.layout')
@section('content')
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub-topic Form</h1>
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
            <h3 class="card-title" style="2.0rem !important;">Add Sub-topic</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form action="{{ url('/admin/subtopic_action') }}" id="subtopic_form" method="post" enctype="multipart/form-data">
                      {!! csrf_field() !!}
             <input type="hidden" class="form-control" name="id" value="{{$id}}">


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Title<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" name="title"   value="@if($id>0){{trim($subtopic_detail[0]->title)}}@endif">
                     @if ($errors->has('title'))
                      <span class="" style="color:red">
                        {{ $errors->first('title') }}
                      </span>
                @endif
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Courses<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <select class="form-select form-control" id="course-dropdown" name="course_id">
                      <option value="">Select Course</option>
                      <?php if($id>0){
                     
                       foreach($course_list as $course){?>
                      <option value="{{ $course->course_id }}" @if($course->course_id == $subtopic_detail[0]->course_id) selected @endif>
                        {{ $course->title }}
                      </option>


                     <?php } }else{
                        foreach($course_list as $course){?>
                      <option value="{{ $course->course_id }}">
                        {{ $course->title }}
                      </option>

                    <?php   } }
                      ?></select>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
                            <div class="col-md-6">
                <div class="form-group">
                  <label>Topics<span class="mandatory" style="color:red"> *</span></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                    </div>
                    <select class="form-select form-control" id="topic-dropdown" name="topic_id">
                      <option value="">Select Topics</option>
                      <?php if($id>0){
                       foreach($topic_list as $topic){?>
                      <option value="{{ $topic->topic_id }}" @if($topic->topic_id == $subtopic_detail[0]->topic_id) selected @endif>
                        {{ $topic->title }}
                      </option>
                    <?php } }else{
                        foreach($topic_list as $topic){?>
                      <option value="{{ $topic->topic_id }}">
                        {{ $topic->title }}
                      </option>

                    <?php   } }
                      ?></select>
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>

        
         
            <!-- /.row -->
          </div>
           <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Submit" id="">
            <input type="button"   class="btn btn-primary" value="Go Back" onClick="history.go(-1);"  />
          </div>
        </form>
      </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

@endsection


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


<script>
window.addEventListener('load', function() {
    $("#subtopic_form").validate({
        rules: {
            title: {
                required: true,
            },
            course_id: {
                required: true,
            },

            topic_id: {
                required: true,
            },
            
        },
        messages: {
            title: {
                required: "Title is required",
            },
            
            course_id: {
                required: "Course is required",
            },
            topic_id: {
                required: "Topic is required",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@stop






















