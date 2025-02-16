
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Combo</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a style="float:right;padding-right:30px;" class="text-light">
                            <button class=" btn btn-primary float-right mb-3" data-bs-toggle="modal"
                                    data-bs-target="#combo"><?php echo app('translator')->get('lang.add'); ?>
                            </button>
                        </a>
                        <table class="table align-items-center mb-0 ">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.name'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.image'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.detail'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.price'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.status'); ?></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $combos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo e($combo->name); ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php if(strstr($combo->image,"https") === false): ?>
                                            <img class="img-fluid rounded-start" style="height: 200px" src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($combo->image); ?>.jpg" alt="">
                                        <?php else: ?>
                                            <img class="img-fluid rounded-start" style="height: 200px" src="<?php echo e($combo->image); ?>" alt="">
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php $__currentLoopData = $combo->foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($food->name . ' x '. $food->pivot->quantity); ?> <br>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo e(number_format($combo->price)); ?> đ</span>
                                    </td>
                                    <td id="status<?php echo e($combo->id); ?>" class="align-middle text-center text-sm ">
                                        <?php if($combo->status == 1): ?>
                                            <a href="javascript:void(0)" class="btn_active" onclick="changeStatus(<?php echo e($combo->id); ?>,0)">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" class="btn_active" onclick="changeStatus(<?php echo e($combo->id); ?>,1)">
                                                <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                           data-original-title="Edit combo" data-bs-target="#comboEdit_<?php echo e($combo->id); ?>"
                                           data-bs-toggle="modal">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                        <div class="modal fade" id="comboEdit_<?php echo e($combo->id); ?>" tabindex="-1" aria-labelledby="combo_title" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="combo_title">Combo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <?php echo $__env->make('admin.web.Combos.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="deleteCombo(<?php echo e($combo->id); ?>)"
                                           class="text-secondary font-weight-bold text-xs delete_combo">
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
    <?php echo $__env->make('admin.web.Combos.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            deleteCombo = (id) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (confirm("Xóa combo này?") === true) {
                    $.ajax({
                        url: 'admin/combo/delete/' + id,
                        type: 'DELETE',
                        statusCode: {
                            200: function (data) {
                                console.log(trObj);
                                $('.delete_combo').parents("tr").remove();
                            },
                            400: (data) => {
                                alert(data.error);
                            }
                        }
                    })
                    ;
                }
            }

            $('.add_food').on('click', (e) => {
                foodGroup =
                    `<div class="input-group m-1">
                    <span class="input-group-text text-black-50">Thức ăn: </span>
                    <select type='text' name='food[]' class="form-select" aria-label="food">
                        <?php $__currentLoopData = $foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($food->id); ?>"><?php echo e($food->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <span class="input-group-text text-black-50"><?php echo app('translator')->get('lang.quantity'); ?>: </span>
                    <input type="number" name="quantity[]" class="form-control" placeholder="quantity..." aria-label="quantity">
                    <button type="button" class="btn btn-danger mb-0 delete_food"><i class="fa-solid fa-trash"></i></button>
                </div>`
                $(e.target).parent().find('.food_group').append(foodGroup);
            })

            $('.food_group').on('click', '.delete_food', (e) => {
                $(e.target).parent('.input-group').remove();
            })

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.file-uploader .img_combo').attr('src', e.target.result).removeClass('d-none');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".image-combo").change(function () {
                readURL(this);
            });
        });
    </script>
    <script>
        function changeStatus(combo_id, active) {
            if (active === 1) {
                $("#status" + combo_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changeStatus(' + combo_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
            } else {
                $("#status" + combo_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changeStatus(' + combo_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/combo/status",
                type: 'GET',
                dataType: 'json',
                data: {
                    'active': active,
                    'combo_id': combo_id
                },
                success: function (data) {
                    if (data['success']) {
                        // alert(data.success);
                    } else if (data['error']) {
                        alert(data.error);
                    }
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Combos/index.blade.php ENDPATH**/ ?>