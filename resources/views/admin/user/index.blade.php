@extends('admin.layout')

@section('head')
<title>User's</title>


@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                
               @foreach($users as $user)
                <tr>
                  <td>{{ $user->name}}</td>
                  <td> Username
                  </td>
                  <td>{{ $user->email}}</td>
                  <td><a href="{{ url('admin/user/' . $user->id )}}"> <button class="btn btn-warning">Edit</button></a></td>
                  <td><button class="btn btn-danger">Delete</button></td>
                </tr>
              	@endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection