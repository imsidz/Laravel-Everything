<?php $__env->startSection('head'); ?>
<title><?php echo e($slider->title); ?> | Edit</title>
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
                  <h3 class="box-title">Slider Content</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php echo e(Form::model($slider, array('route' => array('admin.slider.update', $slider->title), 'method' => 'PUT', 'files' => true))); ?>

                    <!-- text input -->
                   <div class="form-group">
                     <?php echo Form::label('title', 'Title'); ?>

                     <?php echo Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']); ?>

                   </div>
                  <div class="form-group">
                     <?php echo Form::label('content', 'Content'); ?>

                     <?php echo Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content']); ?>

                   </div>
                   <div class="row">
                   		<div class="col-md-2 col-xs-6">
                   			<div class="form-group">
			                    <?php echo Form::label('image', 'Change Image'); ?>

			                    <?php echo Form::file('image'); ?>

		                    </div>
                   		</div>
                   		<div class="col-md-10 col-xs-6">
                   			<img src="<?php echo e(secure_asset('images/slider/thumb/' . $slider->image )); ?>" class="img-responsive" width="150">
                   			<?php echo e($slider->image); ?>

                   		</div>
                   </div>
                 <?php echo Form::submit('Submit', array( 'class'=>'btn btn-info' )); ?>

                <?php echo Form::close(); ?>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>