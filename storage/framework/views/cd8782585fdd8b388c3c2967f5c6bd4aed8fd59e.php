<form action="admin/combo/edit/<?php echo e($combo->id); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal-body">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name_<?php echo e($combo->id); ?>"><?php echo app('translator')->get('lang.name'); ?></label>
                        <input id="name_<?php echo e($combo->id); ?>" class="form-control" type="text" value="<?php echo e($combo->name); ?>" name="name"
                               autocomplete="off"
                               placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.name'); ?>" aria-label="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="price_<?php echo e($combo->id); ?>"><?php echo app('translator')->get('lang.price'); ?></label>
                        <input id="price_<?php echo e($combo->id); ?>" class="form-control" type="number" name="price" value="<?php echo e($combo->price); ?>"
                               placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.price'); ?>" aria-label="">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group file-uploader">
                        <label for="img_<?php echo e($combo->id); ?>"><?php echo app('translator')->get('lang.image'); ?></label>
                        <input id="img_<?php echo e($combo->id); ?>" type='file' name='Image' class="form-control image-combo">
                        <?php if(strstr($combo->image,"https") === false): ?>
                            <img class="img-fluid rounded-start img_combo" style="height: 200px" src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($combo->image); ?>.jpg" alt="">
                        <?php else: ?>
                            <img class="img-fluid rounded-start img_combo" style="height: 200px" src="<?php echo e($combo->image); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 food_group">
                    <span class="form-label">Foods</span>
                    <?php $__currentLoopData = $combo->foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foodOfCombo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="input-group m-1">
                            <span class="input-group-text text-black-50"><?php echo app('translator')->get('lang.food'); ?>: </span>
                            <select type='text' name='food[]' class="form-select" aria-label="food">
                                <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($food->id); ?>" <?php if($food->id == $foodOfCombo->id): ?> selected <?php endif; ?>>
                                        <?php echo e($food->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <span class="input-group-text text-black-50"><?php echo app('translator')->get('lang.quantity'); ?>: </span>
                            <input type="number" value="<?php echo e($foodOfCombo->pivot->quantity); ?>" name="quantity[]" class="form-control"
                                   placeholder="quantity..."
                                   aria-label="quantity">
                            <button type="button" class="btn btn-danger mb-0 delete_food"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <button type="button" class="btn m-1 btn-primary add_food"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.combo'); ?></button>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('lang.save'); ?></button>
    </div>
</form><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Combos/edit.blade.php ENDPATH**/ ?>