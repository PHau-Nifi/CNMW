<form action="admin/news/edit/<?php echo $value['id']; ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="editNews<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="news_title" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="news_title"><?php echo $value['name']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><?php echo app('translator')->get('lang.title'); ?></label>
                                    <input class="form-control" type="text" value="<?php echo $value['title']; ?>" name="title">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group file-uploader">
                                    <label for="example-text-input" class="form-control-label"><?php echo app('translator')->get('lang.image'); ?></label>
                                    <input type="text" name="image_url" class="form-control" placeholder="Nhập đường link hình ảnh">
                                    <input type='file' name='Image' class="form-control image-news">
                                        <img style="width: 300px"
                                             src="<?php echo $value['image']; ?>"
                                             class="img_news"alt="user1">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label"><?php echo app('translator')->get('lang.content'); ?></label>
                                    <textarea class="form-control" name="content" id="editor"><?php echo $value['content']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('lang.save'); ?></button>
                </div>

            </div>
        </div>
    </div>
</form>
<?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/news/edit.blade.php ENDPATH**/ ?>