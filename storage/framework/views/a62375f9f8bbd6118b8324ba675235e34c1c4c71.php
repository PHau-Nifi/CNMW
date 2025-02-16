
<?php $__env->startSection('content'); ?>
<section class="container clearfix">
    <?php $__env->startSection('content'); ?>
    <section class="container-lg clearfix" style="min-height: 1000px">
        <div class="mt-5" id="schedules">
            <div id="lichtheorap" data-bs-parent="#schedules">
                <div class="d-flex flex-row mt-4">
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex-city p-2 m-1 border-0">
                            <button class="btn <?php if($loop->first): ?> btn-danger <?php else: ?> btn-outline-dark <?php endif; ?> p-3"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#Theater_<?php echo e(str_replace(' ', '', $city)); ?>" <?php if($loop->first): ?> disabled <?php endif; ?>><?php echo e($city); ?>

                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div id="theaterParent">
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="collapse <?php if($loop->first): ?> show <?php endif; ?>" id="Theater_<?php echo e(str_replace(' ', '', $city)); ?>"
                             data-bs-parent="#theaterParent">
                            <div class="row g-4 mt-2 row-cols-1 row-cols-sm-2 row-cols-md-4 ">
                                <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($city == $theater->city): ?>
                                        <!-- Theater -->
                                        <div class="col">
                                            <div class="card px-0 overflow-hidden theater_item"
                                                 style="background: #f5f5f5">
                                                <button class="btn rounded-0 border-0 btn_theater <?php if($loop->first): ?> btn-warning <?php endif; ?>"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#TheaterSchedules_<?php echo e($theater->id); ?>"
                                                        <?php if($loop->first): ?> disabled <?php endif; ?>>
                                                    <div class="card-body">
                                                        <h5 class="card-title fs-4"><?php echo e($theater->name); ?></h5>
                                                        <p class="card-text fs-6 text-secondary">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            <?php echo e($theater->address); ?>

                                                        </p>
                                                    </div>
                                                </button>

                                                <div class="card-footer">
                                                    <a href="<?php echo e($theater->location); ?>"
                                                       class="btn w-100 h-100 text-uppercase" target="_blank">xem Bản đồ
                                                        <i class="fa-solid fa-map-location-dot"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Theater: end -->
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div id="theaterSchedulesParent">
                        <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="collapse <?php if($loop->first): ?> show <?php endif; ?>" id="TheaterSchedules_<?php echo e($theater->id); ?>" data-bs-parent="#theaterSchedulesParent">
                            <ul class="list-group list-group-horizontal flex-wrap mt-4 listDate">
                                <?php for($i = 0; $i <= 7; $i++): ?>
                                    <li class="list-group-item border-0">
                                        <button data-bs-toggle="collapse"
                                                data-bs-target="#schedule_<?php echo e($theater->id); ?>_date_<?php echo e($i); ?>"
                                                <?php if($i == 0): ?>
                                                    aria-expanded="true"
                                                <?php else: ?>
                                                    aria-expanded="false"
                                                <?php endif; ?>
                                                class="btn btn-block btn-outline-dark p-2 m-2 <?php if($i==0): ?> active <?php endif; ?> btn-date">
                                            <?php echo e(date('d/m', strtotime('+ '.$i.' day', strtotime(today())))); ?>

                                        </button>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                            <div class="mt-2">
                                <h4>Lịch chiếu phim</h4>
                                <div>
                                    <div class="d-block mt-2 mb-5"  id="schedulesMain_<?php echo e($theater->id); ?>">
                                        <?php for($i = 0; $i <= 7; $i++): ?>
                                            <div class="collapse collapse-horizontal <?php if($i == 0): ?> show <?php endif; ?>" id="schedule_<?php echo e($theater->id); ?>_date_<?php echo e($i); ?>" data-bs-parent="#schedulesMain_<?php echo e($theater->id); ?>">
                                                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($movie->schedulesByDateAndTheater(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id)->count() > 0): ?>
                                                        <div class="p-2 d-flex flex-row m-1 align-items-center rounded" style="background: #f5f5f5">
                                                            <div class="flex-shrink-0 p-2 border-end border-4 border-white">
                                                                <img class="lazy img-responsive" 
                                                                <?php if(strstr($movie->image,"https") === false): ?>
                                                                src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie['image']); ?>.jpg"
                                                                <?php else: ?>
                                                                    src="<?php echo e($movie['image']); ?>"
                                                                <?php endif; ?> 
                                                                alt="" title="<?php echo $movie['name']; ?>" style="height: 150px">
                                                            </div>
                                                            
                                                            <div class="flex-grow-1 border-start border-5 border-white p-2 ps-4">
                                                                <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if($roomType->schedulesByDateAndTheaterAndMovie(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id, $movie->id)->count() > 0): ?>
                                                                        <div class="d-flex flex-column flex-nowrap overflow-auto mb-4">
                                                                            <div class="fw-bold"><?php echo e($movie->name); ?></div>
                                                                            <div class="fw-bold"><?php echo e($roomType->name); ?></div>
                                                                            <div class="d-flex flex-wrap overflow-wrapper">
                                                                                <?php $__currentLoopData = $roomType->schedulesByDateAndTheaterAndMovie(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id, $movie->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if($i===0): ?>
                                                                                        <?php if(date('H:i', strtotime('+ 20 minutes', strtotime($schedule->startTime))) >= $current_time): ?>
                                                                                            <a href="/ticket/<?php echo e($schedule->id); ?>"
                                                                                            class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                                                                            style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                                                                                <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                                                                                    <?php echo e(date('H:i', strtotime($schedule->startTime ))); ?>

                                                                                                </p>
                                                                                            </a>
                                                                                        <?php endif; ?>
                                                                                    <?php else: ?>
                                                                                        <a href="/tickets/<?php echo e($schedule->id); ?>"
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
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            $("#schedules .nav .nav-item .nav-link").on("click", function () {
                $("#schedules .nav-item").find(".active").removeClass("active link-warning fw-bold border-bottom border-2 border-warning").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active link-warning fw-bold border-bottom border-2 border-warning").removeClass("link-secondary").prop('disabled', true);
            });

            $("#lichtheorap .d-flex .flex-city .btn").on("click", function () {
                $("#lichtheorap .flex-city").find(".btn").removeClass("btn-danger").addClass("btn-outline-dark").prop('disabled', false);
                $(this).addClass("btn-danger").removeClass("btn-outline-dark").prop('disabled', true);
            });

            $(".theater_item .btn_theater").on("click", function () {
                $(".theater_item ").find(".btn_theater").removeClass("btn-warning").prop('disabled', false);
                $(this).addClass("btn-warning").prop('disabled', true);
            });

            $(".listDate button").on('click', function () {
                $(".listDate").find(".btn").removeClass('active');
                $(this).addClass("active");
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/theater.blade.php ENDPATH**/ ?>