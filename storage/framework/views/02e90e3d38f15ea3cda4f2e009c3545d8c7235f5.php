<form action="admin/staff/edit/<?php echo e($value->id); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="editStaff<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="staff_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staff_title"><?php echo app('translator')->get('lang.staff'); ?> <?php echo e($value->fullname); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('lang.name'); ?></label>
                                    <input aria-label="" id="fn" class="form-control" type="text" value="<?php echo e($value->fullname); ?>" name="fullname"
                                           placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.name'); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input aria-label="" id="e" class="form-control" type="email" value="<?php echo e($value->email); ?>" name="email"
                                           placeholder="<?php echo app('translator')->get('lang.type'); ?> email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('lang.phone'); ?></label>
                                    <input aria-label="" id="p" class="form-control" type="text" value="<?php echo e($value->phone); ?>" name="phone"
                                           placeholder="<?php echo app('translator')->get('lang.phone'); ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('lang.theater'); ?></label>
                                    <select id="theater" aria-label="" class="form-control" name="theater_id">
                                        <option value="Admin">Admin</option>
                                        <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($theater->id); ?>"
                                            <?php if($value->theater_id == $theater->id): ?>
                                                selected
                                            <?php endif; ?>
                                                ><?php echo e($theater->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('lang.role'); ?></label>
                                    <select id="role" aria-label="" class="form-control" name="role_id">
                                        <?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>"
                                            <?php if($value->role_id == $role->id): ?>
                                                selected
                                            <?php endif; ?>
                                                ><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
                    <button type="submit" class="btn bg-gradient-info"><?php echo app('translator')->get('lang.save'); ?></button>
                </div>
            </div>
        </div>
    </div>
</form>     <?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Staffs/edit.blade.php ENDPATH**/ ?>