
<div id="Combos" class="mt-5 collapse" data-bs-parent="#mainTicket">
    <h4>Combo</h4>
    <div class="row g-2 mt-2 row-cols-2" data-bs-parent="#mainContent">
        <?php $__currentLoopData = $combos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Combo -->
            <div class="col">
                <div class="card px-0 overflow-hidden" id="Combo_<?php echo e($combo->id); ?>"
                     style="background: #f5f5f5">
                    <div class="row g-0">
                        <div class="col-lg-4 col-12">
                            <img class="img-fluid w-100" alt="..." style="max-height: 361px; max-width: 241px"
                            <?php if(strstr($combo->image,"https") === false): ?>
                                src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($combo->image); ?>.jpg"
                            <?php else: ?>
                                src="<?php echo e($combo->image); ?>"
                            <?php endif; ?>>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?php echo e($combo->name); ?></h5>
                                <p class="card-text text-dark">
                                    <?php $__currentLoopData = $combo->foods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $food): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($loop->first): ?>
                                            <?php echo e($food->pivot->quantity . ' ' . $food->name); ?>

                                        <?php else: ?>
                                            + <?php echo e($food->pivot->quantity . ' ' . $food->name); ?>

                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                                <p class="card-text">Giá: <span class="fw-bold"><?php echo e(number_format($combo->price)); ?> đ</span></p>
                            </div>
                            <div class="card-body input_combo_block">
                                <div class="input-group">
                                    <button class="btn minus_combo disabled"
                                        onclick="minusCombo(<?php echo e($combo->id); ?>, <?php echo e($combo->price); ?>, '<?php echo e($combo->name); ?>')">
                                        <i class="fa-solid fa-circle-minus"></i>
                                    </button>
                                    <input type="number" class="form-control input_combo" name="combo[<?php echo e($combo->id); ?>]" value="0" min="0" max="4" style="max-width: 80px" aria-label=""
                                    data-combo-id="<?php echo e($combo->id); ?>" data-combo-price="<?php echo e($combo->price); ?>" data-combo-name="<?php echo e($combo->name); ?>"
                                    >
                                    <button class="btn plus_combo"
                                        onclick="plusCombo(<?php echo e($combo->id); ?>, <?php echo e($combo->price); ?>, '<?php echo e($combo->name); ?>')">
                                        <i class="fa-solid fa-circle-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Combo: end -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <button id="comboBack" class="btn btn-warning mx-2 text-decoration-underline text-center btn_back"
                onclick="comboBack()"
                aria-expanded="false"
                data-bs-toggle="collapse"
                data-bs-target="#Seats"
        ><i class="fa-solid fa-angle-left"></i> Quay lại
        </button>

        <button class="btn btn-warning mx-2  text-decoration-underline text-center btn_next"
                onclick="comboNext()"
                aria-controls="Payment"
                aria-expanded="false"
                data-bs-toggle="collapse"
                data-bs-target="#Payment"
        >Thanh toán <i class="fa-solid fa-angle-right"></i></button>
    </div>
</div><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/combo.blade.php ENDPATH**/ ?>