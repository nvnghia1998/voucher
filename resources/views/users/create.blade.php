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
      <form action="{{ route('create_users') }}" method="post">
        
        {{ csrf_field() }}

        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">First name</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="txtName" value="{{$user->name}}">
          </div>
        </div>
       
        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">Email</label>
          <div class="col-lg-9">
            <input class="form-control" type="email" name="txtEmail" value="{{$user->email}}">
          </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label form-control-label">Level</label>
            <div class="col-lg-9">
              <select class="form-control" id="user_time_zone" name ="level" size="0">
                <option  value="0">
                  User
                </option>
                <option   value="1">
                  Admin
                </option>
              </select>
            </div>
          </div>
         
        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">Password</label>
          <div class="col-lg-9">
            <input class="form-control" type="password" name="txtPass" value=""> 
            
          </div>
        </div>
        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">Confirm</label>
          <div class="col-lg-9">
            <input class="form-control" type="password" value="">
          </div>
        </div>
        <div class="form-group row mt-3 mb-3">
          <label class="col-lg-4 col-form-label form-control-label"></label>
          <div class="col-lg-8">
            <input class="btn btn-secondary"  onclick="location.href='{{route('list_users')}}'" type="" value="Cancel"> 
            <input class="btn btn-primary" type="submit" value="Save Changes">
          </div>
        </div>
        @if (count($errors) >0)
        <ul>
            @foreach($errors->all() as $error)
                <li class="text-danger"> {{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <input type="hidden" name="id" value="{{$user->id }}"/>
      </form>
     
      
    </div>
  </div><!-- /form user info -->
</div>
</div>
</div>
</main>
</div>
@endsection