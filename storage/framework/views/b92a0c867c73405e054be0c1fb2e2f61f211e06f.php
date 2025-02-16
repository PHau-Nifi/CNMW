
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 ">
                    <h5>
                        <?php echo app('translator')->get('lang.movies'); ?>
                    </h5>
                    <a href="admin/movie/moviegenre" style="float:right; padding-right:30px;">
                        <button class=" btn bg-gradient-info float-right mb-3"><?php echo app('translator')->get('lang.movie_genre'); ?> - <?php echo app('translator')->get('lang.rating'); ?></button>
                    </a>
                    <a href="admin/movie/create" style="float:right; padding-right:30px;">
                        <button class=" btn bg-gradient-danger float-right mb-3"><?php echo app('translator')->get('lang.add'); ?></button>
                    </a>
                   
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        
                        <table class="table align-items-center mb-0 ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.movie_genre'); ?></th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.image'); ?></th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.movie_name'); ?></th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.showtime'); ?></th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.national'); ?></th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.release_date'); ?></th>
                                    <th class="text-uppercase text-dark text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.end_date'); ?></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.status'); ?></th>
                                    <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <?php $__currentLoopData = $movie->movieGenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <h6 class="mb-0 text-sm "><?php echo e($genre->name); ?></h6>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php if(strstr($movie->image,"https") === false): ?>
                                        <img class="img-fluid rounded-start" style="height: 200px" src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie->image); ?>.jpg" alt="">
                                        <?php else: ?>
                                        <img class="img-fluid rounded-start" style="height: 200px" src="<?php echo e($movie->image); ?>" alt="">
                                        <?php endif; ?>
                                        
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="accordion-body mt-4 mb-3 w-100">
                                            <?php echo e($movie->name); ?>

                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo e($movie->showTime); ?> phút</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm "><?php echo e($movie->national); ?></h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo date("d-m-Y", strtotime($movie->releaseDate )); ?></span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold"><?php echo date("d-m-Y", strtotime($movie->endDate)); ?></span>
                                    </td>
                                    <td id="status<?php echo $movie['id']; ?>" class="align-middle text-center text-sm">
                                        <?php if($movie['status'] == 1): ?>
                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $movie['id']; ?>,0)">
                                            <span class="badge badge-sm bg-gradient-success">Online</span>
                                        </a>
                                        <?php else: ?>
                                        <a href="javascript:void(0)" class="btn_active" onclick="changestatus(<?php echo $movie['id']; ?>,1)">
                                            <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="admin/movie/edit/<?php echo $movie['id']; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="paginate" class="d-flex justify-content-center mt-3">
                        <?php echo $movies->links(); ?>

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
        $paginate = $('#paginate');
        $flag = false;
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: "<?php echo e(URL::to('admin/movie/search')); ?>",
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('tbody').html(data);
                    if ($value == '' && $flag == true) {
                        $('.card-body').append($paginate);
                        $flag = false;
                    } else {
                        $('#paginate').remove();
                        $flag = true;
                    }

                }
            });
        })
    });
</script>
<script>
    function changestatus(movie_id, active) {
        if (active === 1) {
            $("#status" + movie_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + movie_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + movie_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + movie_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/movie/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'movie_id': movie_id
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
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/movies/index.blade.php ENDPATH**/ ?>