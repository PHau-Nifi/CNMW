
<?php $__env->startSection('content'); ?>
<section class="container clearfix">
    <nav aria-label="breadcrumb mt-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="link link-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
            <li class="breadcrumb-item"><a href="/movies" class="link link-dark text-decoration-none">
            <?php if($movie['releaseDate'] > date('Y-m-d')): ?>
                Phim sắp chiếu
            <?php else: ?>
                Phim đang chiếu
            <?php endif; ?>
                </a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($movie->name); ?></li>
        </ol>
    </nav>
    <div class="movieDetails mt-5">
        <h3 class="mb-3 pb-3 border-bottom border-3">Nội dung phim</h3>
        <div class="row">
            <div class="col-2">
                <img class="lazy img-responsive" 
                    <?php if(strstr($movie->image,"https") === false): ?>
                        src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie->image); ?>.jpg"
                    <?php else: ?>
                        src="<?php echo e($movie->image); ?>"
                    <?php endif; ?> 
                    alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN">
            </div>
            <div class="col">
                <h4 class="pb-3 border-bottom"><?php echo $movie['name']; ?></h4>
                <div class="mt-3">
                    <div class="product-info">
                        <div class="movie-info">
                            <span class="bold">Đạo diễn: </span>
                            <span class="normal"><?php echo $movie['director']; ?></span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Diễn viên: </span>
                            <span class="normal"><?php echo $movie['cast']; ?></span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Thể loại: </span>
                            <span class="normal">
                            <?php $__currentLoopData = $movie->movieGenres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($loop->first): ?>
                                    <?php echo e($genre->name); ?>

                                <?php else: ?>
                                    , <?php echo e($genre->name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Thời lượng: </span>
                            <span class="normal"><?php echo $movie['showTime']; ?></span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Khởi chiếu: </span>
                            <span class="normal"><?php echo $movie['releaseDate']; ?></span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Quốc gia: </span>
                            <span class="normal"><?php echo $movie['nation']; ?></span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Rate: </span>
                            <span class="normal">
                                <?php echo e($movie->rating->name); ?>

                            </span>
                            - <?php echo e($movie->rating->description); ?>

                        </div>
                        <?php if($movie['releaseDate'] > date('Y-m-d')): ?>
                           
                        <?php else: ?>
                            <ul>
                                <li class="booking mt-3">
                                    <button class="btn btn-booking" data-bs-toggle="modal" data-bs-target="#datve"><i class="fa-solid fa-receipt"></i> Đặt vé</button>
                                </li>
                            </ul>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
            <?php echo $__env->make('web.movieDetailSchedules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div id="Detail" class="mt-3">
                <ul class="nav justify-content-center mb-4 align-items-center m-auto">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold border-bottom detail"
                                aria-expanded="true"
                                data-bs-toggle="collapse"
                                data-bs-target="#chitiet" disabled>
                            Chi tiết
                        </button>
                    </li>
                    <li class="vr mx-5"></li>
                    <li class="nav-item">
                        <button class="nav-link link-secondary trailer"
                                aria-expanded="false"
                                data-bs-toggle="collapse" data-bs-target="#trailer">
                                Trailer
                        </button>
                    </li>
                </ul>
                <div id="chitiet" class="row g-4 mt-2 collapse show" data-bs-parent="#Detail">
                    <div class="movie-info">
                        <span class="bold">Nội dung: </span>
                        <span class="normal"><?php echo $movie['description']; ?></span>
                    </div>
                </div>
                <div id="trailer" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse justify-content-center" data-bs-parent="#Detail">
                    <iframe width="560" height="315" src="<?php echo $movie['trailer']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function () {
        $("#cityParent .d-flex .flex-city .btn").on("click", function () {
                $("#cityParent .flex-city").find(".btn").removeClass("btn-danger").addClass("btn-outline-dark").prop('disabled', false);
                $(this).addClass("btn-danger").removeClass("btn-outline-dark").prop('disabled', true);
        });
        $(".listDate button").on('click', function () {
                $(".listDate").find(".btn").removeClass('active');
                $(this).addClass("active");
        })

        $('.detail').click(function() {
            $(this).removeClass('link-secondary').addClass('active fw-bold border-bottom').attr('disabled', true);
            $('.trailer').removeClass('active fw-bold border-bottom').addClass('link-secondary').attr('disabled', false);
        });

        $('.trailer').click(function() {
            $(this).removeClass('link-secondary').addClass('active fw-bold border-bottom').attr('disabled', true);
            $('.detail').removeClass('active fw-bold border-bottom').addClass('link-secondary').attr('disabled', false);
        });
    });
</script>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/movieDetails.blade.php ENDPATH**/ ?>