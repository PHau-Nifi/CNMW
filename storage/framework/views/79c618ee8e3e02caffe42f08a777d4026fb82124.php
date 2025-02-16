
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="/admin/info/" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0"><?php echo app('translator')->get('lang.information'); ?></p>
                            <button type="submit" class="btn bg-gradient-primary btn-sm ms-auto">Lưu</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group file-uploader">
                                    <label for="movieImage">Logo</label>
                                    <input id="movieImage" type="file" name="Image" class="form-control image-movie">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img style="width: 300px" 
                                <?php if(isset($info['logo'])): ?> 
                                src="images/web/<?php echo e($info['logo']); ?>" 
                                <?php else: ?> src="" 
                                <?php endif; ?> class="img_logo" alt="user1">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="showTime"><?php echo app('translator')->get('lang.name'); ?></label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['name']); ?>" name="name" type="text">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="showTime"><?php echo app('translator')->get('lang.phone'); ?></label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['phone']); ?>" name="phone" type="number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="showTime">Email</label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['email']); ?>" name="email" type="email">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="showTime">Facebook</label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['facebook']); ?>" name="facebook" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="showTime">Twitter</label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['twitter']); ?>" name="twitter" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="showTime">Instagram</label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['instagram']); ?>" name="instagram" type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="showTime">Youtube</label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['youtube']); ?>" name="youtube" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="showTime"><?php echo app('translator')->get('lang.worktime'); ?></label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['worktime']); ?>" name="worktime" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="showTime">Copyright</label>
                                    <input id="showTime" class="form-control" value="<?php echo e($info['copyright']); ?>" name="copyright" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img_logo').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".image-movie").change(function() {
        readURL(this);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Info/index.blade.php ENDPATH**/ ?>