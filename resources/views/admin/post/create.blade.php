@extends('admin.layout.master')
@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">

<div class="card card-outline-secondary mt-3">
    <div class="card-header">
      <h3 class="mb-0">Post Information</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('create_post') }}" method="post">
        
        {{ csrf_field() }}

        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">Title</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="title" value="{{$post->title}}">
          </div>
        </div>
       
        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">Slug</label>
          <div class="col-lg-9">
            <input class="form-control" type="text" name="slug_name" value="{{$post->slug_name}}">
          </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label form-control-label">Category</label>
            <div class="col-lg-9">
              <select class="form-control" id="user_time_zone" name ="category_id" size="0">
                @foreach($cate as $item)
                <option value='{{$item->category_id}}' >{{$item->name}}</option>
                @endforeach
                
              </select>
              
            </div>
          </div>
        <div class="form-group row mb-3">
        <label class="col-lg-3 col-form-label form-control-label">Detail</label>
        <div class="col-lg-9">
            <textarea class="form-control" name="detail" id="exampleFormControlTextarea1" rows="3"></textarea>
              
        </div>
        </div>
        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">image</label>
          <div class="col-lg-9">
            
                <input type="file" name="image" width='150px' class='form-control'>
            
            
          </div>
        </div>
        <fieldset class="form-group mb-3" >
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0 col-lg-3">Enable</legend>
              <div class="col-sm-10 col-lg-9">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="voucher_enabled" id="gridRadios1" value="0" checked>
                  <label class="form-check-label" for="gridRadios1">
                    Show
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="voucher_enabled" id="gridRadios2" value="1">
                  <label class="form-check-label" for="gridRadios2">
                    Hidden
                  </label>
                </div>
               
              </div>
            </div>
          </fieldset>
        <div class="form-group row mb-3">
          <label class="col-lg-3 col-form-label form-control-label">Quantity</label>
          <div class="col-lg-9">
            <input class="form-control" type="number" name="voucher_quantity" value="{{$post->voucher_quantity}}">
          </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label form-control-label">Code</label>
            <div class="col-lg-9">
              <input class="form-control" type="input" name="code" value="{{$post->code}}">
            </div>
          </div>
        <div class="form-group row mt-3 mb-3">
          <label class="col-lg-4 col-form-label form-control-label"></label>
          <div class="col-lg-8">
            <input class="btn btn-secondary"  onclick="location.href='{{route('list_posts')}}'" type="" value="Cancel"> 
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
    <input type="hidden" name="post_id" value="{{$post->post_id}}"/>
      </form>
     
      
    </div>
  </div><!-- /form user info -->
</div>
</div>
</div>
</main>
</div>
@endsection