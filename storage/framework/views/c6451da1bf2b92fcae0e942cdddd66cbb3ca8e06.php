<?php $__env->startSection('head'); ?>
<title>Videos</title>
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

      
       

         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Videos Data</h3>
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
                
               <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><?php echo Youtube::getVideoInfo($video->videoid)->snippet->title; ?>

                    <hr>
                    <?php echo Markdown::parse(Youtube::getVideoInfo($video->videoid)->snippet->description); ?>

                  </td>
                 
                  <td> <img width="800" height="600" src="<?php echo Youtube::getVideoInfo($video->videoid)->snippet->thumbnails->high->url; ?>" class="img-responsive img-full" alt="" /></td>
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