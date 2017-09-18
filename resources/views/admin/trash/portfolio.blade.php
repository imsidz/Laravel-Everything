@extends('admin.layout')

@section('head')
<title>Portfolios</title>
@section('content')


    <section class="content-header">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
              @endif

              @if (session('warning'))
                <div class="alert alert-danger ">
                {{ session('warning') }}
            </div>
              @endif
            <div class="alert-warning">
              @foreach( $errors->all() as $error )
                {{ $error }}<br>
              @endforeach
            </div>
    </section>
         <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Portfolios
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Portfolios</li>
      </ol>
    </section>

        <div class="modal modal-primary fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Primary Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    <!-- Main content -->
     <!-- Main content -->
    <section class="content">

      
       

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Portfolio Trash Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="20%">Title</th>
                  <th width="10%">Image</th>
                  <th width="5%">Edit</th>
                  <th width="5%">Delete</th>
                </tr>
                </thead>
                <tbody>
                
               @forelse($portfolios as $image)
                <tr>
                  <td>{{ $image->title }}</td>
                  </td>
                  <td> <img src="{{ asset('images/portfolio/thumb/' . $image->image) }}" class="img-responsive" width="150"></td>
                  <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#restore">
                    Restore
                  </button>
                   <div class="modal modal-success fade" id="restore">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Restore</h4>
                        </div>
                        <div class="modal-body">
                          <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancle</button>
                          {!! Form::open(['method' => 'POST', 'route' => ['admin.portfolio.restore', $image->slug] ]) !!}
                          {!! Form::submit('Restore', ['class' => 'btn btn-outline']) !!}
                          {!! Form::close() !!}
                        </div>
                        
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  </td>
                  <td>
                 
                    
                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">
                    Delete
                  </button>
                   <div class="modal modal-danger fade" id="modal-danger">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete? This will be Permanent</h4>
                        </div>
                        <div class="modal-body">
                          <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancle</button>
                          {!! Form::open(['method' => 'DELETE', 'route' => ['admin.portfolio.parmadelete', $image->slug] ]) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-outline']) !!}
                          {!! Form::close() !!}
                        </div>
                        
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                 
                </td>
                </tr>
                @empty
                <center><h2>No Deleted Portfolio Yet</h2></center>
                @endforelse
                 </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
     
       
    </section>
    <!-- /.content -->
        
@endsection