<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <base href="<?php echo e(asset('')); ?>">
    
    <link rel="icon" type="image/png" href="images/favicon/cinema.png ">
    <title>
        Admin
    </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="admin_assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="admin_assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font awesome - icon font -->
    <link href="/web_assets/fonts/fontawesome/css/all.css" rel="stylesheet" />
    <link href="admin_assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- CSS Files -->
    <link id="pagestyle" href="admin_assets/css/argon-dashboard.css" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.css" integrity="sha512-K0TEY7Pji02TnO4NY04f+IU66vsp8z3ecHoID7y0FSVRJHdlaLp/TkhS5WDL3OygMkVns4bz0/ah4j8M3GgguA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
    
    <?php echo $__env->yieldContent('css'); ?>
</head>
    
<body class="g-sidenav-show bg-gray-100">
    <?php echo $__env->make('admin.layouts.slidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main class="main-content position-relative border-radius-lg">
         <!-- Navbar -->
         <?php echo $__env->make('admin.layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <!-- End Navbar -->
         <?php if(count($errors) > 0): ?>
         <div class="alert alert-warning">
             <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php echo e($arr); ?><br>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php endif; ?>
         <?php if(session('warning')): ?>
         <div class="alert alert-warning">
             <?php echo e(session('warning')); ?>

         </div>
         <?php endif; ?>
         <?php if(session('danger')): ?>
         <div class="alert alert-danger">
             <?php echo e(session('danger')); ?>

         </div>
         <?php endif; ?>
         <?php if(session('success')): ?>
         <div class="alert alert-success">
             <span class="alert-icon"><i class="ni ni-like-2"></i></span>
             <span class="alert-text"><strong>Success!</strong> <?php echo e(session('success')); ?>!</span>
         </div>
         <?php endif; ?>
         <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
<script src="admin_assets/js/core/popper.min.js"></script>
<script src="admin_assets/js/core/bootstrap.min.js"></script>
<script src="admin_assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="admin_assets/js/plugins/smooth-scrollbar.min.js"></script>


<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Control Center for Argon Dashboard: parallax effects, scripts for the example pages etc -->
<script src="admin_assets/js/argon-dashboard.min.js"></script>


<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<!--   Moris   -->

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js" integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ==" crossorigin="anonymous"></script>





<script src="https://cdn.jsdelivr.net/npm/scanbot-web-sdk@latest/bundle/ScanbotSDK.min.js"></script>
<!-- After, initialize the Scanbot SDK in your own script -->



<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.js" integrity="sha512-ywT1Sl8B8rJwwBWFC3rPTu/VQkDrnS19Kw0Xxa6Y9xvzMSwVMHDQscePPR9yNE0oyVsITEcvUPSDW/aS5KX+Mw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>


<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#conditions'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            if (!error)
                console.error(error);
        });
</script>

    <?php echo $__env->yieldContent('js'); ?>
</html><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/layouts/index.blade.php ENDPATH**/ ?>