
<?php $__env->startSection('content'); ?>
<section class="container">
    <div class="mt-5 login-banner" id="login">
        <div class="row">
            <div class="col col-sm-6"></div>
            <div class="col col-sm-6">
                <ul class="nav mb-4 justify-content-center">
                    <li class="nav-item">
                        <button class="h5 nav-link active fw-bold border-bottom border-2"
                                aria-expanded="true"
                                data-bs-toggle="collapse"
                                data-bs-target="#login" disabled>
                            Đăng nhập
                        </button>
                    </li>
                    <li class="vr mx-5"></li>
                    <li class="nav-item">
                        <a class="h5 nav-link link-secondary" href="/register">
                            Đăng ký
                        </a>
                    </li>
                </ul>
                <div id="login" class="collapse show" data-bs-parent="#login">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('warning')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('warning')); ?>

                            </div>
                        <?php endif; ?>
                    <form method='post' action="/signIn">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                        <input type="hidden" name="url" value="<?php echo e(url()->current()); ?>"/>
                        <div class="mb-3">
                          <label for="username" class="form-label fw-bold">Email hoặc SDT</label>
                          <input type="text" class="form-control" id="username" name="username"
                            <?php if(session()->has('username_web')): ?>
                                    value="<?php echo session()->get('username_web'); ?>"
                                        <?php endif; ?>
                                        name="username" aria-label="username"
                                        autocomplete="email"
                          >
                          <?php if($errors->has('username')): ?>
                            <p><?php echo e($errors->first('username')); ?></p>
                          <?php endif; ?>
                        </div>
                        <div class="mb-3">
                          <label for="Password" class="form-label fw-bold">Mật khẩu</label>
                          <input type="password" class="form-control" id="Password" name="password"
                          <?php if(session()->has('password_web')): ?>
                                   value="<?php echo session()->get('password_web'); ?>"
                               <?php endif; ?>
                               name="password" aria-label="password">
                          <?php if($errors->has('password')): ?>
                            <p><?php echo e($errors->first('password')); ?></p>
                          <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remeber_me" name="rememberme" 
                                <?php if(session()->has('username_web')): ?>
                                   checked
                               <?php endif; ?> name="rememberme">
                                <label class="form-check-label" for="remeber_me"> Nhớ tôi</label>
                            </div>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn fw-bold">Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/login.blade.php ENDPATH**/ ?>