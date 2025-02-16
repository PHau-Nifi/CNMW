
<?php $__env->startSection('content'); ?>
<section class="container clearfix">
    <div class="Movies" id="Movies">
        <ul class="nav justify-content-start mb-4 align-items-center">
            <li class="nav-item">
                <button class="h5 nav-link active fw-bold border-bottom border-2 movie-border"
                        aria-expanded="true"
                        data-bs-toggle="collapse"
                        data-bs-target="#phimdangchieu" disabled>
                    Phim đang chiếu
                </button>
            </li>
            <li class="vr mx-5"></li>
            <li class="nav-item me-auto">
                <button class="h5 nav-link link-secondary "
                        aria-expanded="false"
                        data-bs-toggle="collapse" data-bs-target="#phimsapchieu">
                    Phim sắp chiếu
                </button>
            </li>
    
            <button class="btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="fa-solid fa-filter"></i>
            </button>
        </ul>
    
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
           <div class="offcanvas-header">
               <h5 class="offcanvas-title" id="offcanvasRightLabel">Bộ lọc</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
           </div>
           <div class="offcanvas-body">
               <form action="/movies/filter" method="get">
                   <div class="m-2 form-group mb-3">
                       <label class="form-label" for="movieGenres">Thể loại</label>
                       <select id="movieGenres" class="form-select" name="movieGenres[]" multiple>
                            <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($genre->id); ?>"><?php echo e($genre->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>
                   </div>
    
                   <div class="m-2 form-group mb-3">
                       <label class="form-label" for="rating ">Giới hạng độ tuổi</label>
                       <select id="rating" class="form-select" name="rating">
                            <option value="">Chọn</option>
                            <?php $__currentLoopData = $rating; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rating->id); ?>"><?php echo e($rating->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       </select>
                   </div>

                   <button type="submit" class="btn btn-primary m-2 mt-4 w-100">Xác nhận</button>
               </form>
           </div>
        </div>

        <div id="phimdangchieu" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse show" data-bs-parent="#Movies">
            <div class="product w-100">
                <div class="row d-flex justify-content-center">
                    <div class="product-list ">
                        <div class="row movieDetails">
                            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($movie->releaseDate <= date('Y-m-d') && $movie->endDate >= date('Y-m-d')): ?>
                                <article class="col-md-3 col-sm-4 col-xs-6 thumb grid-item post-38424 mt-3">
                                    <div class="item">
                                       <a class="thumb" href="/movie/<?php echo e($movie->id); ?>" title="<?php echo $movie['name']; ?>">
                                        <figure><img class="lazy img-responsive" 
                                            <?php if(strstr($movie->image,"https") === false): ?>
                                                src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie->image); ?>.jpg"
                                            <?php else: ?>
                                                src="<?php echo e($movie->image); ?>"
                                            <?php endif; ?>
                                            alt="" title="<?php echo $movie['name']; ?>" ></figure>
                                        <span class="status
                                        <?php if($movie->rating->name == 'C18'): ?> bg-danger
                                        <?php elseif($movie->rating->name == 'C16'): ?> bg-warning
                                        <?php elseif($movie->rating->name == 'P'): ?> bg-success
                                        <?php elseif($movie->rating->name == 'K'): ?> bg-primary
                                        <?php else: ?> bg-info
                                        <?php endif; ?> me-1"><?php echo $movie->rating->name; ?></span>
                                        <div class="product-info" style="min-height: 116px">
                                            <h2 class="product-name"><?php echo $movie['name']; ?></h2>
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
                                            
                                        </div>
                                       </a>
                                    </div>
                                </article>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="phimsapchieu" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse" data-bs-parent="#Movies">
            <div class="product w-100">
                <div class="row d-flex justify-content-center">
                    <div class="product-list">
                        <div class="row movieDetails">
                            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($movie->releaseDate > date('Y-m-d')): ?>
                                <article class="col-md-3 col-sm-4 col-xs-6 thumb grid-item post-38424">
                                    <div class="item">
                                       <a class="thumb" href="/movie/<?php echo e($movie->id); ?>" title="<?php echo $movie['name']; ?>">
                                        <figure><img class="lazy img-responsive" 
                                            <?php if(strstr($movie->image,"https") === false): ?>
                                                src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie->image); ?>.jpg"
                                            <?php else: ?>
                                                src="<?php echo e($movie->image); ?>"
                                            <?php endif; ?>
                                            alt="" title="<?php echo $movie['name']; ?>"></figure>
                                        <span class="status
                                        <?php if($movie->rating->name == 'C18'): ?> bg-danger
                                        <?php elseif($movie->rating->name == 'C16'): ?> bg-warning
                                        <?php elseif($movie->rating->name == 'P'): ?> bg-success
                                        <?php elseif($movie->rating->name == 'K'): ?> bg-primary
                                        <?php else: ?> bg-info
                                        <?php endif; ?> me-1"><?php echo $movie->rating->name; ?></span>
                                        <div class="product-info" style="min-height: 116px">
                                            <h2 class="product-name"><?php echo $movie['name']; ?></h2>
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
                                            
                                        </div>
                                       </a>
                                    </div>
                                </article>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function () {

            $('#rating').select2({
                tags: true
            })

            $('#movieGenres').select2({
                tags: true
            });

            $("#Movies .nav .nav-item .nav-link").on("click", function () {
                $("#Movies .nav-item").find(".active").removeClass("active fw-bold border-bottom border-2 movie-border").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active fw-bold border-bottom border-2 movie-border").removeClass("link-secondary").prop('disabled', true);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/movies.blade.php ENDPATH**/ ?>