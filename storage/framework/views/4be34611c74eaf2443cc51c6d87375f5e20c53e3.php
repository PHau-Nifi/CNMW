
<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                Bán Combo
                <a class="btn btn-danger float-end" href="admin/buyCombo">Hủy</a>
            </div>

            <div class="card-body pt-2">
                <div class="row">
                    
                    <div class="col-12 fixed-start">
                        <h4>Combo</h4>
                        <div id="ticket_info" class="card mb-3 bg-dark text-light px-0 sticky-top">
                            <div class="row">
                                <div class="col-12 col-md-9 col-lg-12">
                                    <div class="card-body">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="background: #2e292e;">
                                <div class="d-flex flex-column">
                                    <div class="d-flex text-light p-2">
                                        <span class="flex-shrink-0"><i class="fa-solid fa-popcorn"></i>&numsp;Combo:</span>
                                        <div id="ticket_combos" class="flex-grow-1 text-end d-flex flex-column"></div>
                                    </div>
                                    <div class="d-flex text-light p-2">
                                        <span class="flex-shrink-0"><i class="fa-solid fa-equals"></i>&numsp;Tổng tiền:</span>
                                        <div class="flex-grow-1 text-end .ticketTotal"><span id="ticketSeat_totalPrice"></span> đ</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    
                    <div class="col-12">
                        
                        <ul class="nav justify-content-around fw-bold">
                            <li class="nav-item">
                                <a class="nav-link disabled text-secondary" href="#Combos">2. Chọn Combo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled text-secondary" href="#Payment">3. Thanh toán</a>
                            </li>
                        </ul>
                        <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="10" aria-valuemin="0"
                             aria-valuemax="30" style="height: 2px">
                            <div class="progress-bar bg-warning" style="width: 34%"></div>
                        </div>
                        

                        <div id="mainTicket">

                            
                            <div id="Combos" class="mt-5 collapse show" data-bs-parent="#mainTicket">
                                <h4>Chọn Combo</h4>
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
                                                                <button class="btn mb-0 minus_combo disabled" type="button"
                                                                        onclick="minusCombo(<?php echo e($combo->id); ?>, <?php echo e($combo->price); ?>, '<?php echo e($combo->name); ?>')">
                                                                    <i class="fa-solid fa-circle-minus"></i>
                                                                </button>
                                                                <input type="number" class="form-control input_combo"
                                                                       name="combo[<?php echo e($combo->id); ?>]" value="0"
                                                                       readonly min="0"
                                                                       style="max-width: 80px" aria-label="">
                                                                <button class="btn mb-0 plus_combo" type="button"
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

                                    <button class="btn btn-warning mx-2 text-decoration-underline text-center
                                    btn_next "
                                            onclick="comboNext()"
                                            aria-controls="Payment"
                                            aria-expanded="false"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#Payment"
                                    >Tiếp theo <i class="fa-solid fa-angle-right"></i></button>
                                </div>
                            </div>

                            
                            <div id="Payment" class="mt-5 collapse" data-bs-parent="#mainTicket">

                                <h4 class="mt-4">Thanh toán</h4>
                                <form id="paymentForm" action="admin/buyTicket/createPayment" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="bg-dark-subtle p-5">
                                        <div class="row row-cols-1" data-bs-parent="#mainContent">
                                            <div class="col">
                                                <div class="bg-light p-4" id="bankCode">
                                                    <div class="form-check mb-3">
                                                        <input id="bankCode1" class="btn-check" type="radio" name="bankCode" value="QR"
                                                               aria-label="">
                                                        <label for="bankCode1"
                                                               class="custom-control-label btn btn-outline-primary fw-semibold fs-4 w-100 text-start
                                                               text-dark">
                                                            Thanh toán bằng ứng dụng
                                                            <span class="vnpay-logo">
                                                            <span class="vnpay-red">Momo</span><sup class="vnpay-red">QR</sup></span>
                                                        </label>
                                                    </div>

                                                    <div class="form-check mb-3">
                                                        <input id="bankCode4" class="btn-check" type="radio" name="bankCode" value="MONEY"
                                                               aria-label="" checked>
                                                        <label for="bankCode4"
                                                               class="custom-control-label btn btn-outline-primary fw-semibold fs-4 w-100
                                                               text-start text-dark">
                                                            Thanh toán tiền mặt
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="amount" name="amount">

                                                
                                            </div>

                                        </div>
                                    </div>


                                    <div class="d-flex justify-content-center mt-4">
                                        <button type="button" class="btn btn-warning mx-2 text-decoration-underline text-center"
                                                onclick="paymentBack()"
                                                aria-expanded="true"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#Combos">
                                            <i class="fa-solid fa-angle-left"></i> Trước
                                        </button>
                                        <button type="button" onclick="paymentNext()"
                                                class="btn btn-warning mx-2 text-decoration-underline text-uppercase text-center">
                                            Đặt vé <i class="fa-solid fa-angle-right"></i>
                                        </button>
                                    </div>
                                </form>
                                <form action="/admin/buyTicket/create" method="post" id="booking">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="user_id" id="user_id" value="">
                                        <input type="hidden" name="ticketCombos[]" id="ticketCombo">
                                        <input type="hidden" name="totalPrice" id="totalPrice">
                                        <input type="hidden" name="ticketPayment" id="ticketPayment">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(() => {
            var $sum= 0;
            var $ticket_combos = {};
            let $iCombo = [];
            $('.input_combo').on('input', function() {
                let comboId = $(this).data('combo-id');
                let comboPrice = $(this).data('combo-price');
                let comboName = $(this).data('combo-name');
                let quantity = $(this).val();
                
                let totalComboPrice = comboPrice * quantity;
                if('#ticketCombo_'+ comboId) $('#ticketCombo_' + comboId).remove();
                $('#ticket_combos').append(`<p id="ticketCombo_${comboId}" class="text-white">${comboName} x ${quantity}</p>`);
                $sum += totalComboPrice;
                $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                $('#totalPrice').val($sum.toLocaleString('vi-VN'));
                $ticket_combos[comboId] = {
                    name: comboName,
                    price: comboPrice,
                    quantity: quantity
                };
            });

            plusCombo = (id, price, comboName) => {
                $iCombo++;
                $inputCombo = $('#Combo_' + id).find('.input_combo');
                $inputCombo.val(parseInt($inputCombo.val()) + 1);
                if (parseInt($inputCombo.val()) > 4) {
                    $inputCombo.parent().find('.plus_combo').addClass('disabled');
                    return;
                }
                $inputCombo.parent().find('.minus_combo').removeClass('disabled');
                if (parseInt($inputCombo.val()) === 1)
                    $('#ticket_combos').append(`<p class="text-white" id="ticketCombo_${id}">${comboName} x ${parseInt($inputCombo.val())}</p>`);
                else
                    $(`#ticketCombo_${id}`).replaceWith(`<p class="text-white" id="ticketCombo_${id}">${comboName} x ${parseInt($inputCombo.val())}</p>`);
                $sum += price;
                $("#totalPrice").val($sum);
                $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                $ticket_combos[id] = [id, parseInt($inputCombo.val())];
                if ($inputCombo.val() === '4') {
                    $inputCombo.parent().find('.plus_combo').addClass('disabled');
                    return;
                }
            }

            minusCombo = (id, price, comboName) => {
                $inputCombo = $('#Combo_' + id).find('.input_combo');
                if ($iCombo !== 0) {
                    $iCombo--;
                }
                if (parseInt($inputCombo.val()) === 0) {
                    $inputCombo.parent().find('.minus_combo').addClass('disabled');
                    return;
                }
                $inputCombo.val(parseInt($inputCombo.val()) - 1);
                $inputCombo.parent().find('.plus_combo').removeClass('disabled');
                if (parseInt($inputCombo.val()) === 0) {
                    $(`#ticketCombo_${id}`).remove();
                } else {
                    $(`#ticketCombo_${id}`).replaceWith(`<p class="text-white" id="ticketCombo_${id}">${comboName} x ${parseInt($inputCombo.val())}</p>`);
                }
                $sum -= price;
                $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                if (parseInt($inputCombo.val()) === 0) {
                    delete $ticket_combos[id];
                } else {
                    $ticket_combos[id] = [id, parseInt($inputCombo.val())];
                }
                $("#totalPrice").val($sum);
            }

            comboNext = () => {
                $check = jQuery.isEmptyObject($ticket_combos);
                if (!$check) {
                    $("#ticketCombo").val(JSON.stringify($ticket_combos));
                    $("#totalPrice").val($sum);
                }
            }

            $("input[name='bankCode']").change(function() {
                var payment = $("input[name='bankCode']:checked").val();
                console.log(payment);
                
                $("#ticketPayment").val(payment);
            });

            paymentNext = () => {
                $("#booking").submit();

            }

            paymentBack = () => {
                $("#ticketCombo").val();
            }

        })
    </script>
    <script>
        <?php if(session('success')): ?>
        Swal.fire({
            title: '<?php echo e(session('success')); ?>',
            icon: 'success',
            confirmButtonText: 'Ok'
        })
        <?php endif; ?>
        <?php if(session('fail')): ?>
        Swal.fire({
            title: '<?php echo e(session('fail')); ?>',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/buyCombo/index.blade.php ENDPATH**/ ?>