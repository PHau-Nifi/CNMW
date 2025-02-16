<form action="admin/food/edit/<?php echo $value['id']; ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="editFood<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="food_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="food_title"><?php echo $value['name']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><?php echo app('translator')->get('lang.name'); ?></label>
                                    <input class="form-control" type="text" value="<?php echo $value['name']; ?>" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><?php echo app('translator')->get('lang.price'); ?></label>
                                    <input class="form-control" type="number" value="<?php echo $value['price']; ?>" name="price">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group file-uploader">
                                    <label for="example-text-input" class="form-control-label"><?php echo app('translator')->get('lang.image'); ?></label>
                                    <input type='file' name='Image' class="form-control image-food">
                                    <?php if(strstr($value->image,"https") === false): ?>
                                        <img class="img-fluid rounded-start img_food" style="height: 200px" src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($value->image); ?>.jpg" alt="">
                                    <?php else: ?>
                                        <img class="img-fluid rounded-start img_food" style="height: 200px" src="<?php echo e($value->image); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
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
</form><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Food/edit.blade.php ENDPATH**/ ?>