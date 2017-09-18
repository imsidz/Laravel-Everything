<?php $__env->startSection('head'); ?>
<title><?php echo e($blog->title); ?> | Edit</title>
<?php $__env->startSection('content'); ?>
        <section class="content">
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
          <div class="row">
            <!-- right column -->
            <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">blog Content</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php echo e(Form::model($blog, array('route' => array('admin.blog.update', $blog->slug), 'method' => 'PUT', 'files' => true))); ?> <!-- text input -->
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
                        <option value="<?php echo e($tag->name); ?>"><?php echo e($tag->name); ?></option>
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
                    filebrowserImageBrowseUrl: '<?php echo e(url('filemanager')); ?>?type=Images',
                    filebrowserImageUploadUrl: '<?php echo e(url('upload')); ?>?type=Images&_token=<?php echo e(csrf_token()); ?>',
                    filebrowserBrowseUrl: '<?php echo e(url('filemanager')); ?>?type=Files',
                    filebrowserUploadUrl: '<?php echo e(url('upload')); ?>?type=Files&_token=<?php echo e(csrf_token()); ?>'
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
                <?php $__env->stopPush(); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <?php echo Form::submit('Submit', array( 'class'=>'btn btn-info' )); ?>

                <?php echo Form::close(); ?>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>