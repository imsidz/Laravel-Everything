<?php $__env->startSection('head'); ?>
<title>Sliders</title>
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
        Sliders
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Sliders</li>
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
                  <th width="5%">Edit</th>
                  <th width="5%">Delete</th>
                </tr>
                </thead>
                <tbody>
                
               <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><?php echo e($blog->title); ?></td>
                  <td> <?php echo Markdown::parse(str_limit($blog->content, 100)); ?>

                  </td>
                  <td> <img src="<?php echo e(asset('images/blog/thumb/' . $blog->image)); ?>" class="img-responsive" width="150"></td>
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
                          <?php echo Form::open(['method' => 'POST', 'route' => ['admin.blog.restore', $blog->slug] ]); ?>

                          <?php echo Form::submit('Restore', ['class' => 'btn btn-outline']); ?>

                          <?php echo Form::close(); ?>

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
                          <?php echo Form::open(['method' => 'DELETE', 'route' => ['admin.blog.permadelete', $blog->slug] ]); ?>

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
                <center><h2>No Deleted Slider Yet</h2></center>
                <?php endif; ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
     
       
    </section>
    <!-- /.content -->
         
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>