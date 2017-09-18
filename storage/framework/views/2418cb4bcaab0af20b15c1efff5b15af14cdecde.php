<?php $__env->startSection('head'); ?>
<title>Portfolios</title>
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
                <?php echo Form::open(['route' => 'admin.portfolio.post', 'files'=>true]); ?>

                    <!-- text input -->
                   <div class="form-group">
                     <?php echo Form::label('title', 'Title'); ?>

                     <?php echo Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']); ?>

                   </div>
                   
                   
                  
                    <div class="form-group">
                      <?php echo Form::label('image', 'Choose Image'); ?>

                      <?php echo Form::file('image'); ?>

                    </div>
                    
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
                  <th width="10%">Image</th>
                  <th width="5%">Edit</th>
                  <th width="5%">Delete</th>
                </tr>
                </thead>
                <tbody>
                
              <?php $__empty_1 = true; $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><h3><?php echo e($image->title); ?></h3></td>
                  <td> <img src="<?php echo e(asset('images/portfolio/thumb/' . $image->image)); ?>" class="img-responsive" width="150"></td>
                  
                  <td>
                  	 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit<?php echo e($image->id); ?>">
                    Edit
                  </button>
                   <div class="modal modal-warning fade" id="modal-edit<?php echo e($image->id); ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete?</h4>
                        </div>
                        <div class="modal-body">
                        <?php echo Form::open(['route' => ['admin.portfolio.update', $image->slug], 'files'=>true, 'method' => 'PUT']); ?>

		                    <!-- text input -->
		                   <div class="form-group">
		                     <?php echo Form::label('title', 'Title'); ?>

		                     <?php echo Form::text('title', $image->title, ['class' => 'form-control', 'placeholder' => 'Title']); ?>

		                   </div>
		                   <div class="form-group">
		                      <?php echo Form::label('image', 'Choose Image'); ?>

		                      <?php echo Form::file('image'); ?>

		                    </div>
		                   <div class="form-group">
		                   <button type="button" class="btn btn-outline" data-dismiss="modal">Cancle</button>
		                   <?php echo Form::submit('Submit', array( 'class'=>'btn btn-outline pull-right' )); ?>

                			<?php echo Form::close(); ?>

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
                 
                    
                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger<?php echo e($image->id); ?>">
                    Delete
                  </button>
                   <div class="modal modal-danger fade" id="modal-danger<?php echo e($image->id); ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Are You Sure Want To Delete?</h4>
                        </div>
                        <div class="modal-body">
                          <?php echo Form::open(['method' => 'DELETE', 'route' => ['admin.portfolio.delete', $image->slug ], 'class' => 'form-horizontal']); ?>

                          
                             
                                  <?php echo Form::submit("Delete", ['class' => 'btn btn-outline']); ?>

                                  <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cancle</button>
                           
                          
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

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>