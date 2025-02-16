
<?php $__env->startSection('content'); ?>
    <section class="container clearfix">
        <nav aria-label="breadcrumb mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="link link-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="/movie/<?php echo e($movie->id); ?>" class="link link-dark"><?php echo e($movie->name); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#" class="link link-secondary disabled text-decoration-none">Vé</a>
                </li>
            </ol>
        </nav>
        <?php if(session('warning')): ?>
            <div class="alert alert-warning">
                <?php echo e(session('warning')); ?>

            </div>
        <?php endif; ?>
        <div class="row">
            
            <div class="col-12 col-lg-3">
                <h4>Thông tin</h4>
                <div id="ticket_info" class="card mb-3 bg-dark text-light px-0 sticky-top">
                    <div class="row">
                        <div class="col-12 col-md-3 col-lg-12 d-flex justify-content-center">
                                <img class="img p-3 w-100" alt="..." style="max-height: 361px; max-width: 241px" 
                                <?php if(strstr($movie->image,"https") === false): ?>
                                    src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie['image']); ?>.jpg"
                                <?php else: ?>
                                    src="<?php echo e($movie['image']); ?>"
                                <?php endif; ?> >
                        </div>
                        <div class="col-12 col-md-9 col-lg-12">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($movie->name); ?></h5>
                                <ul class="list-group">
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        Thời gian:
                                        <strong class="ps-2">
                                            <?php echo e(date('d/m/Y', strtotime($schedule->date)).' '.date('H:i', strtotime($schedule->startTime))); ?>

                                        </strong>
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        Rạp: <strong class="ps-2"><?php echo e($room->theater->name); ?></strong>
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        Phòng: <strong class="ps-2"><?php echo e($room->name); ?></strong>
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        Xếp hạng: <strong class="ps-2">
                                        <span class="badge <?php if($movie->rating->name == 'C18'): ?> bg-danger
                                                            <?php elseif($movie->rating->name == 'C16'): ?> bg-warning
                                                            <?php elseif($movie->rating->name == 'P'): ?> bg-success
                                                            <?php elseif($movie->rating->name == 'P'): ?> bg-primary
                                                            <?php else: ?> bg-info
                                                            <?php endif; ?> me-1">
                                            <?php echo e($movie->rating->name); ?>

                                        </span> - <?php echo e($movie->rating->description); ?>

                                        </strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="ticket" class="fixed-bottom" style="background: #2e292e;">
                <div class="d-flex flex-column">
                    <div class="d-flex text-light p-2">
                        <span class="flex-shrink-0">
                            <i class="fa-solid fa-seat-airline text-uppercase"></i>&numsp;Ghế:
                        </span>
                        <div id="ticket_seats" class="flex-grow-1 justify-content-end d-flex"></div>
                    </div>
                    <div class="d-flex text-light p-2">
                        <span class="flex-shrink-0"><i class="fa-solid fa-popcorn"></i>&numsp;Combo:</span>
                        <div id="ticket_combos" class="flex-grow-1 text-end d-flex flex-column"></div>
                    </div>
                    <div class="d-flex text-light p-2">
                        <span class="flex-shrink-0"><i class="fa-solid fa-equals"></i>&numsp;Tổng số tiền:</span>
                        <div class="flex-grow-1 text-end .ticketTotal"><span id="ticketSeat_totalPrice"></span> đ</div>
                    </div>
                </div>
            </div>

            
            <div class="col-12 col-lg-9" >
                <ul class="nav justify-content-around fw-bold">
                    <li class="nav-item">
                        <a class="nav-link active text-warning "
                           href="#Seats"
                           aria-controls="seat"
                           aria-expanded="true"
                           data-bs-toggle="collapse"
                           data-bs-target="#Seats">Ghế</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" role="button" data-bs-toggle="collapse" href="#Combos" data-bs-target="#Combos">Combo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" data-bs-toggle="collapse" href="#Payment" data-bs-target="#Payment">Thanh toán</a>
                    </li>
                </ul>
                <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="10" aria-valuemin="0"
                     aria-valuemax="30" style="height: 2px">
                    <div class="progress-bar bg-warning" style="width: 100%"></div>
                </div>



                <div id="mainTicket">
                    
                    <div id="Seats" class="collapse show" data-bs-parent="#mainTicket">
                        <h4 class="mt-5">Chọn ghế</h4>
                        <div class="container-fluid py-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-4" >
                                        <div class="card-header pb-0">
                                            <h6><?php echo e($room->name); ?></h6>
                                        </div>
                                        <div class="card-body px-0 pt-0 pb-2">
                                            
                                            <div class="d-flex container my-3 justify-content-center">
                                                <ul class="list-group list-group-horizontal">
                                                    <li class="list-group-item border-0 px-0">
                                                        <strong>Giá tiền:</strong>
                                                    </li>
                                                    <?php $__currentLoopData = $seatTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seatType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list-group-item border-0">
                                                            <div class="d-flex">
                                                                <div class="d-inline-block me-2"
                                                                     style="width: 24px; height: 20px; background-color: <?php echo e($seatType->color); ?>">
                                                                </div>
                                                                <?php echo e(number_format($seatType->surcharge+$price+$room->roomType->surcharge,0,",",".")); ?> đ
                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                                <div class="vr"></div>
                                                <ul class="list-group list-group-horizontal">
                                                    <li class="list-group-item border-0">
                                                        <div class="d-flex">
                                                            <div class="d-inline-block me-2 text-center"
                                                                 style="width: 24px; height: 24px; background-color: #dc3545">
                                                                <i class="fa-solid text-light fa-check"></i>
                                                            </div>
                                                            Đang chọn
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item border-0">
                                                        <div class="d-flex">
                                                            <div class="d-inline-block me-2"
                                                                 style="width: 24px; height: 24px; background-color: #c3c3c3">
                                                            </div>
                                                            Đã bán
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="d-block overflow-x-auto text-center">
                                                <div class="d-inline-block flex-nowrap mt-2 my-auto mb-4 text-center justify-content-center">
                                                    
                                                    Màn hình
                                                    <div class="row bg-dark mx-auto" style="height: 2px; max-width: 540px"></div>
                                                    <div class="row d-block m-2" style="margin: 2px">
                                                        <div class="d-flex flex-nowrap align-middle my-0 mx-1 py-1 px-0 disabled"
                                                             style="width: 30px; height: 30px; line-height: 22px; font-size: 10px">
                                                        </div>
                                                    </div>

                                                    
                                                    <?php $__currentLoopData = $room->rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="row d-flex flex-nowrap" id="Row_<?php echo e($row->row); ?>" style="margin: 2px">
                                                                    <?php $__currentLoopData = $room->seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if($seat->row == $row->row): ?>
                                                                            <!-- Khoảng trống trước ghế -->
                                                                            <?php for($m = 0; $m < $seat->ms; $m++): ?>
                                                                                <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                                    style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                            <?php endfor; ?>

                                                                            <!-- Ghế -->
                                                                            <?php if($seat->status == 1): ?>
                                                                                <div class="seat d-inline-block mx-1 align-middle py-1 px-0 seat_enable"
                                                                                    id="Seat_<?php echo e($seat->id); ?>"
                                                                                    choice="0"
                                                                                    style="background-color: <?php echo e($seat->seatType->color); ?>; cursor: pointer; width: 30px; height: 30px; line-height: 22px; font-size: 10px; margin: 2px 0;"
                                                                                    onclick="seatChoice('<?php echo e($seat->id); ?>', '<?php echo e($seat->row); ?>', '<?php echo e($seat->col); ?>', <?php echo e($seat->seatType->surcharge + $room->roomType->surcharge + $price); ?>)">
                                                                                    <?php echo e($seat->row); ?><?php echo e($seat->col); ?>

                                                                            </div>
                                                                       
                                                                            <?php else: ?>
                                                                                <div class="seat d-inline-block align-middle py-1 px-0 text-dark disabled"
                                                                                    style="background-color: #cccccc; width: 30px; height: 30px; line-height: 22px; font-size: 10px; margin: 2px 0;" choice="1">
                                                                                    X
                                                                                </div>
                                                                            <?php endif; ?>

                                                                            <!-- Khoảng trống sau ghế -->
                                                                            <?php for($n = 0; $n < $seat->me; $n++): ?>
                                                                                <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                                    style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                            <?php endfor; ?>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start w-50 ms-2 mt-4 float-end">
                            <button class="btn btn-warning text-decoration-underline text-center btn_next">
                                Tiếp theo <i class="fa-solid fa-angle-right"></i>
                            </button>
                            <button
                                id="seatChoiceNext"
                                aria-expanded="false"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#Combos"
                                    class="d-none"></button>
                        </div>
                    </div>

                    <?php echo $__env->make('web.combo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('web.payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <form action="/ticketCreate" method="post" id="booking">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="schedule_id" id="schedule_id" value="<?php echo e($schedule->id); ?>">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>">
                        <input type="hidden" name="ticketSeats[]" id="ticketSeats">
                        <input type="hidden" name="ticketCombos[]" id="ticketCombo">
                        <input type="hidden" name="totalPrice" id="totalPrice">
                        <input type="hidden" name="ticketPayment" id="ticketPayment">
                        <input type="hidden" name="discount_id" id="discount_id">
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            $('.collapse').on('show.bs.collapse', function() {
                var target = $(this).attr('id');
                var link = $('a[data-bs-target="#' + target + '"]');
                console.log(link);
                
                $('.nav-link').removeClass('active text-warning').addClass('text-secondary');
                link.addClass('active text-warning').removeClass('text-secondary');
            });

            $('.collapse').on('hidden.bs.collapse', function() {
                var target = $(this).attr('id'); 
                var link = $('a[data-bs-target="#' + target + '"]');
                link.removeClass('active text-warning').addClass('text-secondary');
            });
            $i = 0;
            let $arrSeatHtml = [];
            let $ticket_seats = {};
            let $ticket_combos = {};
            let $ticket_id = -1;
            let $sum = 0;
            let $discount_pice = 0;
            // Ghế
            seatChoice = (seat_id, row, col, price) => {
                var $seatCurrent = $('#Seats').find('#Seat_' + seat_id);
                var choice = parseInt($seatCurrent.attr('choice'));
                var backgroundColor = $seatCurrent.css("background-color");
                
                if (choice === 1) {
                    // Bỏ chọn ghế
                    $i--;
                    $seatCurrent.replaceWith($arrSeatHtml[seat_id]);
                    $(`#ticketSeat_${seat_id}`).remove();
                    $sum -= price;
                    $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                    delete $ticket_seats[seat_id];
                } else {
                    $i++;
                    if ($i > 8) {
                        $i--;
                        alert('Chọn tối đa 8 ghế');
                        return;
                    }

                    $arrSeatHtml[seat_id] = $seatCurrent.clone();
                    
                    
                    $seatCurrent.replaceWith(`<div class="seat d-inline-block mx-1 align-middle py-1 px-0 seat_enable"
                        id="Seat_${seat_id}" choice="1" onclick="seatChoice('${seat_id}','${row}', ${col}, ${price})"
                        style="background-color: #dc3545; cursor: pointer; width: 30px; height: 30px; line-height: 22px; font-size: 10px;
                        margin: 2px 0;"><i class="fa-solid text-light fa-check"></i></div>`);

                    $('#ticket_seats').append(`<p id="ticketSeat_${seat_id}" class="mx-1 text-white">${row}${col} </p>`);
                    $ticket_seats[seat_id] = [seat_id, price];
                    $sum += price;
                    $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                    $("#totalPrice").val($sum);

                    if (backgroundColor === "rgb(255, 98, 176)") {
                        if (col % 2 === 1) {
                            adjacentSeatId = `Seat_${parseInt(seat_id) + 1}`;
                        } else {
                            adjacentSeatId = `Seat_${parseInt(seat_id) - 1}`;
                        }
                        
                        
                        let $adjacentSeat = $('#Seats').find(`#${adjacentSeatId}`);
                        if ($adjacentSeat.length && $adjacentSeat.attr('choice') !== "1") {
                            $adjacentSeat.click();
                        }
                    }
                }

                
            }

        checkSeats = () => {
                $seats = $('#Seats').find('.seat');
                
                for (let i = 0; i < $seats.length; i++) {
                    
                    if ($seats[i].getAttribute('choice') === '1') {
                        let seatLeft1 = (i > 0) ? $seats[i - 1].getAttribute('choice') : '0';
                        let seatRight1 = (i < $seats.length - 1) ? $seats[i + 1].getAttribute('choice') : '0';
                        let seatLeft2 = (i > 1) ? $seats[i - 2].getAttribute('choice') : '0';
                        let seatRight2 = (i < $seats.length - 2) ? $seats[i + 2].getAttribute('choice') : '0';


                        if (seatLeft1 === '1' && seatRight1 === '1') {
                            continue; 
                        } else if (seatRight1 === '0' && seatRight2 === '1') {
                            alert('Không được để ghế trống ghế bên trái hoặc ghế bên phải ghế đã chọn.');
                            return false; 
                        } else if (seatLeft1 === '0' && seatLeft2 === '1') {
                            alert('Không được để ghế trống ghế bên trái hoặc ghế bên phải ghế đã chọn.');
                            return false; 
                        }

                        if (i === 0 && seatRight1 === '0') {
                            alert('Ghế đầu tiên không được để trống bên phải.');
                            return false; 
                        }
                        if (i === $seats.length - 1 && seatLeft1 === '0') {
                            alert('Ghế cuối cùng không được để trống bên trái.');
                            return false; 
                        }
                    }
                }
                return true; 
            }


            $('#Seats').on('click', '.btn_next', (e) => {
                if (!checkSeats()) {
                    return;
                }
                $('#seatChoiceNext').click();
                if ($i !== 0) {
                    var ticketSeatsJSON = JSON.stringify($ticket_seats);
                    $("#ticketSeats").val(ticketSeatsJSON);
                } else {
                    window.location.reload();
                    alert('Bạn chưa chọn ghế!!!');
                }
            })

            comboBack = () => {
                $("#ticketSeats").val('');
            }

            comboNext = () => {
                $check = jQuery.isEmptyObject($ticket_combos);
                if (!$check) {
                    $("#ticketCombo").val(JSON.stringify($ticket_combos));
                    $("#totalPrice").val($sum);
                }

            }
            
            let $iCombo = [];

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

            $("input[name='bankCode']").change(function() {
                var payment = $("input[name='bankCode']:checked").val();
                $("#ticketPayment").val(payment);
            });

            Discount = () => {
                var discount = $("#discount_code").val(); 
                console.log(discount);
                
                $.ajax({
                    url: "/checkDiscount",
                    method: "POST",
                    data: {
                        discount: discount,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    warning: function(response){
                        if (response.warning){
                            alert('Mã đã sữ dụng hôm nay');
                        }
                    },
                    success: function(response) {            
                        if (response.success) {
                            var discount = response.discount;
                            $("#discount_name").val(discount.name);
                            $("#discount_per").val(discount.percent);
                            $discount_price =$sum * (discount.percent / 100);
                            $('#ticketSeat_totalPrice').html(
                                "<span style='text-decoration: line-through;'>" + $sum.toLocaleString('vi-VN') + " </span> " +
                                "<span>" + ($sum - $discount_price).toLocaleString('vi-VN') + " </span>"
                            );
                            $("#totalPrice").val($sum - $discount_price);
                            $("#discount_id").val(discount.id);
                        }
                        else if (response.warning) {
                            alert('Mã đã sữ dụng hôm nay');
                        }
                        else {
                            alert('Mã đã hết hạn');
                        }
                    },
                    fail: function(response) {
                    },
                    
                    error: function() {
                        alert('Đã xảy ra lỗi, vui lòng thử lại sau');
                    }
                });
            };

            // Thanh toán
            paymentNext = () => {
                if($('#ticketSeats').val() === ''){
                    alert('Chưa chọn ghế!!');
                    $('#Seats').collapse('show');
                    return false; 
                }
                $("#booking").submit();
            }

            paymentBack = () => {
                $("#ticketCombo").val();
            }
        });


        <?php $__currentLoopData = $room->seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($seat->status == 1): ?>
                <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($ticket->status == 1): ?>
                        <?php $__currentLoopData = $ticket->ticketSeats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticketSeat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($seat->id == $ticketSeat->seat_id): ?>
                                $('#Seats').find('#Seat_<?php echo e($seat->id); ?>').replaceWith(`<div class="seat d-inline-block mx-1 align-middle py-1 px-0  text-dark disabled" choice="1" style="background-color: #c3c3c3; width: 30px; height: 30px; line-height: 22px; font-size: 10px; margin: 2px 0;">
                                    <?php echo e($seat->row.$seat->col); ?></div>`)
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/ticket.blade.php ENDPATH**/ ?>