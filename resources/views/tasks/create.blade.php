@extends('layouts.app')
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Task</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="/tasks" method="post" enctype="multipart/form-data">
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="taskname">Taskname</label>
                  <input type="text" name="taskname" value="{{old('taskname')}}" class="form-control @error('taskname') is-invalid @enderror" id="taskname" placeholder="Enter taskname">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" name="description" value="{{old('description')}}" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description">
                </div>
                <div class="form-group">
                  <label for="priority">Priority</label>
                  <select class="form-control" name="priority">
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="deadline">Deadline</label>
                  <input type="date" name="deadline" value="{{old('deadline')}}" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address">
                </div>
                <div class="form-group">
                  <label for="listname">Listname</label>
                  <select class="form-control" name="listname">
                  @if(count($lists)>0)
                   @foreach($lists as $list)
                    <option value="{{ $list->id}}">{{ $list->list_name}}</option>
                                    
                    @endforeach
                     @endif
                    
                  </select>
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