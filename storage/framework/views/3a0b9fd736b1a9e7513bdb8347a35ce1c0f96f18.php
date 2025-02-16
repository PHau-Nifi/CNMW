
<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                BÁN VÉ - Rạp <?php echo e(auth('staff')->user()->theater->name); ?>

            </div>

            <div class="card-body pt-2">
                <div id="lichtheorap" class="collapse show" data-bs-parent="#schedules">
                    <div id="theaterParent">
                        <form action="/admin/buyTicket" method="get">
                            <?php echo csrf_field(); ?>
                            <div class="row container mt-5">
                                <div class="col-10">
                                    <div class="input-group">
                                        <span class="input-group-text bg-gray-200"> Ngày</span>
                                        <input class="form-control ps-2" type="date" min="<?php echo e(date('Y-m-d')); ?>" name="date" value="<?php echo e($date_cur); ?>"
                                               aria-label="">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                </div>
                            </div>
                        </form>

                        <div id="theaterSchedulesParent">
                            <div id="TheaterSchedules_<?php echo e($theater->id); ?>">
                                <div class="mt-5">
                                    <h4>Lịch chiếu phim</h4>
                                    <div class="d-block mt-2 mb-5">
                                        <div class="row">
                                            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($movie->schedulesByDateAndTheater($date_cur ,$theater->id)->count() > 0): ?>
                                                    <div class="col-3">
                                                        <div class="card border mb-2">
                                                            <button type="button" class="btn btn-link"
                                                                data-bs-toggle="modal" data-bs-target="#movieSchedules_<?php echo e($movie->id); ?>">
                                                            <div class="card-header p-2" style="height: 80px"><?php echo e($movie->name); ?></div>
                                                                <img class="card-img rounded"
                                                                     style="width: 180px; height: 240px" alt="..." <?php if(strstr($movie->image,"https") === false): ?>
                                                                     src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie->image); ?>.jpg"
                                                                 <?php else: ?>
                                                                     src="<?php echo e($movie->image); ?>"
                                                                 <?php endif; ?>>
                                                            </button>
                                                        </div>
                                                        <div class="modal fade" id="movieSchedules_<?php echo e($movie->id); ?>" tabindex="-1" role="dialog"
                                                             aria-labelledby="movieTitle_<?php echo e($movie->id); ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="movieTitle_<?php echo e($movie->id); ?>"><?php echo e($movie->name); ?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close">X</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            
                                                                            <div class="flex-grow-1 border-start border-5 border-white p-2 ps-4">
                                                                                <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if($roomType->schedulesByDateAndTheaterAndMovie($date_cur, $theater->id, $movie->id)->count() > 0): ?>
                                                                                        <div class="d-flex flex-column flex-nowrap overflow-auto mb-4">
                                                                                            <div class="fw-bold"><?php echo e($roomType->name); ?></div>
                                                                                            <div class="d-flex flex-wrap overflow-wrapper">
                                                                                                <?php $__currentLoopData = $roomType->schedulesByDateAndTheaterAndMovie($date_cur, $theater->id, $movie->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <?php if(strtotime($schedule->startTime) + (15*60) > strtotime($time_cur)): ?>
                                                                                                        <a href="/admin/buyTicket/ticket/<?php echo e($schedule->id); ?>"
                                                                                                            class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                                                                                            style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                                                                                            <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                                                                                                <?php echo e(date('H:i', strtotime($schedule->startTime ))); ?>

                                                                                                            </p>
                                                                                                     </a>
                                                                                                    <?php endif; ?>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        <div class="mt-4">
                                                                            <h4>Loại khách hàng</h4>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="customerType" id="customerTypeAdult" value="nl" checked>
                                                                                <label class="form-check-label" for="customerTypeAdult">
                                                                                    Người lớn
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="customerType" id="customerTypeChild" value="nctte">
                                                                                <label class="form-check-label" for="customerTypeChild">
                                                                                    Trẻ em, người già
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="customerType" id="customerTypeSenior" value="hssv">
                                                                                <label class="form-check-label" for="customerTypeSenior">
                                                                                    Học sinh, sinh viên
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        <?php if(session('success')): ?>
        Swal.fire({
            title: '<?php echo e(session('success')); ?>',
            icon: 'success',
            confirmButtonText: 'Ok'
        })
        <?php endif; ?>
        <?php if(session('fail')): ?>
        Swal.fire({
            title: '<?php echo e(session('fail')); ?>',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        <?php endif; ?>

        $(document).ready(function () {
        let selectedCustomerType = 'nl';

        // Cập nhật loại khách hàng khi thay đổi radio button
        $('input[name="customerType"]').on('change', function () {
            selectedCustomerType = $(this).val();
            console.log('Loại khách hàng được chọn:', selectedCustomerType); // Debug
        });

        $('.btn-warning').on('click', function (event) {
            event.preventDefault(); 
            let originalUrl = $(this).attr('href'); 
            let newUrl = originalUrl + '?customerType=' + selectedCustomerType; 
            window.location.href = newUrl;
        });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/buyTicket/index.blade.php ENDPATH**/ ?>