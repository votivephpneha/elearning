  <footer class="main-footer">
    <strong>Copyright &copy; 2024<a href="https://mathifyhsc.com/"></a>Mathify</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>
<script src="{{ url('/') }}/public/design/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{ url('/') }}/public/design/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="{{ url('/') }}/public/design/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ url('/') }}/public/design/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<script src="{{ url('/') }}/public/design/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ url('/') }}/public/design/admin/plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('/') }}/public/design/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- overlayScrollbars -->
<script src="{{ url('/') }}/public/design/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/public/design/admin/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/public/design/admin/js/demo.js"></script>
   <script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    
    <!--Export table buttons-->
    <script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js" ></script>
    <script type="text/javascript"  src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   
    <!--Data Table-->
    <script type="text/javascript"  src=" https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/public/design/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ url('/') }}/public/design/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/public/design/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/public/design/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <script type="text/javascript">


</script>

<!-- <script type="text/javascript">


        $(function () {

            $('#course_list').DataTable({
                        dom: 'Bfrtip',
                        responsive :true,
                        rowReorder: true,
                        buttons: [
                             'csv', 'excel'
                        ]
                    });

            $("#courseBodyContents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                rowReorder: true,

                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {

                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');

                $('tr.tableRow').each(function(index,element) {
                    order.push({
                        course_id: $(this).attr('data-course_id'),
                        ordering_id: index+1
                    });
                });

                $.ajax({
                    type: "Post",
                    dataType: "json",
                    url: "{{ route('update.order') }}",
                        data: {
                        order: order,
                    },
                     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        });
</script> -->


<script>
    let table = new DataTable('#course_list', {
    rowReorder: true
});
 
table.on('row-reorder', function (e, diff, edit) {
    let result = 'Reorder started on row: ' + edit.triggerRow.data()[1] + '<br>';
 
    for (var i = 0, ien = diff.length; i < ien; i++) {
        let rowData = table.row(diff[i].node).data();
 
        result +=
            `${rowData[1]} updated to be in position ${diff[i].newData} ` +
            `(was ${diff[i].oldData})<br>`;
    }
 
    document.querySelector('#result').innerHTML = 'Event result:<br>' + result;
});
    </script>

<script type="text/javascript">
        $(function () {

              $('#chapter_list').DataTable({
                        dom: 'Bfrtip',
                        responsive :true,
                        buttons: [
                             'csv', 'excel'
                        ]
                    });

            $("#chapterBodyContents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {

                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');

                $('tr.chaptertableRow').each(function(index,element) {
                    order.push({
                        st_id: $(this).attr('data-st_id'),
                        ordering_id: index+1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('/admin/update_chapterorder') }}",
                        data: {
                        order: order,
                    },
                     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        });
</script>

<script type="text/javascript">
        $(function () {

              $('#topic_list').DataTable({
                        dom: 'Bfrtip',
                        responsive :true,
                        buttons: [
                             'csv', 'excel'
                        ]
                    });

            $("#topicBodyContents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {

                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');

                $('tr.topictableRow').each(function(index,element) {
                    order.push({
                        topic_id: $(this).attr('data-topic_id'),
                        ordering_id: index+1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('/admin/update_topicrorder') }}",
                        data: {
                        order: order,
                    },
                     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        });
</script>





    


