@extends('admin.layouts.layout')
@section('title','Sub-topic List')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chapter Management</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Chapter List</li>
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
                <h1 class="card-title">Chapter List</h1>
                <div style="float:right; margin-right:10px; margin-top:10px;">
                  <a href="{{ url('/admin/subtopic-form1') }}/{{ $course_id }}/{{ $topic_id }}" class="btn btn-primary" style="color:#FFFFFF"> Add New Chapter</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                 @if(Session::has('message'))
                 <div class="alert alert-success alert-dismissable">
                  <i class="fa fa-check"></i>
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                {{Session::get('message')}}</div>

                    @endif
                     @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissable">
          <i class="fa fa-check"></i>
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
          {{Session::get('error')}}
        </div>
      @endif
                <table id="chapter_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <!-- <th>Image</th> -->
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody id="chapterBodyContents">
                                      <?php $i=1; ?>

                  @foreach ($topic_list as $list)
                  <tr class="chaptertableRow" data-st_id="{{ $list->st_id }}">
                    <td class="serial-number"> {{ $i }}</td>
                    <td>{{ $list->title}}</td>
                    <td>{{ $list->course_title}}</td>
                    <td>{{ $list->topic_title}}</td>
                    <td>
                   
                    <input data-id="{{$list->st_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $list->status ? 'checked' : '' }}>
                    </td>
                    <td>

                      <!-- <a href="{{ route('course.view', base64_encode($list->course_id)) }}"><i class="fa fa-eye"></i></a> -->

                    <a href="{{ route('subtopic.edit', base64_encode($list->st_id)) }}"><i class="fa fa-edit"></i></a>
                      
                      
                      <a title="Delete Topic" href="{{ url('/admin/subtopic-delete/') }}/{{base64_encode($list->st_id)}} }}/{{$topic_id }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                                       <?php $i++; ?>

                  @endforeach            
                  </tbody>
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
<script src="{{ url('/') }}/public/design/admin/js/bootstrap.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="https://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script>

   $('.toggle-class').on("change", function() {
    var status = $(this).prop('checked') == true ? 1 : 0; 
    var st_id = $(this).data('id'); 
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "<?php echo url('/admin/subtopic_status'); ?>",
      data: {'status': status, 'st_id': st_id},
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







