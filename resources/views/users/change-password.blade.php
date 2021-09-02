@extends('layouts.app')
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change User Password</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/change-password" method="post" enctype="multipart/form-data">
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="currentpassword">Current Password</label>
                  <input type="text" name="password" class="form-control @error('password') is-invalid @enderror"
                  id="currentpassword" placeholder="Enter Current Password">
                </div>
                <div class="form-group">
                  <label for="newpassword">New Password</label>
                  <input type="password" name="newpassword" class="form-control @error('newpassword') is-invalid @enderror"
                   id="newpassword" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                  <label for="confirmpassword">Confirm Password</label>
                  <input type="password" name="confirmpassword" class="form-control @error('confirmpassword') is-invalid @enderror"
                   id="confirmpassword" placeholder="Enter Confirm Password">
                </div>
               
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    Save Change
                </button>
              </div>
            </form>
          </div>


@endsection