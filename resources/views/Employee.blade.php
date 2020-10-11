<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee page</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

    <div class = 'container'>
        <div class="jumbotron">
            <h1>Employee CRUD</h1><br>
                <form action= "{{ route ( 'addimage') }}" method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="FirstName"class="form-control" placeholder="Enter first name">
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="LastName" class="form-control" placeholder="Enter last name">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control" placeholder="Enter email">
                    </div>


                    <div class="form-group">
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
                     </div>


            <div class="form-group">
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
                </div>

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="Picture" class="custom-file-input">
                            <label  class="custom-file-label">Choose file</label>
                        </div>
                    </div>


                    <button type="submit" name="submit" class="btn-btn-primary">Save</button>

                </form>
            </div>
    </div>

</body>
</html>
