@extends('admin.layout')

@section('head')
<title>Blog | Tags</title>
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
        Tags
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Tags</li>
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

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Add More Tags</h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Add More Tags
              </button>
             
            </div>
          </div>
        </div>
      </div>
       
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Slider</h4>
              </div>
              <div class="modal-body">
                {!! Form::open(['route' => 'admin.tag.blog.post', 'files'=>false])   !!}
                    <!-- text input -->
                   <div class="form-group">
                     {!! Form::label('name', 'Tags') !!}
                     {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tags']) !!}
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
              <h3 class="box-title">Tags Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="20%">Name</th>
                  <th width="5%">Edit</th>
                  <th width="5%">Delete</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tags as $tag)
              
                <tr>
                  
                 
                  <td> <h2>{{ $tag->name }}</h2></td>
                  <td>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit{{$tag->id}}">
                    Edit
                  </button>
                   <div class="modal modal-warning fade" id="modal-edit{{$tag->id }}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete?</h4>
                        </div>
                        <div class="modal-body">
                        {!! Form::open(['url' => 'admin/tags/blog/'. $tag->name, 'method' => 'PUT', 'files'=>false])   !!}
	                    <!-- text input -->
	                   <div class="form-group">
	                     {!! Form::label('name', 'Tags') !!}
	                     {!! Form::text('name', $tag->name, ['class' => 'form-control', 'placeholder' => 'Tags']) !!}
	                   </div>
                          <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancle</button>
                           {!! Form::submit('Edit', array( 'class'=>'btn btn-outline' )) !!}
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
                 
                    
                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{$tag->id}}">
                    Delete
                  </button>
                   <div class="modal modal-danger fade" id="modal-danger{{$tag->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete?</h4>
                        </div>
                        <div class="modal-body">
                          <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancle</button>
                           {!! Form::open(['method' => 'DELETE', 'route' => ['admin.tag.blog.delete', $tag->name] ]) !!}
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
                <center><h2>No Tags Added Yet</h2></center>
               	@endforelse
              </table>
            </div>
            <!-- /.box-body -->
          </div>
     
       
    </section>
    <!-- /.content -->
@endsection