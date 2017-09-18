@extends('admin.layout')

@section('head')
<title>Videos</title>
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
        Videos
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Videos</li>
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
              <h3 class="box-title">Add Videos</h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add-blog">
                Add Videos
              </button>
             
            </div>
          </div>
        </div>
      </div>
       
        <div class="modal fade" id="modal-add-blog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Blog</h4>
              </div>
              <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'route' => 'admin.video.post']) !!}
                
                    <div class="form-group{{ $errors->has('videoid') ? ' has-error' : '' }}">
                        {!! Form::label('videoid', 'Youtube Link') !!}
                        {!! Form::text('videoid', null, ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'https://www.youtube.com/watch?v=abcdefghij']) !!}
                        <small class="text-danger">{{ $errors->first('videoid') }}</small>
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
              <h3 class="box-title">Video's Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @forelse($videos->chunk(4) as $chunk)
                <div class="row">
                    @foreach($chunk as $video)
                      <div class="col-md-3">
                          <div class="thumbnail">
                            <a href="#" data-toggle="modal" data-target="#video{{ $video->id }}">  <img width="800" height="600" src="{!! Youtube::getVideoInfo($video->videoid)->snippet->thumbnails->high->url !!}" class="img-responsive img-full" alt="" />
                              </a>
                              <h3>{!! str_limit(Youtube::getVideoInfo($video->videoid)->snippet->title, $limit = 30, $end = '...')   !!}</h3>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#videodelete{{ $video->id }}">
                                Delete
                              </button>
                              
                          </div>
                      </div>
                <div class="modal modal-danger fade" id="videodelete{{ $video->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Are You Sure Want to Delete this video</h4>
                       
                      </div>
                      <div class="modal-body">
                        <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.video.delete', $video->videoid]]) !!}
                              
                                  
                                  <div class="btn-group">
                                      {!! Form::submit("Delete", ['class' => 'btn btn-outline']) !!}
                                  </div>
                              
                              {!! Form::close() !!}
                      </div>
                     
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <div class="modal fade" id="video{{ $video->id }}">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{!! Youtube::getVideoInfo($video->videoid)->snippet->title  !!}</h4>
                        
                      </div>
                      <div class="modal-body">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$video->videoid}}"></iframe>
                        </div>
                        <h4>{!! Markdown::parse(Youtube::getVideoInfo($video->videoid)->snippet->description)  !!}</h4>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                       
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                    @endforeach
                </div>
              @empty
              @endforelse
            </div>
            <!-- /.box-body -->
          </div>
     
       
    </section>
    <!-- /.content -->

@endsection