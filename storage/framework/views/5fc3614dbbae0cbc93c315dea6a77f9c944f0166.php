
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><?php echo app('translator')->get('lang.news'); ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a style="float:right;padding-right:30px;" class="text-light">
                            <button class=" btn btn-primary float-right mb-3" data-bs-toggle="modal" data-bs-target="#news"><?php echo app('translator')->get('lang.create'); ?></button>
                        </a>
                        <table class="table align-items-center mb-0 ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.title'); ?></th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.image'); ?></th>
                                    <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.content'); ?></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.status'); ?></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.created_at'); ?></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.updated_at'); ?></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm " style="width:200px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical"><?php echo $value['title']; ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        
                                        <?php if(strstr($value->image,"https") === false): ?>
                                        <img class="img-fluid rounded-start" style="max-width: 300px" src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($value->image); ?>.jpg" alt="">
                                        <?php else: ?>
                                        <img class="img-fluid rounded-start" style="max-width: 300px" src="<?php echo e($value->image); ?>" alt="">
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle text-left text-sm ">
                                        <span class="mb-0 text-sm " style="width:200px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;"><?php echo $value['content']; ?></span>
                                    </td>

                                    <td id="status<?php echo $value['id']; ?>" class="align-middle text-center text-sm">
                                        <?php if($value->status == 1): ?>

                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $value['id']; ?>,0)">
                                            <span class="badge badge-sm bg-gradient-success">Online</span>
                                        </a>

                                        <?php else: ?>
                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $value['id']; ?>,1)">
                                            <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo date('d/m/Y', strtotime($value['created_at'])); ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo date('d/m/Y', strtotime($value['updated_at'])); ?></span>
                                    </td>

                                    <td class="align-middle text-center" >
                                        <a href="#editNews" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit news" data-bs-target="#editNews<?php echo $value['id']; ?>" data-bs-toggle="modal">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" data-url="<?php echo e(url('admin/news/delete', $value['id'] )); ?>" class="text-secondary font-weight-bold text-xs delete-news" data-toggle="tooltip">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php echo $__env->make('admin.web.news.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.web.news.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="paginate" class="d-flex justify-content-center mt-3">
                        <?php echo $news->links(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-news').on('click', function() {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Are you sure you want to remove it?") === true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.file-uploader .img_news').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".image-news").change(function() {
        readURL(this);
    });
</script>
<script>
    function changestatus(news_id, active) {
        if (active === 1) {
            $("#status" + news_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + news_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + news_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + news_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/news/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'news_id': news_id
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/news/index.blade.php ENDPATH**/ ?>