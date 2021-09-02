@extends('layouts.app')
@section('content')

<div class="box">
            <div class="box-header with-border">
              <a href="/list-task/create" class="btn btn-primary pull-right mb-4 ">
                <i class="fa fa-file-text"></i> 
                Add New List
            </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                    <tr>
                  <th>#</th>
                  <th>List Name</th>
                  <th>Description</th> 
                  <th>Action</th>
                </tr>
                @if(count($lists) > 0)
        @foreach($lists as $list)
        <tr>
            <td>{{$list->id}}</td>
            <td>{{$list->list_name}}</td> 
            <td>{{$list->list_description}}</td>
             <td style="width:100px;">
                  <form method="post" id="deleteForm{{ $list->id }}" action="/list-task/{{ $list->id }}" class="text-center">
                    @method('delete')
                    @csrf
                    <a href="/list-task/{{ $list->id }}/edit" class="btn btn-link mr-3 p-0"><i class="fa fa-edit"></i></a>
                    <button type='button'  class="btn btn-link text-danger m-0 p-0" onclick="showModalWarning(
                            '{{ $list->id }}',
                            '{{ $list->list_name }}',
                            'deleteForm' + '{{ $list->id }}'
                        )" data-toggle="modal" data-target="#deleteModal">
                        
                    <i class="fa fa-trash"></i></button>
                </form>
                  </td>
                </tr>
         @endforeach
        @else
        <div class="alert alert-danger">No list found</div>
        @endif
              </tbody>
              
            </table>
            </div>
           
          </div>
  @include('inc.modals')
@endsection