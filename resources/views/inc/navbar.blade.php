<?php
$url = explode('/', url()->current());
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>TMS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
      <!-- Notifications: style can be found in dropdown.less -->
      <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ Auth::guest() ? "N/A" : Auth::user()->name }}
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="/change-profile">
                    <i class="fa fa-user mr-2"></i> Profile        
                    </a>
                  </li>
                 
                  <li>
                    <a href="/change-password">
                    <i class="fa fa-lock mr-2"></i> Change Password
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    <form action="/logout" method="POST">
                      @csrf
                      <i class="fa fa-sign-out "></i>
                      <button class="btn btn-link">Logout</button>
                    </form>
                  </a>
                  </li>
               
                </ul>
             
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <img src="{{Auth::user()->profile== NULL ? url('images/default.jpg') : url('storage/profile_images/'.Auth::user()->profile)}}"
         style="height: 40px !important; width: auto !important" class="img-circle elevation-2" alt="User Image">
      </div>
        <div class="pull-left info">
          <p style="color: white;">
          {{Auth::guest() ? '' : Auth::user()->role->role_name }}
          </p>
          <a href="/"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="nav-link @if(array_search('dashboard' , $url)) active @endif">
          <a href="/dashboard" >
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="">
          <a href="/list-task">
            <i class="fa fa-dashboard"></i> <span>Manage Lists</span>
          </a>
        </li>
        @foreach($menuLists as $list)
        <li class="">
          <a href="/tasks?list={{$list->id}}">
            <i class="fa fa-dashboard"></i> <span>{{$list->list_name}}</span>
          </a>
        </li>
       @endforeach
        <li class=" nav-link @if(array_search('tasks' , $url)) active @endif" >
          <a href="/tasks">
            <i class="fa fa-list"></i> <span>Manage Tasks</span>
          </a>
        </li>
        <li class=" nav-link @if(array_search('users' , $url)) active @endif">
          <a href="/users" >
            <i class="fa fa-user"></i> <span>Manage Users</span>
          </a>
        </li>
      </ul>
         
    <!-- /.sidebar -->
  </aside>