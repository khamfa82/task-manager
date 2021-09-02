@extends('layouts.app')
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/users" method="post" enctype="multipart/form-data">
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Fullname</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter fullname">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Enter mobile">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" name="address" value="{{old('address')}}" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address">
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control" name="role">
                  @if(count($roles)>0)
                   @foreach($roles as $role)
                    <option value="{{ $role->id}}">{{ $role->role_name}}</option>
                                    
                    @endforeach
                     @endif
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="profile">File input</label>
                  <input type="file" name="image" id="profile">
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
              </div>
            </form>
          </div>


@endsection