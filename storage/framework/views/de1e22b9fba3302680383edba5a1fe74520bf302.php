<!-- Modal -->
    <div class="modal fade modal-lg" id="CreateScheduleModal_<?php echo e($room->id); ?>" tabindex="-1" aria-labelledby="CreateScheduleLabel_<?php echo e($room->id); ?>"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-uppercase" id="CreateScheduleLabel_<?php echo e($room->id); ?>">
                        <?php echo e($date_cur); ?>

                        <div class="vr mx-2"></div>
                        <?php echo e($room->name); ?>

                        <div class="vr mx-2"></div>
                        <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.schedule'); ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/schedule/create" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label> <?php echo app('translator')->get('lang.time'); ?></label>
                                    <div class="d-flex position-relative">
                                        <input class="form-control" id="time" type="time" name="startTime"
                                            <?php if($room->schedulesByDate(date('Y-m-d', strtotime($date_cur)))->count() == 0): ?>
                                                min="08:00"
                                            <?php else: ?>
                                                <?php if($endTime > strtotime('22:00')): ?>
                                                    min="22:00"
                                                <?php else: ?>
                                                    min="<?php echo e($endTimeLatest); ?>"
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if($room->schedulesByDate(date('Y-m-d', strtotime($date_cur)))->count() == 0): ?>
                                                value="08:00"
                                            <?php else: ?>
                                                value="<?php echo e($endTimeLatest); ?>"
                                            <?php endif; ?>
                                            oninvalid="this.setCustomValidity('Giờ bạn chọn phải sau <?php echo e($endTimeLatest ?? '08:00'); ?>')"
                                            oninput="this.setCustomValidity('')" 
                                            required
                                        
                                            aria-label="time">
                                            
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input id="remainingSchedules_<?php echo e($room->id); ?>" type="checkbox" class="form-check-input" name="remainingSchedules"
                                        aria-label="">
                                    <label class="custom-control-label">Tất cả suất chiếu còn lại trong ngày</label>
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label"> Phim</label>
                                    <select class="form-select" id="address" name="movie" aria-label="">
                                        <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($movie->releaseDate <= $date_cur && $movie->endDate >= $date_cur): ?>
                                                <option value="<?php echo e($movie->id); ?>"><?php echo e($movie->name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Âm thanh</label>
                                    <select id="city_create" class="form-select" name="audio" aria-label="audio">
                                        <option value="vn">Việt</option>
                                        <option value="en">Anh</option>
                                        <option value="cn">Trung Quốc</option>
                                        <option value="kr">Hàn</option>
                                        <option value="jp">Nhật</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label> Phụ đề</label>
                                    <select class="form-select" name="subtitle" aria-label="subtitle">
                                        <option value="vn">Việt</option>
                                        <option value="en">Anh</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="theater" value="<?php echo e($theater_cur->id); ?>">
                            <input type="hidden" name="room" value="<?php echo e($room->id); ?>">
                            <input type="hidden" name="date" value="<?php echo e($date_cur); ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Hủy</button>
                        <button type="submit" class="btn btn-primary"
                                
                        >Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Schedules/create.blade.php ENDPATH**/ ?>