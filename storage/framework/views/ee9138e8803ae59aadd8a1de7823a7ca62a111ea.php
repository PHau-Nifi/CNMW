
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item dropdown ps-3 d-flex align-items-center">
                        <a class="nav-link font-weight-bold px-0 dropdown active" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <span class="d-sm-inline d-none text-dark">
                                    <?php echo e(auth('staff')->user()->fullname); ?>

                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="top: -0.5rem!important;left: -25px;">
                            <li><a class="dropdown-item" href="/admin/sign_out">Đăng xuất</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
    
<?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/layouts/nav.blade.php ENDPATH**/ ?>