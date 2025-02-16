<form action="admin/moviegenre/create" method="POST">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="moviegenre" tabindex="-1" aria-labelledby="moviegenre_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="moviegenre_title"><?php echo app('translator')->get('lang.movie_genre'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><?php echo app('translator')->get('lang.name'); ?></label>
                                    <input aria-label="" id="fn" class="form-control" type="text" value="" name="name"
                                           placeholder="<?php echo app('translator')->get('lang.type'); ?> <?php echo app('translator')->get('lang.name'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
                    <button type="submit" class="btn bg-gradient-info"><?php echo app('translator')->get('lang.save'); ?></button>
                </div>
            </div>
        </div>
    </div>
</form>     <?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Movie_genres/createMovieGenre.blade.php ENDPATH**/ ?>