@extends('admin.layouts.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Questions Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Questions List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Questions List</h3>
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/add_questions_bank') }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Questions</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                 @if(Session::has('message'))

                     <div class="alert alert-success alert-dismissable">

                          <i class="fa fa-check"></i>

                           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>

                                       {{Session::get('message')}}

                     </div>

                    @endif
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Question Available In</th>
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Chapter</th>
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @foreach ($questions_data as $list)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{!! $list->title !!}</td>
                    <td>{{ $list->quiz_exam }}</td>
                    <td>
                      <?php
                        $course = DB::table("courses")->where("course_id",$list->course_id)->first();
                        echo $course->title;
                      ?>
                    </td>
                    <td>
                      <?php
                        $topic = DB::table("topics")->where("topic_id",$list->topic_id)->first();
                        echo $course->title;
                      ?>
                    </td>
                    <td>
                      <?php
                        $subtopic = DB::table("subtopics")->where("st_id",$list->chapter_id)->first();
                        echo $subtopic->title;
                      ?>
                    </td>
                     
                    <td>

                      <!-- <a href="{{ route('course.view', base64_encode($list->course_id)) }}"><i class="fa fa-eye"></i></a> -->

                    <a href="{{ route('course.edit', base64_encode($list->course_id)) }}"><i class="fa fa-edit"></i></a>
                      
                      <a title="Delete User" href="{{ route('course.delete', base64_encode($list->course_id)) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  
                  
                 
                 
                     <?php $i++; ?>
                                    @endforeach            
                  </tbody>
                <!--   <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->


    </section>
    <!-- /.content -->
  </div>


  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->

<!-- ./wrapper -->
@endsection




@section('js_bottom')






<!-- Bootstrap -->

<script src="{{ url('/') }}/public/design/admin/js/bootstrap.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
  
<!--Export table button CSS-->




<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var course_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "<?php echo url('/admin/course_status'); ?>",
      data: {'status': status, 'course_id': course_id},
       success: function(data){

        if(data.success){
          toastr.success('status changeed successfully');
        }
        else{
          toastr.error('Failed to change status');

        }
        },
      
    });
  })

</script>
@stop







