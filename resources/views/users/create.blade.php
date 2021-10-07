@extends('admin.layout.master')
@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">

<div class="card card-outline-secondary mt-3">
    <div class="card-header">
      <h3 class="mb-0">User Information</h3>
    </div>
    <div class="card-body">
      <form  action="users/create" method="POST">
        
        {{ csrf_field() }}
<input type="hidden" name="_method" value="PUT">

        <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">First name</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="txtName" value="Jane">
          </div>
        </div>
       
        <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Email</label>
          <div class="col-lg-9">
            <input class="form-control" type="email" name="txtEmail" value="email@gmail.com">
          </div>
        </div>
        
        <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label">Level</label>
            <div class="col-lg-9">
              <select class="form-control" id="user_time_zone" size="0">
                <option name ="level" value="0">
                  User
                </option>
                <option  name ="level" value="1">
                  Admin
                </option>
              </select>
            </div>
          </div>
         
        <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Password</label>
          <div class="col-lg-9">
            <input class="form-control" type="password" name="txtPass" value="11111122333"> 
            
          </div>
        </div>
        <div class="form-group row">
          <label class="col-lg-3 col-form-label form-control-label">Confirm</label>
          <div class="col-lg-9">
            <input class="form-control" type="password" value="11111122333">
          </div>
        </div>
        <div class="form-group row mt-3">
          <label class="col-lg-4 col-form-label form-control-label"></label>
          <div class="col-lg-8">
            <input class="btn btn-secondary" type="" value="Cancel"> 
            <input class="btn btn-primary" type="submit" value="Save Changes">
          </div>
        </div>
      </form>
    </div>
  </div><!-- /form user info -->
</div>
</div>
</div>
</main>
</div>
@endsection