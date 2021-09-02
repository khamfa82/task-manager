@extends('layouts.app')
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/users/{{$user->id}}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Fullname</label>
                  <input type="text" name="name" value="{{old('name')? old('name'):$user->name}}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter fullname">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" name="email" value="{{old('email')? old('email'):$user->email}}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" name="mobile" value="{{old('mobile')? old('mobile'):$user->mobile}}" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Enter mobile">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" name="address" value="{{old('address')? old('address'):$user->address}}" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address">
                </div>
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control" name="role">
                  @if(count($roles)>0)
                   @foreach($roles as $role)
                    <option value="{{ $role->id}}" @if($role->id==$user->role_id)selected @endif>
                        {{ $role->role_name}}
                    </option>
                                    
                    @endforeach
                     @endif
                    
                  </select>
                </div>
                <div class="row">
                    <div class="col-md-2">
                    <div class="form-group">
                  <label for="profile">File input</label>
                  <input type="file" name="image" id="profile">
                    </div>
                    </div>
                    <div class="col-md-1">
                  <!--code za ku display image-->
                  @if($user->profile!=NULL)
                    <label for="profile">
                      <img class="img-thumbnail" src="{{url('storage/profile_images/'.$user->profile)}}" alt="" style="width:80px;">
                    </label>
                    @else
                    <label for="profile">
                      <img class="img-thumbnail" src="{{url('images/default.jpg')}}" alt="" style="width:80px;">
                    </label>
                    @endif
                </div>
                </div><!--end of row-->
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
              </div>
            </form>
          </div>


@endsection