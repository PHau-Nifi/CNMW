
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6><?php echo app('translator')->get('lang.ticket'); ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 ">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.movie_name'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.room'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.seat'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Combo</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.time'); ?></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.date'); ?></th>
                                
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Code</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><?php echo app('translator')->get('lang.status'); ?></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Xác nhận</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="align-middle text-center">
                                    <?php if(isset($value['schedule'])): ?>
                                    <h6 class="mb-0 text-sm " style="width:150px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical"><?php echo $value['schedule']['movie']['name']; ?></h6>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if(isset($value['schedule'])): ?>
                                    <h6 class="mb-0 text-sm "><?php echo $value['schedule']['room']['roomType']['name']; ?></h6>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if(isset($value['schedule'])): ?>
                                    <h6 class="mb-0 text-sm "><?php echo $value['schedule']['room']['name']; ?></h6>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if(isset($value['ticketSeats'])): ?>
                                    <span class="text-secondary font-weight-bold" style="width:150px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical">
                                        <?php $__currentLoopData = $value['ticketSeats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($loop->first): ?>
                                        <?php echo $seat->seat->row."-".$seat->seat->col; ?>

                                            <?php else: ?>
                                                , <?php echo $seat->seat->row."-".$seat->seat->col; ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(isset($value->ticketCombos) || isset($value->ticketFoods)): ?>
                                        <span class="text-secondary font-weight-bold" >
                                            <?php $__currentLoopData = $value['ticketCombos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tkcombo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    • <?php echo e($tkcombo->combo->name.' x '. $tkcombo->quantity); ?> <br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>

                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if(isset($value['schedule'])): ?>
                                    <span class="text-secondary font-weight-bold"><?php echo $value['schedule']['startTime']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?php if(isset($value['schedule'])): ?>
                                    <span class="text-secondary font-weight-bold"><?php echo date("d-m-Y", strtotime($value['schedule']['date'])); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center">
                                    <button href="#barcode" class="btn btn-link text-danger "
                                            data-bs-toggle="modal"
                                            data-bs-target="#barcode<?php echo $value['id']; ?>"><i style="color:grey" class="fa-sharp fa-regular fa-eye"></i>
                                    </button>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?php if($value['status'] == 1): ?>
                                        <?php if( $value['hasPaid'] == 1): ?>
                                            <span class="badge badge-sm bg-gradient-secondary">Đã thanh toán</span>
                                        <?php else: ?>
                                            <span class="badge badge-sm bg-gradient-success">Chờ</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge badge-sm bg-gradient-warning">Đã hoàn tiền</span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?php if($value['status'] == 1): ?>
                                        <?php if($value['schedule_id'] != NULL): ?>
                                            <?php if( $value['hadScan'] == 1): ?>
                                                <span class="badge badge-sm bg-gradient-success">Đã xác nhận</span>
                                            <?php elseif($value['hadScan'] == 0): ?>
                                                <span class="badge badge-sm bg-gradient-secondary">Chờ</span>
                                            <?php else: ?>
                                                <span class="badge badge-sm bg-gradient-danger">Quá hạn</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <div class="modal fade modal-md" id="barcode<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="barcode_title" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="barcode_title"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row ">
                                                    <div class="col-md-12">
                                                            <div class="flex-column d-flex justify-content-center text-center">
                                                                <div>
                                                                    <?php
                                                                        $base64 = new SimpleSoftwareIO\QrCode\Facades\QrCode();
                                                                        $base64 = QrCode::size(128)->generate($value->code);
                                                                    ?>
                                                                    <div class="text-center">
                                                                        <?php echo e($base64); ?>

                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <?php echo $value['code']; ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <?php echo $ticket->links(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Tickets/index.blade.php ENDPATH**/ ?>