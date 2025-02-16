<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 z-index-1" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/admin">
            <span class="ms-1 font-weight-bold">Admin Cinema</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <?php if(auth('staff')->user()->hasRole('Admin')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/movie">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-film text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Phim</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/theater">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-tv text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Rạp chiếu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/ticket">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-sharp fa-solid fa-ticket text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Vé</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/prices">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-money-bill text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Giá vé</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/schedule">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-calendar-days text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Lịch chiếu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/food">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-sharp fa-solid fa-popcorn text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Thức ăn</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/combo">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-utensils text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Combo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/user">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Khách hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/staff">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user-tie text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Nhân viên</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="./admin/news">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-newspaper text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"><?php echo app('translator')->get('lang.news'); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/banners">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-rectangle-ad text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Quảng cáo</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="./admin/discount">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-sharp fa-solid fa-badge-percent text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1"><?php echo app('translator')->get('lang.discount'); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="/admin/info">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-sharp fa-regular text-info text-sm  fa-circle-info"></i>
                        </div>
                        <span class="nav-link-text ms-1">Thông tin</span>
                    </a>
                </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="./admin/buyTicket">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-light fa-ticket-simple text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Bán Vé</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="./admin/buyCombo">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-burger-soda text-danger text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Bán combo</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="./admin/addUser">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-light fa-id-badge text-sm opacity-10"  style="color: #b197fc"></i>
                    </div>
                    <span class="nav-link-text ms-1">Đăng ký khách hàng</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $__env->yieldContent('active'); ?>" href="./admin/staff/scanTicket">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-sharp fa-light fa-id-badge text-sm opacity-10"  style="color: #b197fc"></i>
                    </div>
                    <span class="nav-link-text ms-1">Quét vé</span>
                </a>
            </li>
            <?php endif; ?>
                
            
            
        </ul>
    </div>
</aside> <?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/layouts/slidebar.blade.php ENDPATH**/ ?>