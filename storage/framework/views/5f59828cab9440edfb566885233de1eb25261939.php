<!-- Modal -->
<div class="modal fade modal-lg" id="RoomCreateModal_Theater_<?php echo e($theater->id); ?>" tabindex="-1" aria-labelledby="RoomCreateModalLabel"
    aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h1 class="modal-title fs-5" id="RoomCreateModalLabel"> <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.room'); ?></h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <form action="admin/room/create" method="post">
               <?php echo csrf_field(); ?>
               <div class="modal-body">
                   <div class="row">
                       <div class="col-3">
                           <div class="form-group">
                               <label for="name" class="form-label"><?php echo app('translator')->get('lang.room'); ?></label>
                               <input class="form-control" id="name" type="text" name="name" placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.room'); ?>">
                           </div>
                       </div>
                       <div class="col-3">
                           <div class="form-group">
                               <label for="row" class="form-label"><?php echo app('translator')->get('lang.row_number'); ?></label>
                               <input class="form-control" id="row" type="number" name="row" min="0" max="24"
                                      placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.row_number'); ?>">
                           </div>
                       </div>
                       <div class="col-3">
                           <div class="form-group">
                               <label for="col" class="form-control-label"><?php echo app('translator')->get('lang.col_number'); ?></label>
                               <input class="form-control" id="col" type="number" name="col" min="0" max="50"
                                      placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.col_number'); ?>">
                           </div>
                       </div>
                       <div class="col-3">
                           <div class="form-group">
                               <label for="roomType" class="form-label"><?php echo app('translator')->get('lang.room_type'); ?></label>
                               <select class="form-select" id="roomType" type="text" name="roomType">
                                   <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <option value="<?php echo e($roomType->id); ?>"><?php echo e($roomType->name); ?></option>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>
                           </div>
                       </div>
                       <input type="hidden" name="theaterId" value="<?php echo e($theater->id); ?>">
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                           data-bs-target="#TheaterEditModal<?php echo e($theater->id); ?>"><?php echo app('translator')->get('lang.close'); ?>
                   </button>
                   <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('lang.save'); ?></button>
               </div>
           </form>
       </div>
   </div>
</div>
<?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/rooms/create.blade.php ENDPATH**/ ?>