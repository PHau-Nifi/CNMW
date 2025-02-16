

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><?php echo app('translator')->get('lang.theater'); ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a style="float:right;padding-right:30px;" class="text-light">
                            <button class=" btn bg-gradient-info float-right mb-3" data-bs-toggle="modal" data-bs-target="#theaterCreateModal">
                               <?php echo app('translator')->get('lang.create'); ?>
                            </button>
                        </a>

                        <table class="table align-items-center mb-0 ">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <?php echo app('translator')->get('lang.theater'); ?>
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <?php echo app('translator')->get('lang.address'); ?>
                                </th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    <?php echo app('translator')->get('lang.room'); ?>
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <?php echo app('translator')->get('lang.status'); ?>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle ">
                                        <h6 class="mb-0 text-sm "><?php echo e($theater->name); ?></h6>
                                    </td>
                                    <td class="align-middle">
                                        <h6 class="mb-0 text-sm "><?php echo e($theater->address); ?>

                                            , <?php echo e($theater->city); ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo e(count($theater->rooms)); ?></span>
                                    </td>
                                    <td id="theater_status<?php echo $theater['id']; ?>" class="align-middle text-center text-sm">
                                        <?php if($theater->status == 1): ?>
                                            <a href="javascript:void(0)" class="btn_active" onclick="theaterstatus(<?php echo $theater['id']; ?>,0)">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" class="btn_active" onclick="theaterstatus(<?php echo $theater['id']; ?>,1)">
                                                <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="#TheaterEditModal" class="text-secondary font-weight-bold text-xs"
                                                onclick="editTheater(<?php echo e($theater->id); ?>, '<?php echo e($theater->city); ?>')"
                                                data-bs-toggle="modal"
                                                data-bs-target="#TheaterEditModal<?php echo e($theater->id); ?>">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>

                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" data-url="<?php echo e(url('admin/theater/delete', $theater['id'] )); ?>"
                                           class="text-secondary font-weight-bold text-xs delete-theater" data-toggle="tooltip">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('admin.web.theaters.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('admin.web.theaters.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.web.rooms.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function theaterstatus(theater_id, active) {
            if (active === 1) {
                $("#theater_status" + theater_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="theaterstatus(' + theater_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
                    </a>'
                );
            } else {
                $("#theater_status" + theater_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="theaterstatus(' + theater_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
                    </a>'
                );
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/theater/status",
                type: 'GET',
                data: {
                    'active': active,
                    'theater_id': theater_id
                },

            });
        }

    </script>
    <script>
        function roomstatus(room_id, active) {
            if (active === 1) {
                $("#room_status" + room_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="roomstatus(' + room_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
                    </a>'
                );
            } else {
                $("#room_status" + room_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="roomstatus(' + room_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
                    </a>'
                );
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/room/status",
                type: 'GET',
                data: {
                    'active': active,
                    'room_id': room_id
                },

            });
        }

    </script>
    <script>
        $(document).ready(function () {
            $('#city').select2();
            $('#city_create').select2();
        })

        editTheater = (theater_id, city) => {
            $('#city_theater_' + theater_id + ' option[value="' + city + '"]').prop("selected", true);
        }
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.delete-theater').on('click', function () {
                var userURL = $(this).data('url');
                var trObj = $(this);
                if (confirm("Are you sure you want to remove it?") == true) {
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            if (data['success']) {
                                // alert(data.success);
                                trObj.parents("tr").remove();
                            } else if (data['error']) {
                                alert(data.error);
                            }
                        }
                    });
                }

            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.delete-room').on('click', function () {
                var userURL = $(this).data('url');
                var trObj = $(this);
                if (confirm("Are you sure you want to remove it?") == true) {
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
                            if (data['success']) {
                                // alert(data.success);
                                trObj.parents("tr").remove();
                            } else if (data['error']) {
                                alert(data.error);
                            }
                        }
                    });
                }

            });
        });

        btnEdit = (id) => {
            console.log(id+ 'theater')
            $('#theater_edit_form_' + id).trigger( "submit" );
        }

    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/theaters/index.blade.php ENDPATH**/ ?>