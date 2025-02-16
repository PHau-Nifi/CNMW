
<?php $__env->startSection('content'); ?>
<section class="container-lg">
    <!-- Main content -->
    <div class="mt-5" id="Events">
        <ul class="nav justify-content-start mb-4 align-items-center">
            <li class="nav-item">
                <a class="h5 nav-link active fw-bold border-bottom border-2 movie-border" href="#tintuc" role="button" data-bs-target="#tintuc" disabled>
                    <?php echo app('translator')->get('lang.news'); ?>
                </a>
            </li>
        </ul>

        <div id="tintuc" class="d-flex flex-column" data-bs-parent="#Events">
            <?php $i = 1 ?>
            <?php $__currentLoopData = $news->where('status',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $i++ ?>
            <?php if($i % 2 == 0): ?>
            <!-- Post -->
            <div class="card mb-3">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <a href="/news-detail/<?php echo $value['id']; ?>">
                            <img class="img-fluid rounded-start" style="max-width: 300px" 
                            <?php if(strstr($value->image,"https") === false): ?>
                            src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($value->image); ?>.jpg"
                            <?php else: ?>
                                src="<?php echo e($value->image); ?>"
                            <?php endif; ?> 
                            alt="">
                        </a>
                    </div>
                    <div class="flex-grow-1">
                        <div class="card-body h-75">
                            <h5 class="card-title"><?php echo e($value->title); ?></h5>
                            <p class="card-text" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2;
                                           -webkit-box-orient: vertical">
                                <?php echo e(strip_tags($value->content)); ?>

                            </p>
                            <p class="card-text">
                                <small class="text-body-secondary"><?php echo date('d F Y', strtotime($value['created_at'] )); ?></small>
                            </p>
                        </div>
                        <div class="card-footer h-25">
                            <a href="/news-detail/<?php echo $value['id']; ?>" class="btn btn-primary float-end"><?php echo app('translator')->get('lang.more'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post: end -->
            <?php else: ?>
            <!-- Post -->
            <div class="card mb-3">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="card-body h-75">
                            <h5 class="card-title"><?php echo e($value->title); ?></h5>
                            <p class="card-text" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2;
                                           -webkit-box-orient: vertical"><?php echo e(strip_tags($value->content)); ?></p>
                            <p class="card-text"><small class="text-body-secondary"><?php echo date('d F Y', strtotime($value['created_at'] )); ?></small></p>
                        </div>
                        <div class="card-footer h-25">
                            <a href="/news-detail/<?php echo $value['id']; ?>" class="btn btn-primary float-start"><?php echo app('translator')->get('lang.show'); ?></a>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="/news-detail/<?php echo $value['id']; ?>">
                            <img class="img-fluid rounded-start" style="max-width: 300px" src="<?php echo e($value->image); ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Post: end -->
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $("#Events .nav .nav-item .nav-link").on("click", function() {
        $("#Events .nav-item").find(".active").removeClass("h5 nav-link active fw-bold border-bottom border-2 movie-border").addClass("link-secondary").prop('disabled', false);
        $(this).addClass("h5 nav-link active fw-bold border-bottom border-2 movie-border").removeClass("link-secondary").prop('disabled', true);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/news.blade.php ENDPATH**/ ?>