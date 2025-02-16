<form action="admin/discount/edit/<?php echo $value['id']; ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="editDiscount<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="discount_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discount_title"><?php echo app('translator')->get('lang.code'); ?>: <?php echo $value['code']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="code" class="form-control-label"><?php echo app('translator')->get('lang.name'); ?></label>
                                    <input class="form-control" id="name" type="text" value="<?php echo $value['name']; ?>" name="name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="code" class="form-control-label"><?php echo app('translator')->get('lang.code'); ?></label>
                                    <input class="form-control" id="code" type="text" value="<?php echo $value['code']; ?>" name="code">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="percent" class="form-control-label"><?php echo app('translator')->get('lang.percent'); ?></label>
                                    <input class="form-control" id="percent" type="number" value="<?php echo $value['percent']; ?>" name="percent">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity" class="form-control-label"><?php echo app('translator')->get('lang.quantity'); ?></label>
                                    <input class="form-control" id="quantity" type="number" value="<?php echo $value['quantity']; ?>" name="quantity" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="releaseDate"><?php echo app('translator')->get('lang.release_date'); ?></label>
                                    <input name="startTime"  id="releaseDate" class="form-control datepicker" value="<?php echo e($value->startTime); ?>" placeholder="<?php echo app('translator')->get('lang.date'); ?>" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="endDate"><?php echo app('translator')->get('lang.end_date'); ?></label>
                                    <input id="endDate" name="endTime" class="form-control datepicker" value="<?php echo e($value->endTime); ?>" placeholder="<?php echo app('translator')->get('lang.date'); ?>" type="text">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div>
                                        <label for="level "><?php echo app('translator')->get('lang.level'); ?></label>
                                    </div>
                                    <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" 
                                            <?php $__currentLoopData = $value->level; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item->id == $level->id): ?>
                                                    checked
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                           
                                             type="checkbox" id="level_<?php echo e($level->id); ?>" name="level[]" value="<?php echo e($level->id); ?>">
                                            <label class="form-check-label" for="level_<?php echo e($level->id); ?>"><?php echo e($level->name); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-info">Save</button>
                </div>

            </div>
        </div>
    </div>
</form>
<?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/discounts/edit.blade.php ENDPATH**/ ?>