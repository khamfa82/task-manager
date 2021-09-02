@extends('layouts.app')
@section('content')

<div class="box">
            <div class="box-header with-border">
              <a href="/tasks/create" class="btn btn-primary pull-right mb-4 ">
                <i class="fa fa-user-plus"></i> 
                Add New Task
            </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
               <thead>
                    <tr>
                        <th>#</th>
                        <th>Task Name</th>
                        <th>Priority</th>
                        <th>Deadline</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                   <tbody>
                                @if(count($tasks) > 0)
                        @foreach($tasks as $task)

                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->task_name}}</td> 
                            <td>{{$task->priority}}</td>
                            <td>{{$task->deadline}}
                                <br>
                                <b>
                                    {{ $task->remaining_days }} day(s) left
                                </b>    
                            </td>
                            <td>{{$task->task_description}}</td>
                                <td style="width:100px;">
                                <form method="post" id="deleteForm{{ $task->id }}" action="/tasks/{{ $task->id }}" class="text-center">
                                    @method('delete')
                                    @csrf
                                    <a href="/tasks/{{ $task->id }}/edit" class="btn btn-link mr-3 p-0"><i class="fa fa-edit"></i></a>
                                    <button type='button'  class="btn btn-link text-danger m-0 p-0" onclick="showModalWarning(
                                            '{{ $task->id }}',
                                            '{{ $task->task_name }}',
                                            'deleteForm' + '{{ $task->id }}'
                                        )" data-toggle="modal" data-target="#deleteModal">
                                        
                                    <i class="fa fa-trash"></i></button>
                                </form>
                                </td>
                                </tr>
                            @endforeach
                    
                            @endif
                    </tbody>
              </table>
            </div>
           
          </div>
  @include('inc.modals')
@endsection