
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>
                        Khách hàng
                        <label for="search">
                            <input type="text" placeholder="Nhập code hoặc email" class="form-controller" id="search" name="search"/>
                        </label>
                    </h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 ">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Code</th>
                                <th class="text-uppercase text-secondary  text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.fullname'); ?></th>
                                <th class="text-uppercase text-secondary  text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Số điện thoại</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã vạch</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hạng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Xác thực</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo $user['code']; ?></h6>
                                    </td>
                                    <td class="align-middle ">
                                        <h6 class="mb-0 text-sm "><?php echo $user['fullname']; ?></h6>
                                    </td>
                                    <td class="align-middle ">
                                        <span class="text-secondary font-weight-bold"><?php echo $user['email']; ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo $user['phone']; ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button href="#barcode" class="btn btn-link text-danger "
                                                data-bs-toggle="modal"
                                                data-bs-target="#code<?php echo $user['id']; ?>"><i style="color:grey" class="fa-sharp fa-regular fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary font-weight-bold"><?php echo e($user->level->name); ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold">
                                            <?php if($user->email_verified): ?>
                                                Xác nhận
                                            <?php else: ?>
                                                Chưa xác nhận
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <a onclick="deleteUser(<?php echo e($user->id); ?>)"
                                           class="text-secondary font-weight-bold text-xs delete_user">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade modal-md" id="code<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="barcode_title" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="barcode_title"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row ">
                                                        <div class="col-md-12">
                                                                <div class="flex-column d-flex justify-content-center text-center">
                                                                    <?php
                                                                        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                    ?>
                                                                    <div class="text-center">
                                                                        <img src="data:image/png;base64,<?php echo base64_encode($generatorPNG->getBarcode($user['code'],$generatorPNG::TYPE_CODE_128)); ?>" />
                                                                    </div>
                                                                    <div class="text-center mt-2">
                                                                        <?php echo $user['code']; ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                        
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {
            deleteUser = (id) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (confirm("Xóa khách hàng này?") === true) {
                    $.ajax({
                        url: 'admin/user/delete/' + id,
                        type: 'DELETE',
                        statusCode: {
                            200: function (data) {
                                console.log(trObj);
                                $('.delete_user').parents("tr").remove();
                            },
                            400: (data) => {
                                alert(data.error);
                            }
                        }
                    })
                    ;
                }
            }
            
            $paginate = $('#paginate');
            $flag = false;
            $('#search').on('keyup',function(){
                $user = $(this).val();
                if($user != '')
                    $flag = true;
                if($flag == true)
                {
                $.ajax({
                    type: 'get',
                    url: '<?php echo e(URL::to('admin/user/search')); ?>',
                    data: {
                        'search': $user
                    },
                    success:function(data){
                        $('tbody').html(data);
                        console.log($flag);
                        if($user == ''  ){
                            if($flag == true)
                            {
                                $('.card-body').append($paginate);
                                $flag = false;
                            }
                        }else{
                            $('#paginate').remove();
                            $flag = true;
                        }

                    }
                });
                }
            })
        });
    </script>
<script>
    function changestatus(user_id,active){
        if(active === 1){
            $("#status" + user_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus('+ user_id +',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        }else{
            $("#status" + user_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus('+ user_id +',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/user/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'user_id': user_id
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

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/users/index.blade.php ENDPATH**/ ?>