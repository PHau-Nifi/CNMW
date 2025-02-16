<form action="admin/combo/create" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="combo" tabindex="-1" aria-labelledby="combo_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="combo_title">Combo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nameCreate"><?php echo app('translator')->get('lang.name'); ?></label>
                                    <input id="nameCreate" class="form-control" type="text" name="name" required autocomplete="off"
                                           placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.name'); ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="priceCreate"><?php echo app('translator')->get('lang.price'); ?></label>
                                    <input id="priceCreate" class="form-control" type="number" name="price"
                                           placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.price'); ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group file-uploader">
                                    <label for="imgCreate"><?php echo app('translator')->get('lang.image'); ?></label>
                                    <input id="imgCreate" type='file' name='Image' class="form-control image-combo">
                                    <img style="width: 150px" src="" class="img_combo d-none" alt="...">
                                </div>
                            </div>
                            <div class="col-12 food_group">
                                <span class="form-label"><?php echo app('translator')->get('lang.food'); ?></span>
                                <div class="input-group m-1">
                                    <span class="input-group-text text-black-50"><?php echo app('translator')->get('lang.detail'); ?>: </span>
                                    <select type='text' name='food[]' class="form-select" aria-label="food">
                                        <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($food->id); ?>"><?php echo e($food->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="input-group-text text-black-50"><?php echo app('translator')->get('lang.quantity'); ?>: </span>
                                    <input type="number" name="quantity[]" class="form-control" placeholder="<?php echo app('translator')->get('lang.quantity'); ?>" aria-label="quantity">
                                    <button type="button" class="btn btn-danger mb-0 delete_food"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                            <button type="button" class="btn m-1 btn-primary add_food"><?php echo app('translator')->get('lang.add'); ?></button>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('lang.save'); ?></button>
                </div>

            </div>
        </div>
    </div>
</form><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Combos/create.blade.php ENDPATH**/ ?>