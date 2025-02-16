
<?php $__env->startSection('content'); ?>
<?php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
?>
<section class="container clearfix">
    <div class="container">
        <h1 class="mb-5"></h1>
        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
                <div class="p-5">
                    <h4 class="text-center"><?php echo $user['fullname']; ?></h4>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-tab" href="#account" data-bs-toggle="collapse" data-bs-target="#account" aria-expanded="true" aria-controls="account">
                        <i class="fa fa-home text-center mr-1"></i>
                        Tài khoản
                    </a>
                    <a class="nav-link" id="password-tab" href="#password" data-bs-toggle="collapse" data-bs-target="#password" aria-expanded="false" aria-controls="password">
                        <i class="fa fa-key text-center mr-1"></i>
                        Đổi mật khẩu
                    </a>
                    <a class="nav-link" id="notification-tab" href="#notification" data-bs-toggle="collapse" data-bs-target="#notification" aria-expanded="false">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        Vé của tôi
                    </a>
                </div>
            </div>
            <div class="tab-content w-100 p-4 p-md-5">
                <div id="mainContent">
                    <!-- Form cập nhật tài khoản -->
                    <form action="/editProfile" method="POST" class="collapse show" id="account" data-bs-parent="#mainContent">
                        <?php echo csrf_field(); ?>
                        <h4 class="text-center">Mã thành viên</h4>
                        <div class="text-center mt-3">
                            <img src="data:image/png;base64,<?php echo base64_encode($generatorPNG->getBarcode($user['code'],$generatorPNG::TYPE_CODE_128)); ?>" />
                        </div>
                        <div class="text-center mt-3"><?php echo $user['code']; ?></div>
                        
                        <!-- Hiển thị điểm và hạng khách hàng -->
                        <div class="mt-3 text-center">
                            <p><strong>Điểm tích lũy:</strong> <?php echo $user['point']; ?></p>
                            <p><strong>Hạng khách hàng:</strong> <?php echo $user->level->name; ?></p>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#discountModal">Xem Mã Giảm Giá</button>
                        </div>

                        <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="discountModalLabel">Mã Giảm Giá</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                           
                                        </ul>

                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Phần trăm (%)</th>
                                                <th scope="col">Code</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $user->level->discount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="row"><?php echo e($i+1); ?></th>
                                                    <td><?php echo e($discount->name); ?></td>
                                                    <td><?php echo e($discount->percent); ?>%</td>
                                                    <td><?php echo e($discount->code); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                          </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="fullname" required value="<?php echo $user['fullname']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                            </div>
                        </div>
                    </form>

                    <!-- Form đổi mật khẩu -->
                    <form action="/changePassword" method="POST" class="collapse" id="password" data-bs-parent="#mainContent">
                        <?php echo csrf_field(); ?>
                        <h3 class="mb-4 text-center">Đổi Mật Khẩu</h3>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Mật khẩu cũ</label>
                                <input type="password" name="oldpassword" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Mật khẩu mới</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nhập lại mật khẩu mới</label>
                                <input type="password" name="repassword" class="form-control" required>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Cập nhật</button>
                        </div>
                    </form>

                    <!-- Danh sách vé của tôi -->
                    <div class="collapse" id="notification" data-bs-parent="#mainContent">
                        <h3 class="mb-4 text-center">Vé của tôi</h3>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9">
                                    <?php $__currentLoopData = $sort_ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($value['schedule']['movie']['image'])): ?>
                                            <div class="row mb-3">
                                                <p class="col-12">Code: <?php echo $value['code']; ?></p>
                                                <div class="col-3">
                                                    <img class="img-fluid" 
                                                    <?php if(strstr($value->image,"https") === false): ?>
                                                    src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($value['schedule']['movie']['image']); ?>.jpg"
                                                    <?php else: ?>
                                                        src="<?php echo e($value['schedule']['movie']['image']); ?>"
                                                    <?php endif; ?>  alt="<?php echo $value['schedule']['movie']['name']; ?>">
                                                </div>
                                                <div class="col-md-7">
                                                    <p><?php echo $value['schedule']['movie']['name']; ?></p>
                                                    <p class="badge <?php if($value['schedule']['movie']['rating']['name'] == 'C18'): ?> bg-danger <?php elseif($value['schedule']['movie']['rating']['name'] == 'C16'): ?> bg-warning <?php elseif($value['schedule']['movie']['rating']['name'] == 'P'): ?> bg-success <?php elseif($value['schedule']['movie']['rating']['name'] == 'K'): ?> bg-primary <?php else: ?> bg-info <?php endif; ?>">
                                                        <?php echo $value['schedule']['movie']['rating']['name']; ?>

                                                    </p>
                                                    <p><?php echo date("d/m/Y", strtotime($value['schedule']['date'])); ?></p>
                                                    <p>Phòng <?php echo date("H:i A", strtotime($value['schedule']['startTime'])); ?> ~ Đến <?php echo date("H:i A", strtotime($value['schedule']['endTime'])); ?></p>
                                                    <p>
                                                        <?php echo $value['schedule']['room']['theater']['name']; ?>: <?php echo $value['schedule']['room']['name']; ?>

                                                        (<?php $__currentLoopData = $value['ticketSeats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($loop->first ? $seat->seat->row.$seat->seat->col : ', '.$seat->seat->row.$seat->seat->col); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>)
                                                    </p>
                                                    <p>Giá tiền: <?php echo number_format($value['totalPrice'], 0, ",", "."); ?></p>
                                                    <a href="/ticketPaid/<?php echo e($value->id); ?>" class="btn btn-warning"><i class="fa-solid fa-ticket"></i></a>
                                                    <button data-bs-target="#profileModal<?php echo $value['id']; ?>" data-bs-toggle="modal" class="btn btn-warning"><?php echo app('translator')->get('lang.detail'); ?></button>
        
                                                    <!-- Modal Chi tiết vé -->
                                                    <div class="modal fade" id="profileModal<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center" id="profileModalLabel"><?php echo app('translator')->get('lang.ticket_code'); ?> : <?php echo $value['code']; ?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="text-center">#<?php echo $value['code']; ?></div>
                                                                        <p><?php echo app('translator')->get('lang.purchase_date'); ?> : <?php echo date("d/m/Y", strtotime($value['created_at'])); ?></p>
                                                                        <span><?php echo app('translator')->get('lang.payment_methods'); ?>: <?php echo e($value->payment); ?> </span>
                                                                        <div class="d-flex justify-content-end">
                                                                            <button data-bs-target="#billModal<?php echo $value['id']; ?>" data-bs-toggle="modal" class="btn btn-danger m-2"><?php echo app('translator')->get('lang.print_bill'); ?></button>
                                                                        </div>
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Tên phim</th>
                                                                                    <th>Thời gian</th>
                                                                                    <th>Ghế</th>
                                                                                    <th>Giá tiền</th>
                                                                                    <th>Trạng thái</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><?php echo $value['schedule']['movie']['name']; ?></td>
                                                                                    <td><?php echo date("d/m/Y", strtotime($value['schedule']['date'])); ?> <?php echo date("H:i A", strtotime($value['schedule']['startTime'])); ?> - <?php echo date("H:i A", strtotime($value['schedule']['endTime'])); ?></td>
                                                                                    <td>
                                                                                        <?php $__currentLoopData = $value['ticketSeats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php echo e($loop->first ? $seat->seat->row.$seat->seat->col : ', '.$seat->seat->row.$seat->seat->col); ?>

                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </td>
                                                                                    <td><?php echo number_format($value['totalPrice'], 0, ",", "."); ?></td>
                                                                                    <td>
                                                                                        <?php if($value->status): ?>
                                                                                            Đã xác nhận
                                                                                        <?php elseif($value->status == 0): ?>
                                                                                            Đã hủy
                                                                                        <?php else: ?>
                                                                                            Chờ
                                                                                        <?php endif; ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <div>
                                                                            <a href="#refundTicket" data-toggle="tooltip" data-bs-target="#refundTicket<?php echo $value['id']; ?>" data-bs-toggle="modal" class="text-uppercase text-center link link-dark text-decoration-none text-xl text-dark "><?php echo app('translator')->get('lang.refund_ticket'); ?></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php echo $__env->make('web.bill_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php echo $__env->make('web.refund_ticket_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo e($sort_ticket->links()); ?>

                                </div>
                                <div class="col-md-3">
                                    <div class="card border border-dark shadow-0 mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Chi tiêu</div>
                                        <div class="card-body">
                                          <p class="card-text">Số vé: <?php echo e(count($tickets)); ?></p>
                                          <p class="card-text">Tổng tiền: <?php echo e(number_format($sum, 0, ",", ".")); ?> VND</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.refund-ticket').on('click', function() {
            var ticket_id = $(this).data("id");
            if (confirm("Bạn có chắc chắn muốn hoàn vé ?") === true) {
                $.ajax({
                    url: '/refund-ticket',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'ticket_id': ticket_id,
                    },
                    success: function(data) {
                        if (data['success']) {
                            alert(data.success);
                            window.location.reload();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/profile.blade.php ENDPATH**/ ?>