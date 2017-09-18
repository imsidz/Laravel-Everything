@extends('admin.layout')

@section('head')
<title>{{ $slider->title }} | Edit</title>
@section('content')
        <section class="content">
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
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Slider Content</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {{ Form::model($slider, array('route' => array('admin.slider.update', $slider->title), 'method' => 'PUT', 'files' => true)) }}{{-- Form model binding to automatically populate our fields with user data --}}
                    <!-- text input -->
                   <div class="form-group">
                     {!! Form::label('title', 'Title') !!}
                     {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                   </div>
                  <div class="form-group">
                     {!! Form::label('content', 'Content') !!}
                     {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}
                   </div>
                   <div class="row">
                   		<div class="col-md-2 col-xs-6">
                   			<div class="form-group">
			                    {!! Form::label('image', 'Change Image') !!}
			                    {!! Form::file('image') !!}
		                    </div>
                   		</div>
                   		<div class="col-md-10 col-xs-6">
                   			<img src="{{ asset('images/slider/thumb/' . $slider->image )}}" class="img-responsive" width="150">
                   			{{ $slider->image }}
                   		</div>
                   </div>
                 {!! Form::submit('Submit', array( 'class'=>'btn btn-info' )) !!}
                {!! Form::close() !!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
@endsection