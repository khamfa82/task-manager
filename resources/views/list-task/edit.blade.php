@extends('layouts.app')
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New List</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  action="/list-task/{{$lists->id}}" method="post" >
            @method('PUT')
                @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="listname">Listname</label>
                  <input type="text" name="listname" 
                  value="{{old('listname')? old('listname'):$lists->list_name }}" 
                  class="form-control @error('listname') is-invalid @enderror" id="name" placeholder="Enter listname">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" name="description" 
                  value="{{old('description')? old('description'):$lists->list_description }}" 
                  class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter description">
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