
<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
            <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                ĐĂNG KÝ KHÁCH HÀNG
            </div>

            <div class="card-body pt-2">
                <form method='post' action="/signUp">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="fullname" class="form-label fw-bold">Tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                        <?php if($errors->has('fullname')): ?>
                            <p><?php echo e($errors->first('fullname')); ?></p>
                        <?php endif; ?>
                      </div>
                    <div class="mb-3">
                      <label for="email" class="form-label fw-bold">Email</label>
                      <input type="email" class="form-control" id="email" name="email">
                      <?php if($errors->has('email')): ?>
                        <p><?php echo e($errors->first('email')); ?></p>
                      <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
                        <input type="nunber" class="form-control" id="phone_number" name="phone">
                        <?php if($errors->has('phone')): ?>
                            <p><?php echo e($errors->first('phone')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-gray-200"> <?php echo app('translator')->get('lang.date'); ?></span>
                            <input name="brithday" id="date" value="" aria-label="" class="form-control ps-2" type="text">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <?php if($errors->has('password')): ?>
                            <p><?php echo e($errors->first('password')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="rpassword" class="form-label fw-bold">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="repassword" name="repassword">
                        <?php if($errors->has('repassword')): ?>
                            <p><?php echo e($errors->first('repassword')); ?></p>
                        <?php endif; ?>
                    </div>
                    <input type="hidden" name="type" value="staff">
                    
                    
                    <div class="row">
                        <div class="m-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreement" name="agreement">
                            <label class="form-check-label" for="agreement"> Đồng ý với điều khoản.</label>
                            <?php if($errors->has('agreement')): ?>
                                <p><?php echo e($errors->first('agreement')); ?></p>
                            <?php endif; ?>
                        </div>
                         <div class="d-flex justify-content-end">
                            <button type="submit" class="btn fw-bold">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(document).ready(function(){
        flatpickr($("#date"), {
            dateFormat: "Y-m-d ",
            "locale": "vn"
        });
    })
</script>
<script>
    <?php if(session('success')): ?>
        Swal.fire({
            title: '<?php echo e(session('success')); ?>',
            html: 'Mã khách hàng: <span id="customerCode"><?php echo e(session('user')->code); ?></span><br><br><button id="copyButton" class="btn btn-primary btn-sm">Copy mã</button>',
            icon: 'success',
            confirmButtonText: 'Ok',
            didOpen: () => {
                new ClipboardJS('#copyButton', {
                    text: function() {
                        return $('#customerCode').text();
                    }
                }).on('success', function() {
                    Swal.fire({
                        title: 'Đã sao chép!',
                        text: 'Mã khách hàng đã được sao chép vào clipboard.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                });
            }
        });
    <?php endif; ?>
    <?php if(session('fail')): ?>
    Swal.fire({
        title: '<?php echo e(session('fail')); ?>',
        icon: 'error',
        confirmButtonText: 'Ok'
    })
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/addUser/index.blade.php ENDPATH**/ ?>