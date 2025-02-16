
<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <?php if(count($errors) > 0): ?>
         <div class="alert alert-warning">
             <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php echo e($arr); ?><br>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
         <?php endif; ?>
         <?php if(session('success')): ?>
         <div class="alert alert-success">
             <span class="alert-icon"><i class="ni ni-like-2"></i></span>
             <span class="alert-text"><strong>Success!</strong> <?php echo e(session('success')); ?>!</span>
         </div>
         <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6><?php echo app('translator')->get('lang.schedule'); ?></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="admin/schedule" method="get">
                            <div class="row container">
                                <div class="col-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-gray-200"> <?php echo app('translator')->get('lang.theater'); ?></span>
                                        <select id="theater" class="form-select ps-2" name="theater" aria-label="">
                                            <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($theater->id); ?>" <?php if($theater==$theater_cur): ?> selected <?php endif; ?>>
                                                <?php echo e($theater->name); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-gray-200"> <?php echo app('translator')->get('lang.date'); ?></span>
                                        <input name="date" id="date" value="<?php echo e(date("Y-m-d",strtotime($date_cur))); ?>" aria-label="" class="form-control ps-2" type="text">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn  bg-gradient-primary"><?php echo app('translator')->get('lang.confirm'); ?></button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive m-2">
                            <table class="table table-bordered table-striped align-items-center text-center">
                                <colgroup>
                                    <col span="1" style="width: 40%;">
                                    <col span="1" style="width: 30%;">
                                    <col span="1" style="width: 30%;">
                                </colgroup>
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-uppercase font-weight-bolder"> <?php echo app('translator')->get('lang.room'); ?></th>
                                        <th class="text-uppercase font-weight-bolder"> <?php echo app('translator')->get('lang.room_type'); ?></th>
                                        <th class="text-uppercase font-weight-bolder"> <?php echo app('translator')->get('lang.seat'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($theater_cur)): ?>
                                    <?php $__currentLoopData = $theater_cur->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($room['status'] == 1): ?>
                                    <tr>
                                        <td>
                                            <?php echo e($room->name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($room->roomType->name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($room->seats->count()); ?>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <table id="room_<?php echo e($room->id); ?>" class="table table-bordered align-items-center">
                                                <colgroup>
                                                    <col span="1" style="width: 20%;">
                                                    <col span="1" style="width: 80%;">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase fw-bold"><?php echo app('translator')->get('lang.time'); ?></th>
                                                        <th class="text-uppercase fw-bold text-start"><?php echo app('translator')->get('lang.movie_name'); ?></th>
                                                        <th class="text-uppercase fw-bold"><?php echo app('translator')->get('lang.status'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $room->schedulesByDate(date('Y-m-d', strtotime($date_cur))); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="delete_schedule" id="schedules_<?php echo e($schedule->id); ?>">
                                                        <td>
                                                            <?php echo e(date('H:i', strtotime($schedule->startTime))); ?>

                                                            - <?php echo e(date('H:i', strtotime($schedule->endTime))); ?>

                                                        </td>
                                                        <td class="text-start">
                                                            <?php echo e($schedule->movie->name); ?>

                                                        </td>
                                                        <?php if(date('Y-m-d', strtotime($schedule->date))
                                                        < date('Y-m-d', strtotime($schedule->movie->releaseDate))): ?>
                                                            <td id="early_status<?php echo $schedule['id']; ?>" class="align-middle text-center text-sm ">
                                                                <?php if($schedule->early == 1): ?>
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changeearlystatus(<?php echo $schedule['id']; ?>,0)">
                                                                    <span class="badge badge-sm bg-gradient-success">
                                                                        Online
                                                                    </span>
                                                                </a>
                                                                <?php else: ?>
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changeearlystatus(<?php echo $schedule['id']; ?>,1)">
                                                                    <span class="badge badge-sm bg-gradient-secondary">
                                                                        Offline
                                                                    </span>
                                                                </a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php else: ?>
                                                            <td id="status<?php echo $schedule['id']; ?>" class="align-middle text-center text-sm ">
                                                                <?php if($schedule->status == 1): ?>
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $schedule['id']; ?>,0)">
                                                                    <span class="badge badge-sm bg-gradient-success">Online</span>
                                                                </a>
                                                                <?php else: ?>
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $schedule['id']; ?>,1)">
                                                                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                                </a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php endif; ?>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-info btn_add" data-bs-toggle="modal" data-bs-target="#CreateScheduleModal_<?php echo e($room->id); ?>">
                                                                <i class="fa-regular fa-circle-plus"></i> <?php echo app('translator')->get('lang.create'); ?>
                                                            </button>
                                                        </td>
                                                        <td colspan="3">
                                                            <div class="d-flex justify-content-end">
                                                                <button class="btn btn-warning btn_changeAllStatus" onclick="changeAllStatus(<?php echo e($room->id); ?>)">
                                                                    <i class="fa-solid fa-repeat"></i> 
                                                                </button>
                                                                <a href="javascript:void(0);" data-date="<?php echo e($date_cur); ?>" data-theater="<?php echo e($theater_cur->id); ?>" data-room="<?php echo e($room->id); ?>" data-url="<?php echo e(url('admin/schedule/deleteall')); ?>" class="btn btn-dark ms-3 delete_all">
                                                                    <i class="fa-regular fa-trash"></i> Delete all
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__currentLoopData = $theater_cur->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $room->latestScheduleByDate(date('Y-m-d', strtotime($date_cur))); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $endTime = strtotime($latest->endTime);
            $endTimeLatest = date('H:i', $endTime + 600);
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('admin.web.Schedules.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function() {
        flatpickr($("#date"), {
            dateFormat: "Y-m-d ",
            "locale": "vn"
        });

        <?php if(date('Y-m-d') > $date_cur): ?>
        $('.btn-early').addClass('disabled');
        $('.btn_active').addClass('disabled');
        $('.btn_changeAllStatus').addClass('disabled');
        $('.delete_all').addClass('disabled');
        $('.btn_add').addClass('disabled');
        <?php endif; ?>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete_all').on('click', function(e) {
            var userURL = $(this).data('url');
            var theater_id = $(this).data('theater');
            var room_id = $(this).data('room');
            var date = $(this).data('date');
            if (confirm("Are you sure you want to remove it?") === true) {
                $.ajax({
                    url: userURL,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'theater_id': theater_id,
                        'room_id': room_id,
                        'date': date
                    },
                    success: function(data) {
                        if (data['success']) {
                            // $(".delete_schedule").remove();
                            window.location.reload();
                        }
                    }

                });
            }
        });
    });
</script>
<script>
    function changestatus(schedule_id, active) {
        if (active === 1) {
            $("#status" + schedule_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + schedule_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + schedule_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + schedule_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/schedule/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'schedule_id': schedule_id
            },
            success: function(data) {
                if (data['success']) {
                } else if (data['error']) {
                    alert(data.error);
                }
            }
        });
    }
</script>
<script>
    function changeearlystatus(early_id, active) {
        if (active === 1) {
            $("#early_status" + early_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changeearlystatus(' + early_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Early access</span>\
            </a>')
        } else {
            $("#early_status" + early_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changeearlystatus(' + early_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/schedule/early_status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'early_id': early_id
            },
            success: function(data) {
                if (data['success']) {
                    // alert(data.success);
                } else if (data['error']) {
                    alert(data.error);
                }
            }
        });
    }

    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault(); // Ngăn việc liên kết hoạt động ngay lập tức
        let deleteUrl = $(this).attr('href'); // Lấy URL từ href

        if (confirm('Bạn có chắc chắn muốn xóa lịch chiếu này không?')) {
            // Nếu người dùng đồng ý
            window.location.href = deleteUrl;
        } else {
            // Nếu người dùng không đồng ý
            console.log('Hủy xóa');
        }
    });
</script>
<script>
    <?php if(isset($theater_cur)): ?>
        <?php $__currentLoopData = $theater_cur -> rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        $('#remainingSchedules_<?php echo e($room->id); ?>').change((e) => {
            if ($(e.target).is(':checked')) {
                $('#CreateScheduleModal_<?php echo e($room->id); ?>').find('#time').attr('readonly', true);
            } else {
                $('#CreateScheduleModal_<?php echo e($room->id); ?>').find('#time').attr('readonly', false);
            }
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>
<script>
    changeAllStatus = (room_id) => {
        schedulesElements = $('#room_' + room_id).find('.btn_active');
        schedulesElements.toArray().forEach(schedulesElement => {
            schedulesElement.click();
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Schedules/index.blade.php ENDPATH**/ ?>