
<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6><?php echo app('translator')->get('lang.manage_ticket_price'); ?></h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 mt-5">
                        <div class="table-responsive ">
                            <form action="admin/prices/edit" method="post">
                                <?php echo csrf_field(); ?>
                                <table class="table table-bordered align-items-center text-center">
                                    <thead class="table-primary">
                                    <tr>
                                        <th class="text-uppercase font-weight-bolder"></th>
                                        <th class="text-uppercase font-weight-bolder"></th>
                                        <th class="text-uppercase font-weight-bolder"><?php echo app('translator')->get('lang.student'); ?></th>
                                        <th class="text-uppercase font-weight-bolder"><?php echo app('translator')->get('lang.adult'); ?></th>
                                        <th class="text-uppercase font-weight-bolder"><?php echo app('translator')->get('lang.old_child'); ?></th>
                                        <th class="text-uppercase font-weight-bolder"><?php echo app('translator')->get('lang.member_online'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-light">
                                    <tr>
                                        <th rowspan="2">
                                            <?php echo app('translator')->get('lang.monday'); ?> <?php echo app('translator')->get('lang.to'); ?>  <?php echo app('translator')->get('lang.thursday'); ?>
                                        </th>
                                        <td><?php echo app('translator')->get('lang.before'); ?> 18h</td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="hssv2345s" value="<?php echo e($hssv2345s); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nl2345s" value="<?php echo e($nl2345s); ?>" aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nctte2345s" value="<?php echo e($nctte2345s); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="vtt2345s" value="<?php echo e($vtt2345s); ?>" aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo app('translator')->get('lang.after'); ?> 18h</td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="hssv2345t" value="<?php echo e($hssv2345t); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nl2345t" value="<?php echo e($nl2345t); ?>" aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nctte2345t" value="<?php echo e($nctte2345t); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="vtt2345t" value="<?php echo e($vtt2345t); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">
                                           <?php echo app('translator')->get('lang.friday'); ?> <?php echo app('translator')->get('lang.to'); ?> <?php echo app('translator')->get('lang.sunday'); ?>
                                        </th>
                                        <td><?php echo app('translator')->get('lang.before'); ?> 18h</td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="hssv67cns" value="<?php echo e($hssv67cns); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nl67cns" value="<?php echo e($nl67cns); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nctte67cns" value="<?php echo e($nctte67cns); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="vtt67cns" value="<?php echo e($vtt67cns); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo app('translator')->get('lang.after'); ?> 18h</td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="hssv67cnt" value="<?php echo e($hssv67cnt); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nl67cnt" value="<?php echo e($nl67cnt); ?>" aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="nctte67cnt" value="<?php echo e($nctte67cnt); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group text-right">
                                                <input type="number" class="form-control" name="vtt67cnt" value="<?php echo e($vtt67cnt); ?>"
                                                       aria-label="">
                                                <span class="input-group-text">VND</span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <thead class="table-primary">
                                    <tr>
                                        <th class="text-uppercase font-weight-bolder" colspan="6">
                                            Phụ thu
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-light">
                                    <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-end">
                                                <?php echo e($roomType->name); ?>

                                            </td>
                                            <td colspan="5">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="<?php echo e($roomType->name); ?>"
                                                           value="<?php echo e($roomType->surcharge); ?>"
                                                           aria-label="">
                                                    <span class="input-group-text">VND</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $seatTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seatType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-end">
                                                Ghế <?php echo e($seatType->name); ?>

                                            </td>
                                            <td colspan="5">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="<?php echo e($seatType->name); ?>"
                                                           value="<?php echo e($seatType->surcharge); ?>"
                                                           aria-label="">
                                                    <span class="input-group-text">VND</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>

                                    <tr>
                                        <td colspan="6">
                                            <button type="submit" class="btn btn-primary float-end m-2">Lưu</button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Price/index.blade.php ENDPATH**/ ?>