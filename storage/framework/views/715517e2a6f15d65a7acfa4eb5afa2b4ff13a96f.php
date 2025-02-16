
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><?php echo app('translator')->get('lang.discount'); ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a style="float:right;padding-right:30px;" class="text-light">
                            <button class=" btn bg-gradient-info float-right mb-3" data-bs-toggle="modal" data-bs-target="#discount"><?php echo app('translator')->get('lang.create'); ?>
                            </button>
                        </a>
                        <table class="table align-items-center mb-0 ">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.name'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.code'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.percent'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.quantity'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.release_date'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.end_date'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.status'); ?></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $discount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo $value['name']; ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo $value['code']; ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo $value['percent']; ?> %</h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo $value['quantity']; ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo $value['startTime']; ?> </h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo $value['endTime']; ?> </h6>
                                    </td>
                                    <td id="status<?php echo $value['id']; ?>" class="align-middle text-center text-sm ">
                                        <?php if($value['status'] == 1): ?>
                                            <a href="javascript:void(0)" class="btn_active"  onclick="changestatus(<?php echo $value['id']; ?>,0)">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="javascript:void(0)" class="btn_active"  onclick="changestatus(<?php echo $value['id']; ?>,1)">
                                                <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="#editDiscount" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                           data-original-title="Edit discount" data-bs-target="#editDiscount<?php echo $value['id']; ?>"
                                           data-bs-toggle="modal">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" data-url="<?php echo e(url('admin/discount/delete', $value['id'] )); ?>"
                                           class="text-secondary font-weight-bold text-xs delete-discount" data-toggle="tooltip">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php echo $__env->make('admin.web.discounts.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php echo $__env->make('admin.web.discounts.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="d-flex justify-content-center mt-3">
                        <?php echo $discount->links(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    flatpickr(  $("#endDate"),{
        dateFormat: "Y-m-d ",
    });
    flatpickr(  $("#releaseDate"),{
        dateFormat: "Y-m-d ",
    });
    flatpickr(  $("#endTime"),{
        dateFormat: "Y-m-d ",
    });
    flatpickr(  $("#startTime"),{
        dateFormat: "Y-m-d ",
    });
</script>
    <script>
        
        flatpickr(  $("#endDate"),{
            dateFormat: "Y-m-d ",
        });
        flatpickr(  $("#releaseDate"),{
            dateFormat: "Y-m-d ",
        });
        $(document).ready(function () {
            $('#level').select2({
                placeholder: "<?php echo app('translator')->get('lang.select_level'); ?>",
                tag: true
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
            $('.delete-discount').on('click', function () {
                var userURL = $(this).data('url');
                var trObj = $(this);
                if (confirm("Are you sure you want to remove it?") === true) {
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
        function changestatus(discount_id,active){
            if(active === 1){
                $("#status" + discount_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus('+ discount_id +',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
            }else{
                $("#status" + discount_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus('+ discount_id +',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/discount/status",
                type: 'GET',
                dataType: 'json',
                data: {
                    'active': active,
                    'discount_id': discount_id
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

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/discounts/index.blade.php ENDPATH**/ ?>