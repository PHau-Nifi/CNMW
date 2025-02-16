<form action="admin/banners/create" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="banner" tabindex="-1" aria-labelledby="banner_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banner_title"><?php echo app('translator')->get('lang.banners'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group file-uploader">
                                    <label for="example-text-input" class="form-control-label"><?php echo app('translator')->get('lang.image'); ?></label>
                                    <input type='file' name='Image' class="form-control image-director">
                                    <img style="width: 300px" src="" class="img_direc d-none" alt="user1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>

            </div>
        </div>
    </div>
</form><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Banners/create.blade.php ENDPATH**/ ?>