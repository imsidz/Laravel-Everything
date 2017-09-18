<?php $__env->startSection('head'); ?>
<title>Blogs</title>
<?php $__env->startSection('content'); ?>


    <section class="content-header">
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
              <?php endif; ?>

              <?php if(session('warning')): ?>
                <div class="alert alert-danger ">
                <?php echo e(session('warning')); ?>

            </div>
              <?php endif; ?>
            <div class="alert-warning">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($error); ?><br>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
    </section>
         <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blogs
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Blogs</li>
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
              <h3 class="box-title">Add Blog</h3>
            </div>
            <div class="box-body">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Add Blog
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
                <h4 class="modal-title">Add Blog</h4>
              </div>
              <div class="modal-body">
                <?php echo Form::open(['route' => 'admin.blog.post', 'files'=>true]); ?>

                    <!-- text input -->
                   <div class="form-group">
                     <?php echo Form::label('title', 'Title'); ?>

                     <?php echo Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']); ?>

                   </div>
                    <div class="form-group">
                      <?php echo Form::label('description', 'Please Type Here Content'); ?>

                      <?php echo Form::textarea('content', null, ['class'=>'ckeditor', 'id'=>'my-editor']); ?>

                    </div>
                    <div class="form-group">
                      <label>Category</label>
                      <select name="tag[]" class="form-control select2" multiple="multiple" data-placeholder="Select Categories"
                              style="width: 100%;">
                        <?php $__empty_1 = true; $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <option><?php echo e($tag->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                      </select>
                    </div>
                   <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                        <?php echo Form::label('published_at', 'Publish On'); ?>

                        <?php echo Form::input('date', 'published_at', date('Y-m-d'), ['class'=>'form-control']); ?>

                      </div>
                     </div>
                   </div>
                    <div class="form-group">
                      <?php echo Form::label('image', 'Choose Image'); ?>

                      <?php echo Form::file('image'); ?>

                    </div>
                    <?php $__env->startPush('scripts'); ?>
                <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
                <script>
                  var options = {
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/upload?type=Images&_token=<?php echo e(csrf_token()); ?>',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/upload?type=Files&_token=<?php echo e(csrf_token()); ?>'
                  };
                  CKEDITOR.replace('my-editor', options);
                </script>
                <?php $__env->stopPush(); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php echo Form::submit('Submit', array( 'class'=>'btn btn-info' )); ?>

                <?php echo Form::close(); ?>

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
                  <th width="60%">Content</th>
                  <th width="10%">Image</th>
                  <th width="10%">Tags</th>
                  <th width="5%">Edit</th>
                  <th width="5%">Delete</th>
                </tr>
                </thead>
                <tbody>
                
               <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><?php echo e($blog->title); ?></td>
                  <td><?php echo Markdown::parse(str_limit($blog->content, 50)); ?>

                  </td>
                  <td> <img src="<?php echo e(asset('images/blog/thumb/' . $blog->image)); ?>" class="img-responsive" width="150"></td>
                  <td>
                    <ul>
                      <?php $__empty_2 = true; $__currentLoopData = $blog->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                      <li><?php echo e($tag->name); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                      <?php endif; ?>
                    </ul>
                  </td>
                  <td><a href="<?php echo e(url('admin/blog/' . $blog->slug . '/edit')); ?>"> <button class="btn btn-warning">Edit</button></a></td>
                  <td>
                 
                    
                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger<?php echo e($blog->slug); ?>">
                    Delete
                  </button>
                   <div class="modal modal-danger fade" id="modal-danger<?php echo e($blog->slug); ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete?</h4>
                        </div>
                        <div class="modal-body">
                          <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancle</button>
                          <?php echo Form::open(['method' => 'DELETE', 'route' => ['admin.blog.delete', $blog->slug] ]); ?>

                          <?php echo Form::submit('Delete', ['class' => 'btn btn-outline']); ?>

                          <?php echo Form::close(); ?>

                        </div>
                        
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                 
                </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <center><h2>No Blogs Posted Yet</h2></center>
                <?php endif; ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
     
       
    </section>
    <!-- /.content -->
<?php $__env->startPush('scripts'); ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>