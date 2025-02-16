

<!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <section class="d-flex justify-content-center justify-content-lg-between p-2 border-bottom">
    <div class="me-5 d-none d-lg-block">
    </div>
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-youtube"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <img src="/images/web/<?php echo e($info->logo); ?>" alt="Logo" class="img-fluid">
          </h6>
          <p>
            HCinema - Nơi trải nghiệm điện ảnh tuyệt vời với hệ thống rạp chiếu phim hiện đại và dịch vụ đặt vé tiện lợi.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Sản phẩm
          </h6>
          <p>
            <a href="#!" class="text-reset">Phim</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Rạp chiếu</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Trailers</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Giới hạn độ tuổi</a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Liên kết
          </h6>
          <p>
            <a href="#!" class="text-reset">Thông tin</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Giới thiệu</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Chính sách bảo mật</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Điều khoản chung</a>
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <h6 class="text-uppercase fw-bold mb-4">Liên hệ</h6>
          <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><i class="fas fa-home me-3"></i><?php echo e($value); ?> </p>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <p>
            <i class="fas fa-envelope me-3"></i>
            <?php echo e($info->email); ?>

          </p>
          <p><i class="fas fa-phone me-3"></i> <?php echo e($info->phone); ?></p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-1" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="">B2005712</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
<?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/layouts/footer.blade.php ENDPATH**/ ?>