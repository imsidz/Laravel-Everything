@extends('admin.layout')

@section('head')
<title>{{ $blog->title }} | Edit</title>
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
                  <h3 class="box-title">blog Content</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  {{ Form::model($blog, array('route' => array('admin.blog.update', $blog->slug), 'method' => 'PUT', 'files' => true)) }} <!-- text input -->
                   <div class="form-group">
                     {!! Form::label('title', 'Title') !!}
                     {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                   </div>
                    <div class="form-group">
                      {!! Form::label('description', 'Please Type Here Content') !!}
                      {!! Form::textarea('content', null, ['class'=>'ckeditor', 'id'=>'my-editor']) !!}
                    </div>
                    <div class="form-group">
                      <label>Category</label>
                      <select name="tag[]" class="form-control select2" multiple="multiple" data-placeholder="Select Categories"
                              style="width: 100%;">
                        @forelse($tags as $tag)
                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                        @empty
                        @endforelse
                      </select>
                    </div>
                   <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                        {!! Form::label('published_at', 'Publish On') !!}
                        {!! Form::input('date', 'published_at', date('Y-m-d'), ['class'=>'form-control']) !!}
                      </div>
                     </div>
                   </div>
                    <div class="form-group">
                      {!! Form::label('image', 'Choose Image') !!}
                      {!! Form::file('image') !!}
                    </div>
                    @push('scripts')
                <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
                <script>
                  var options = {
                    filebrowserImageBrowseUrl: '{{ url('filemanager')}}?type=Images',
                    filebrowserImageUploadUrl: '{{ url('upload')}}?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '{{ url('filemanager')}}?type=Files',
                    filebrowserUploadUrl: '{{ url('upload')}}?type=Files&_token={{csrf_token()}}'
                  };
                  CKEDITOR.replace('my-editor', options);
                </script>
                <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    
   
    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
                @endpush
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                {!! Form::submit('Submit', array( 'class'=>'btn btn-info' )) !!}
                {!! Form::close() !!}
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
@endsection