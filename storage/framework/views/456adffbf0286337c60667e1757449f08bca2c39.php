
<?php $__env->startSection('css'); ?>
    .image img{
        width: 100%;
    }
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="container-lg">
        
        <nav aria-label="breadcrumb mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="link link-dark text-decoration-none"><?php echo app('translator')->get('lang.home'); ?></a></li>
                <li class="breadcrumb-item"><a href="#" class="link link-dark text-decoration-none"><?php echo app('translator')->get('lang.events'); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $news['title']; ?></li>
            </ol>
        </nav>
        
        <div class="row container">
            <h2 class="mt-4"><?php echo $news['title']; ?></h2>
            <div class="text-center">
                <?php if(strstr($news['image'],"https") == ""): ?>
                    <img style="width: 75%" class="card-img-top rounded-0" alt='...'
                         src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo $news['image']; ?>.jpg">
                <?php else: ?>
                    <img style="width: 75%" class="card-img-top rounded-0" alt='...'
                         src="<?php echo $news['image']; ?>">
                <?php endif; ?>
            </div>
            <div class="accordion-item">
                <div class="accordion-body mt-4 mb-3 w-100">
                    <?php echo $news['content']; ?>

                </div>
            </div>

        </div>
        <div class="row container">
            <h5 class="mt-4"><?php echo app('translator')->get('lang.other_news'); ?></h5>
            <?php $__currentLoopData = $news_all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-4 border-warning rounded-0">
                        <a href="/news-detail/<?php echo $value['id']; ?>">
                                <img class="card-img-top rounded-0" alt='...'
                                <?php if(strstr($value->image,"https") === false): ?>
                                src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($value->image); ?>.jpg"
                                <?php else: ?>
                                    src="<?php echo e($value->image); ?>"
                                <?php endif; ?>>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/news_detail.blade.php ENDPATH**/ ?>