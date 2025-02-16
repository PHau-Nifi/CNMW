
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Thông tin phòng</h6>
                </div>
                <div class="card-body">
                    <form action="admin/room/edit/<?php echo e($room->id); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Tên phòng</label>
                                    <input id="name" type="text" name="name" class="form-control"
                                           placeholder="Name..." value="<?php echo e($room->name); ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="type">Loại phòng</label>
                                    <select class="form-control" name="type" id="type">
                                        <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>"
                                                <?php if($room->roomType_id == $type->id): ?> selected <?php endif; ?>>
                                                <?php echo e($type->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-2" <?php if($room->seats->count() > 300): ?> style="width: 1500px" <?php endif; ?>>
                <div class="card-header pb-0">
                    <h6><?php echo e($room->name); ?></h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="d-block overflow-x-auto text-center">
                        <div class="w-100 mt-2 my-auto mb-4 text-center justify-content-center">
                            MÀN HÌNH
                            <div class="row bg-dark w-100 mx-auto" style="height: 2px; max-width: 540px"></div>

                            <div class="row d-block m-2" style="margin: 2px">
                                <div class="d-inline-block align-middle my-0 mx-1 py-1 px-0 disabled"
                                     style="width: 30px; height: 30px; line-height: 22px; font-size: 10px">
                                </div>
                            </div>
                            <?php $__currentLoopData = $room->rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row d-block" id="Row_<?php echo e($row->row); ?>" style="margin: 2px">
                                    <?php $__currentLoopData = $room->seats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($seat->row == $row->row): ?>
                                        <?php for($m = 0; $m < $seat->ms; $m++): ?>
                                            <div class="d-inline-block align-middle disabled seat_empty" style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                        <?php endfor; ?>
                                            <div class="d-inline-block cursor-pointer align-middle py-1 px-0 seat_enable"
                                                 id="Seat_<?php echo e($seat->row.$seat->col); ?>"
                                                 style="
                                                 <?php if($seat['status'] == 1): ?>
                                        background-color: <?php echo e($seat->seatType->color); ?>;
                                        <?php else: ?>
                                         background-color: #999;
                                        <?php endif; ?>
                                        width: 30px;
                                        height: 30px;
                                        line-height: 22px;
                                        font-size: 10px;
                                        margin: 2px 0;
                                     "
                                                 data-bs-toggle="offcanvas" data-bs-target="#EditSeat_<?php echo e($seat->id); ?>">
                                                <?php echo e($seat->row.$seat->col); ?>

                                            </div>
                                            <?php for($n = 0; $n < $seat->me; $n++): ?>
                                                <div class="d-inline-block align-middle disabled seat_empty"
                                                style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                            <?php endfor; ?>

                                            <div class="offcanvas offcanvas-start" tabindex="-1" id="EditSeat_<?php echo e($seat->id); ?>"
                                                aria-labelledby="EditSeatRowLabel">
                                               <div class="offcanvas-header">
                                                   <h5 class="offcanvas-title" id="EditSeatRowLabel">EDIT <?php echo e($seat->row.$seat->col); ?></h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                           aria-label="Close"></button>
                                               </div>
                                               <div class="offcanvas-body">
                                                   <form action="admin/seat/edit" method="post">
                                                       <?php echo csrf_field(); ?>
                                                       <?php $__currentLoopData = $seatTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seatType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                           <div class="form-check">
                                                               <input class="form-check-input seat_type_radio" type="radio" name="seatType"
                                                                      id="ColorRadio_<?php echo e($seatType->id); ?>_<?php echo e($seat->id); ?>" value="<?php echo e($seatType->id); ?>"
                                                                      <?php if($seat->seatType_id==$seatType->id): ?>
                                                                          checked
                                                                      <?php endif; ?>
                                                               >
                                                               <label class="form-check-label flex-fill d-flex border-0 ps-1 my-2"
                                                                      for="ColorRadio_<?php echo e($seatType->id); ?>_<?php echo e($seat->id); ?>">
                                                               <span class="fw-bold d-block text-center me-1"
                                                                     style="width: 20px; height: 20px; background-color: <?php echo e($seatType->color); ?>;"></span>
                                                                   <span style="line-height: 20px"><?php echo e($seatType->name); ?> - <?php echo e($seatType->surcharge); ?></span>
                                           
                                                               </label>
                                           
                                                           </div>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       <label class="text-sm">
                                                               <?php if($seat['status'] ==1): ?>
                                                                   <a href="admin/seat/on/<?php echo $seat['id']; ?>,<?php echo $room['id']; ?>">
                                                                       <span class="badge badge-sm bg-gradient-success">Online</span>
                                                                   </a>
                                                               <?php else: ?>
                                                               <a href="admin/seat/off/<?php echo $seat['id']; ?>,<?php echo $room['id']; ?>">
                                                                           <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                                   </a>
                                                               <?php endif; ?>
                                                       </label>
                                                       <div class="form-group">
                                                            <label for="seat_ms_<?php echo e($seat->id); ?>"><?php echo app('translator')->get('lang.left_align'); ?></label>
                                                            <input class="form-control" type="number" name="ms" id="seat_ms_<?php echo e($seat->id); ?>" value="<?php echo e($seat->ms); ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seat_me_<?php echo e($seat->id); ?>"><?php echo app('translator')->get('lang.right_align'); ?></label>
                                                            <input class="form-control" type="number" name="me" id="seat_me_<?php echo e($seat->id); ?>" value="<?php echo e($seat->me); ?>">
                                                        </div>
                                                       <input type="hidden" name="room" value="<?php echo e($room->id); ?>">
                                                       <input type="hidden" name="seat" value="<?php echo e($seat->id); ?>">
                                                       <a href="admin/seat/delete/<?php echo e($seat->id); ?>?room=<?php echo e($room->id); ?>" class="btn btn-primary mt-4">
                                                           <i class="fa-solid fa-trash-can fa-lg"></i> Xóa
                                                       </a>
                                                       <button type="submit" class="btn btn-primary mt-4"
                                                               data-bs-dismiss="offcanvas">
                                                           Xác nhận
                                                       </button>
                                                   </form>
                                               </div>
                                           </div>
                                                                                      
                                        <?php endif; ?>
                                        <?php if($loop->last): ?>
                                            <div class="d-inline-block border cursor-pointer align-middle py-1 px-0"
                                                 style=" width: 30px; height: 30px; margin: 2px -30px 2px 0;"
                                                 data-bs-toggle="offcanvas" data-bs-target="#EditRow_<?php echo e($room->id); ?>_<?php echo e($row->row); ?>">
                                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                            </div>
                                            
                                            <div class="offcanvas offcanvas-start" tabindex="-1" id="EditRow_<?php echo e($room->id); ?>_<?php echo e($row->row); ?>"
                                                aria-labelledby="EditSeatRowLabel">
                                               <div class="offcanvas-header">
                                                   <h5 class="offcanvas-title" id="EditSeatRowLabel">EDIT Hàng</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                           aria-label="Close"></button>
                                               </div>
                                               <div class="offcanvas-body">
                                                   <form action="admin/seat/row" method="post">
                                                       <?php echo csrf_field(); ?>
                                                       <?php $__currentLoopData = $seatTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seatType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                           <div class="form-check">
                                                               <input class="form-check-input seat_type_radio" type="radio" name="seatType"
                                                                      id="ColorRadio_<?php echo e($seatType->id); ?>_<?php echo e($room->id); ?>_<?php echo e($row->row); ?>" value="<?php echo e($seatType->id); ?>">
                                                               <label class="custom-control-label flex-fill d-flex border-0 ps-1 my-2"
                                                                      for="ColorRadio_<?php echo e($seatType->id); ?>_<?php echo e($room->id); ?>_<?php echo e($row->row); ?>">
                                                               <span class="fw-bold d-block text-center me-1 seat_color_<?php echo e($seatType->id); ?>"
                                                                     style="width: 20px; height: 20px; background-color: <?php echo e($seatType->color); ?>;"></span>
                                                                   <span style="line-height: 20px"><?php echo e($seatType->name); ?> - <?php echo e($seatType->surcharge); ?></span>
                                                               </label>
                                                           </div>
                                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       <div class="form-group">
                                                            <label for="row_mb_<?php echo e($room->id); ?>_<?php echo e($row->row); ?>"><?php echo app('translator')->get('lang.below_align'); ?></label>
                                                            <input class="form-control" type="number" name="mb" id="row_mb_<?php echo e($room->id); ?>_<?php echo e($row->row); ?>" value="0">
                                                        </div>
                                                       <input type="hidden" name="room" value="<?php echo e($room->id); ?>">
                                                       <input type="hidden" name="row" value="<?php echo e($row->row); ?>">
                                                       <button type="submit" class="btn btn-primary" data-bs-dismiss="offcanvas">
                                                           Xác nhận
                                                       </button>
                                                   </form>
                                               </div>
                                           </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php for($m = 0; $m < $row->mb; $m++): ?>
                                                <div class="row d-block" style="margin: 2px">
                                                    <div class="d-inline-block align-middle disabled seat_empty"
                                                         style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                                </div>
                                    <?php endfor; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Seats/index.blade.php ENDPATH**/ ?>