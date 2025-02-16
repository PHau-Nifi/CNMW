
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Cinema</title>
    <link id="pagestyle" href="<?php echo e(asset('admin_assets/css/argon-dashboard.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="<?php echo e(asset('web_assets/fonts/fontawesome/css/all.css')); ?>" rel="stylesheet" />

</head>
<body>
    <section class="vh-100" style="background-image: url(<?php echo e(asset('admin_assets/img/login_bg.jpg')); ?>); background-size: contain; background-position: center; background-repeat: no-repeat;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">
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
                  <h3 class="mb-5">Đăng nhập</h3>
                    <form action="/admin/sign_in" method="post">
                        <?php echo csrf_field(); ?>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" id="username" class="form-control form-control-lg" name="username"/>
                            <label class="form-label" for="username">Tên đăng nhập</label>
                          </div>
              
                          <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" name="password" id="password" class="form-control form-control-lg" />
                            <label class="form-label" for="password">Mật khẩu</label>
                          </div>
                          <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                    </form>
                  <hr class="my-4">
                  <div>
                    <a href="/"><i class="fa-solid fa-caret-left"></i> Quay lại trang web</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
</html>

<?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/sign_in.blade.php ENDPATH**/ ?>