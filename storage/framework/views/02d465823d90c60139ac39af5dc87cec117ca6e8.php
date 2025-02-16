<table class="table align-items-center mb-0 ">
    <thead>
    <tr>
        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
            <?php echo app('translator')->get('lang.room'); ?>
        </th>
        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
            <?php echo app('translator')->get('lang.room_type'); ?>
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            <?php echo app('translator')->get('lang.status'); ?>
        </th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="5">
            <button class="btn w-100" data-bs-toggle="modal" data-bs-target="#RoomCreateModal_Theater_<?php echo e($theater->id); ?>">
                <i class="fa-light fa-circle-plus pe-1"></i><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.room'); ?>
            </button>
        </td>
    </tr>
    <?php $__currentLoopData = $theater->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="align-middle text-center">
                <h6 class="mb-0 text-sm "><?php echo e($room->name); ?></h6>
            </td>
            <td class="align-middle text-center">
                <h6 class="mb-0 text-sm "><?php echo e($room->roomType->name); ?></h6>
            </td>
            <td id="room_status<?php echo $room['id']; ?>" class="align-middle text-center text-sm">
                <?php if($room->status == 1): ?>
                    <a href="javascript:void(0)" class="btn_active" onclick="roomstatus(<?php echo $room['id']; ?>,0)">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                    </a>
                <?php else: ?>
                    <a href="javascript:void(0)" class="btn_active" onclick="roomstatus(<?php echo $room['id']; ?>,1)">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                    </a>
                <?php endif; ?>
            </td>
            <td class="align-middle">
                <a class="text-secondary font-weight-bold text-xs" href="admin/seat/<?php echo e($room->id); ?>">
                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                </a>

            </td>
            <td class="align-middle">
                <a href="admin/room/delete/<?php echo e($room->id); ?>" class="text-secondary font-weight-bold text-xs delete-room"
                   data-url="<?php echo e(url('admin/seat/delete', $room['id'] )); ?>" data-toggle="tooltip">
                    <i class="fa-solid fa-trash-can fa-lg"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Rooms/index.blade.php ENDPATH**/ ?>