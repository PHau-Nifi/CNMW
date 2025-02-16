
<?php use Illuminate\Support\Facades\Cookie; ?>
<?php $__env->startSection('content'); ?>
<section class="container">
    <div class="mt-5 login-banner" id="register">
        <div class="row">
            <div class="col col-sm-6"></div>
            <div class="col col-sm-6">
                <ul class="nav mb-4 justify-content-center">
                    <li class="nav-item">
                        <a href="\login">
                            <button class="h5 nav-link link-secondary"
                                aria-expanded="true"
                                data-bs-toggle="collapse"
                                data-bs-target="#login" disabled>
                                Đăng nhập
                            </button>
                        </a>
                    </li>
                    <li class="vr mx-5"></li>
                    <li class="nav-item">
                        <a class="h5 nav-link fw-bold border-bottom border-2 active" href="/register">
                            Đăng ký
                        </a>
                    </li>
                </ul>
                <div id="register" class="collapse show" data-bs-parent="#register">
                    <form method='post' action="/signUp">
                        <?php if(session('fail')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('fail')); ?>

                            </div>
                        <?php endif; ?>
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
                        
                        
                        <div class="row">
                            <div class="mb-3 form-check">
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
    </div>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/auth/register.blade.php ENDPATH**/ ?>