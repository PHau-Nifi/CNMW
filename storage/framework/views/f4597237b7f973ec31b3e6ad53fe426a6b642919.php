<div class="modal fade" id="datve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo e($movie->name); ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="schedules">
                <ul class="list-group list-group-horizontal flex-wrap mt-4 listDate">
                    <?php for($i = 0; $i <= 7; $i++): ?>
                        <li class="list-group-item border-0">
                            <button data-bs-toggle="collapse"
                                    data-bs-target="#schedule_date_<?php echo e($i); ?>"
                                    <?php if($i == 0): ?>
                                        aria-expanded="true"
                                    <?php else: ?>
                                        aria-expanded="false"
                                    <?php endif; ?>
                                    class="btn btn-block btn-outline-dark p-2 m-2 <?php if($i==0): ?> active <?php endif; ?> btn-date">
                                    <?php if($movie->releaseDate > date('Y-m-d')): ?>
                                        <?php echo e($date = date('d/m', strtotime('+ '.$i.' day', strtotime($movie->releaseDate)))); ?>

                                    <?php else: ?>
                                        <?php echo e(date('d/m', strtotime('+ '.$i.' day', strtotime(today())))); ?>

                                    <?php endif; ?>
                            </button>
                        </li>
                    <?php endfor; ?>
                </ul>

                <div id="cityParent">
                    <?php for($i = 0; $i <= 7; $i++): ?>
                    <div class="collapse <?php if($i==0): ?> show <?php endif; ?>" id="schedule_date_<?php echo e($i); ?>" data-bs-parent="#cityParent">
                        <div class="d-flex flex-row mt-4">
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex-city p-2 m-1 border-0">
                                <button class="btn <?php if($loop->first): ?> btn-danger <?php else: ?> btn-outline-dark <?php endif; ?> p-3"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#Theater_<?php echo e(str_replace(' ', '', $city)); ?>_date_<?php echo e($i); ?>"><?php echo e($city); ?>

                                </button>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <div class="mt-4" id="theaterParent">
                    <?php for($i = 0; $i <= 7; $i++): ?>
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="collapse" id="Theater_<?php echo e(str_replace(' ', '', $city)); ?>_date_<?php echo e($i); ?>" data-bs-parent="#theaterParent">
                                <ul class="list-group list-group-flush w-100">
                                    <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($theater->city == $city): ?>
                                    <h4><?php echo $theater['name']; ?></h4>
                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap">
                                            <ul class="list-group  date">
                                                <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($roomType->schedulesByDateAndTheaterAndMovie(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id, $movie->id)->count() > 0): ?> 
                                                        <div class="d-flex flex-column flex-nowrap overflow-auto mb-4">
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
                                                                        <a href="/ticket/<?php echo e($schedule->id); ?>"
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
                                            </ul>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endfor; ?>
                    
                </div>
                
            </div>
        </div>
      </div>
    </div>
</div><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/movieDetailSchedules.blade.php ENDPATH**/ ?>