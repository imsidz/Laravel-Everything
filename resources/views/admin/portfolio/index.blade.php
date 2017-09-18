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

       
    <!-- Main content -->
     <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Add Portfolios</h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Add Portfolios
              </button>
             
            </div>
          </div>
        </div>
      </div>
       
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Portfolio Images</h4>
              </div>
              <div class="modal-body">
                {!! Form::open(['route' => 'admin.portfolio.post', 'files'=>true])   !!}
                    <!-- text input -->
                   <div class="form-group">
                     {!! Form::label('title', 'Title') !!}
                     {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                   </div>
                   
                   
                  
                    <div class="form-group">
                      {!! Form::label('image', 'Choose Image') !!}
                      {!! Form::file('image') !!}
                    </div>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                {!! Form::submit('Submit', array( 'class'=>'btn btn-info' )) !!}
                {!! Form::close() !!}
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sliders Data</h3>
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
                  <td><h3>{{ $image->title }}</h3></td>
                  <td> <img src="{{ asset('images/portfolio/thumb/' . $image->image) }}" class="img-responsive" width="150"></td>
                  
                  <td>
                  	 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit{{ $image->id }}">
                    Edit
                  </button>
                   <div class="modal modal-warning fade" id="modal-edit{{ $image->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete?</h4>
                        </div>
                        <div class="modal-body">
                        {!! Form::open(['route' => ['admin.portfolio.update', $image->slug], 'files'=>true, 'method' => 'PUT'])   !!}
		                    <!-- text input -->
		                   <div class="form-group">
		                     {!! Form::label('title', 'Title') !!}
		                     {!! Form::text('title', $image->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
		                   </div>
		                   <div class="form-group">
		                      {!! Form::label('image', 'Choose Image') !!}
		                      {!! Form::file('image') !!}
		                    </div>
		                   <div class="form-group">
		                   <button type="button" class="btn btn-outline" data-dismiss="modal">Cancle</button>
		                   {!! Form::submit('Submit', array( 'class'=>'btn btn-outline pull-right' )) !!}
                			{!! Form::close() !!}
                			</div>
                          
                          
                        </div>
                        
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  </td>
                  <td>
                 
                    
                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{ $image->id }}">
                    Delete
                  </button>
                   <div class="modal modal-danger fade" id="modal-danger{{ $image->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete?</h4>
                        </div>
                        <div class="modal-body">
                          {!! Form::open(['method' => 'DELETE', 'route' => ['admin.portfolio.delete', $image->slug ], 'class' => 'form-horizontal']) !!}
                          
                             
                                  {!! Form::submit("Delete", ['class' => 'btn btn-outline']) !!}
                                  <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancle</button>
                           
                          
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
                <center><h2>No Blogs Posted Yet</h2></center>
               @endforelse
              </table>
            </div>
            <!-- /.box-body -->
          </div>
     
       
    </section>
    <!-- /.content -->
@push('scripts')

@endpush
@endsection