@extends('layouts.app')
@section('content')

<div class="box">
            <div class="box-header with-border">
              <a href="/users/create" class="btn btn-primary pull-right mb-4 ">
                <i class="fa fa-user-plus"></i> 
                Add New User
            </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Address</th>
                  <th>Profile Picture</th>
                  <th>Action</th>
                </tr>
                @if(count($users) > 0)
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td> 
            <td>{{$user->role->role_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->mobile}}</td>
            <td>{{$user->address}}</td>
                  <td><img src="{{('storage/profile_images/'.$user->profile)}}" alt="" height="50px"></td>
                  <td style="width:100px;">
                  <form method="post" id="deleteForm{{ $user->id }}" action="/users/{{ $user->id }}" class="text-center">
                    @method('delete')
                    @csrf
                    <a href="/users/{{ $user->id }}/edit" class="btn btn-link mr-3 p-0"><i class="fa fa-edit"></i></a>
                    <button type='button'  class="btn btn-link text-danger m-0 p-0" onclick="showModalWarning(
                            '{{ $user->id }}',
                            '{{ $user->email }}',
                            'deleteForm' + '{{ $user->id }}'
                        )" data-toggle="modal" data-target="#deleteModal">
                        
                    <i class="fa fa-trash"></i></button>
                </form>
                  </td>
                </tr>
         @endforeach
        @else
        <div class="alert alert-danger">No users found</div>
        @endif
              </tbody>
              
            </table>
            </div>
           
          </div>
  @include('inc.modals')
@endsection