<div class="modal fade  modal-lg" id="billModal<?php echo $value['id']; ?>" tabindex="-1" aria-labelledby="billModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="photo">
                <div class="card-body mx-4">

                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li class="text-black mt-1">
                                    <h5><?php echo app('translator')->get('lang.ticket_code'); ?>: <?php echo $value['code']; ?></h5>
                                </li>
                                <li class="text-black mt-1"><?php echo app('translator')->get('lang.purchase_date'); ?>: <?php echo date("d/m/Y",strtotime($value['created_at'])); ?></li>
                                <li class="text-black"><?php echo app('translator')->get('lang.customer'); ?>: <?php echo $user['fullName']; ?></li>
                                <li class="text-muted mt-1"><span class="text-black"><?php echo app('translator')->get('lang.phone'); ?>: </span><?php echo $user['phone']; ?></li>
                                <li class="text-muted mt-1"><span class="text-black"><?php echo app('translator')->get('lang.payment_methods'); ?>: </span><?php echo $value['payment']; ?></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <img style="width: 150px;float: right;" src="images/web/favicon.png" />
                        </div>
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-xxs"><?php echo app('translator')->get('lang.movie_name'); ?></th>
                                    <th class="text-center text-uppercase text-xxs"><?php echo app('translator')->get('lang.showtime_web'); ?></th>
                                    <th class="text-center text-uppercase text-xxs"><?php echo app('translator')->get('lang.ticket'); ?></th>
                                    <th class="text-center text-uppercase text-xxs"><?php echo app('translator')->get('lang.total_price'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle text-center">
                                        <?php echo $value['schedule']['movie']['name']; ?>

                                    </td>
                                    <td class="align-middle text-center">
                                        <strong><?php echo $value['schedule']['room']['theater']['name']; ?></strong>
                                        <p><?php echo $value['schedule']['room']['name']; ?></p>
                                        <p><?php echo app('translator')->get('lang.seat'); ?>: <?php $__currentLoopData = $value['ticketSeats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($loop->first): ?>
                                            <?php echo e($seat->seat->row.$seat->seat->col); ?>

                                            <?php else: ?>
                                            ,<?php echo e($seat->seat->row.$seat->seat->col); ?>

                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                        <p><?php echo date("d/m/Y",strtotime($value['schedule']['date'] )); ?></p>
                                        <p><?php echo app('translator')->get('lang.from'); ?> <?php echo date("H:i A",strtotime($value['schedule']['startTime'] )); ?> ~ <?php echo app('translator')->get('lang.to'); ?> <?php echo date("H:i A",strtotime($value['schedule']['endTime'] )); ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p> <?php echo $value['schedule']['room']['roomType']['name']; ?></p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p><?php echo number_format($value['totalPrice'],0,",","."); ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button id="download" type="submit" class="btn btn-danger"><?php echo app('translator')->get('lang.print'); ?></button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/bill_modal.blade.php ENDPATH**/ ?>