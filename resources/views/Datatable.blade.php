<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatable CRUD</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />

</head>
<body>

<!--Datatable Head-->
<div class="container">
     <br />
     <h3 align="centre">Datatable</h3>
     <br />
     <div align="right">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
     </div>
     <div align="centre" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Import Employee data from CSV') }}</div> -->

                <div class="card-body">
                    <form method="POST" action="{{ route('employees.saveCSVData') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="csv" class="col-md-4 col-form-label text-md-right">{{ __('Upload CSV file') }}</label>

                            <div class="col-md-6">
                                <input type="file" id="csv" name="csv" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload and Save') }}
                                </button>
                            </div>
                        </div>
                        <hr>
                        <!-- <h5>Column Format: first_name, last_name, email, gender, hobbies<br>(include these column names in first column)</h5> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

     <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped" id="user_table">
           <thead>
            <tr>
                <th width="10%">Image</th>
                <th width="15%">First Name</th>
                <th width="25%">Last Name</th>
                <th width="15%">Email</th>
                <th width="25%">Hobbies</th>
                <th width="15%">Gender</th>
                <th width="40%">Action</th>
            </tr>
           </thead>
       </table>
   </div>
   <br />
   <br />
  </div>
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>





<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Record</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
                <label class="control-label col-md-4" >First Name : </label>
                <div class="col-md-8">
                    <input type="text" name="FirstName" id="FirstName" class="form-control" />
                </div>
           </div>

           <div class="form-group">
                <label class="control-label col-md-4">Last Name : </label>
                <div class="col-md-8">
                    <input type="text" name="LastName" id="LastName" class="form-control" />

             <div class="form-group">
                <label class="control-label col-md-4">Email  : </label>
                <div class="col-md-8">
                <input type="email" class="form-control" id="Email" placeholder="name@example.com">
                    <!-- <input type="text" name="Email" id="Email" class="form-control" /> -->

             <div class="form-group">
                <label class="control-label col-md-4">Hobbies : </label>
                <div class="col-md-8">
                    <input type="text" name="Hobbies" id="Hobbies" class="form-control" />

        <!-- <div class="form-group">
                    <label>Hobbies</label>
                    <div class="row">
                    <div class="col-md-4"></div>
                        <div class="form-group col-md-4" style="margin-left:2px">
                        <div class="checkbox">
                            <label><input type="checkbox" value="TV" name="Hobbies[]">TV</label>
                        </div>
                            <div class="checkbox">
                            <label><input type="checkbox" value="Reaading" name="Hobbies[]">Reading</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="Coding" name="Hobbies[]">Coding</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="Skiing" name="Hobbies[]">Skiing</label>
                        </div>
                        </div>
                     </div>
                     </div> -->

             <div class="form-group">
                <label class="control-label col-md-4">Gender : </label>
                <div class="col-md-8">
                    <input type="text" name="Gender" id="Gender" class="form-control" />
            </div>
         </div>

         <!-- <div class="form-group">
            <label>Gender</label>
                <div class="row">
                <div class="col-md-4"></div>
                    <div class="form-group col-md-4" style="margin-left:2px">
                        <select name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                </div> -->

         <div class="form-group">
            <label class="control-label col-md-4">Select Profile Image : </label>
            <div class="col-md-8">
             <input type="file" name="Picture" id="Picture" />
             <span id="store_image"></span>
            </div>
        </div>
           <br/>

           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

    <script>
            $(document).ready(function(){

            $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
            url: "{{ route('Demo.index') }}",
            },
            columns:[
            {
                data: 'picture',
                name: 'picture',
                render: function(data, type, full, meta){
                return "<img src={{ URL::to('/') }}/uploads/" + data + " width='70' class='img-thumbnail' />";
                },
                orderable: false
            },
            {
                data: 'FirstName',
                name: 'FirstName'
            },
            {
                data: 'LastName',
                name: 'LastName'
            },
            {
                data: 'Email',
                name: 'Email'
            },
            {
                data: 'Hobbies',
                name: 'Hobbies'
            },
            {
                data: 'Gender',
                name: 'Gender'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
            ]
            });

            $('#create_record').click(function()
            {
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");
            $('#action').val("Add");
            $('#formModal').modal('show');
            });


        $('#sample_form').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {
        $.ajax({
            url:"{{ route('Demo.store') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function(data)
            {
            var html = '';
            if(data.errors)
            {
            html = '<div class="alert alert-danger">';
            for(var count = 0; count < data.errors.length; count++)
            {
            html += '<p>' + data.errors[count] + '</p>';
            }
            html += '</div>';
            }
            if(data.success)
            {
            html = '<div class="alert alert-success">' + data.success + '</div>';
            $('#sample_form')[0].reset();
            $('#user_table').DataTable().ajax.reload();
            }
            $('#form_result').html(html);
            }
        })
        }

        if($('#action').val() == "Edit")
        {
        $.ajax({
            url:"{{ route('Demo.update') }}",
            method:"POST",
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            success:function(data)
            {
            var html = '';
            if(data.errors)
            {
            html = '<div class="alert alert-danger">';
            for(var count = 0; count < data.errors.length; count++)
            {
            html += '<p>' + data.errors[count] + '</p>';
            }
            html += '</div>';
            }
            if(data.success)
            {
            html = '<div class="alert alert-success">' + data.success + '</div>';
            $('#sample_form')[0].reset();
            $('#store_image').html('');
            $('#user_table').DataTable().ajax.reload();
            }
            $('#form_result').html(html);
            }
        });
        }
        });

        $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        $('#form_result').html('');
        $.ajax({
        url:"/Demo/"+id+"/edit",
        dataType:"json",
        success:function(html){
            $('#FirstName').val(html.data.FirstName);
            $('#LastName').val(html.data.LastName);
            $('#Email').val(html.data.Email);
            $('#Hobbies').val(html.data.Hobbies);
            $('#Gender').val(html.data.Gender);
            $('#store_image').html("<img src={{ URL::to('/') }}/uploads/" + html.data.Picture + " width='70' class='img-thumbnail' />");
            $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.Picture+"' />");
            $('#hidden_id').val(html.data.id);
            $('.modal-title').text("Edit New Record");
            $('#action_button').val("Edit");
            $('#action').val("Edit");
            $('#formModal').modal('show');
        }
        })
        });

        var user_id;

        $(document).on('click', '.delete', function(){
        user_id = $(this).attr('id');
        $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
        $.ajax({
        url:"Demo/destroy/"+user_id,
        beforeSend:function(){
            $('#ok_button').text('Deleting...');
        },
        success:function(data)
        {
            setTimeout(function(){
            $('#confirmModal').modal('hide');
            $('#user_table').DataTable().ajax.reload();
            }, 2000);
        }
        })
        });




            });
    </script>
