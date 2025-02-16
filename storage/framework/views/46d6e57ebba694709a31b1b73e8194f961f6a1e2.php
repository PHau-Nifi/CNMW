
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 ">
                    <h5>
                        <?php echo app('translator')->get('lang.rating'); ?>
                    </h5>
                    <button style="float:right;padding-right:30px;" class="me-5  btn bg-gradient-danger float-right mb-3" data-bs-toggle="modal" data-bs-target="#rating">
                        <?php echo app('translator')->get('lang.add'); ?>
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        
                        <table class="table align-items-center mb-0 ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.movie_genre'); ?></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.status'); ?></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.description'); ?></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo e($rating->name); ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo e($rating->description); ?></span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="#editRating" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                       data-original-title="Edit director" data-bs-target="#editRating<?php echo $rating['id']; ?>"
                                       data-bs-toggle="modal">
                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                    </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" data-url="<?php echo e(url('admin/rating/delete', $rating['id'] )); ?>" class="text-secondary font-weight-bold text-xs delete-rating" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php echo $__env->make('admin.web.Movie_genres.editRating', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('admin.web.Movie_genres.createRating', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 ">
                    <h5>
                        <?php echo app('translator')->get('lang.movie_genre'); ?>
                    </h5>
                    <button style="float:right;padding-right:30px;" class="me-5  btn bg-gradient-danger float-right mb-3" data-bs-toggle="modal" data-bs-target="#moviegenre">
                        <?php echo app('translator')->get('lang.create'); ?>
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        
                        <table class="table align-items-center mb-0 ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.movie_genre'); ?></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.status'); ?></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $movieGenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo e($value->name); ?></h6>
                                    </td>
                                    <td id="status<?php echo $value['id']; ?>" class="align-middle text-center text-sm">
                                        <?php if($value['status'] == 1): ?>
                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $value['id']; ?>,0)">
                                            <span class="badge badge-sm bg-gradient-success">Online</span>
                                        </a>
                                        <?php else: ?>
                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $value['id']; ?>,1)">
                                            <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="#editMovieGenre" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                       data-original-title="Edit director" data-bs-target="#editMovieGenre<?php echo $value['id']; ?>"
                                       data-bs-toggle="modal">
                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" data-url="<?php echo e(url('admin/moviegenre/delete', $value['id'] )); ?>" class="text-secondary font-weight-bold text-xs delete-moviegenre" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php echo $__env->make('admin.web.Movie_genres.editMovieGenre', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div id="paginate" class="d-flex justify-content-center mt-3">
                            <?php echo $movieGenres->links(); ?>

                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('admin.web.Movie_genres.createMovieGenre', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        $paginate = $('#paginate');
        $flag = false;
    });
</script>
<script>
    function changestatus(movieGenres_id, active) {
        if (active === 1) {
            $("#status" + movieGenres_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + movieGenres_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + movieGenres_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + movieGenres_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/moviegenre/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'movieGenres_id': movieGenres_id
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
<script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.delete-rating').on('click', function () {
                var userURL = $(this).data('url');
                console.log($(this).data('url'));
                
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
            $('.delete-moviegenre').on('click', function () {
                var userURL = $(this).data('url');
                console.log($(this).data('url'));
                
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Movie_genres/index.blade.php ENDPATH**/ ?>