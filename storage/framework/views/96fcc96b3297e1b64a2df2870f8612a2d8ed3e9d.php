
<?php $__env->startSection('content'); ?>
    
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
               <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#barcodeModal" id="openBarcodeModal">QUÉT VÉ
            </button>
            </div>
            <div class="card-body pt-2">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>Rạp chiếu</td>
                        <td id="theater">
                            <?php if(session()->has('ticket')): ?>
                                <?php echo e(session('ticket')->schedule->room->theater->name); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phòng</td>
                        <td id="room">
                            <?php if(session()->has('ticket')): ?>
                                <?php echo e(session('ticket')->schedule->room->name); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Chổ ngồi</td>
                        <td id="seats">
                            <?php if(session()->has('ticket')): ?>
                                <?php $__currentLoopData = session('ticket')->ticketSeats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->first): ?>
                                        <?php echo e($seat->seat->row.$seat->seat->col); ?>

                                    <?php else: ?>
                                        ,<?php echo e($seat->seat->row.$seat->seat->col); ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Combo</td>
                        <td id="combos">
                            <?php if(session()->has('ticket')): ?>
                                <?php $__currentLoopData = session('ticket')->ticketCombos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->first): ?>
                                        <?php echo e($combo->combo->name); ?> x <?php echo e($combo->quantity); ?> 
                                    <?php else: ?>
                                        ,<?php echo e($combo->combo->name); ?> x <?php echo e($combo->quantity); ?>

                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phim</td>
                        <td id="movie">
                            <?php if(session()->has('ticket')): ?>
                                <?php echo e(session('ticket')->schedule->movie->name); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Thời gian</td>
                        <td><span id="date">
                            <?php if(session()->has('ticket')): ?>
                                <?php echo date('d/m/y', strtotime(session('ticket')->schedule->date)); ?>

                            <?php endif; ?>    
                        </span > | <span id="startTime">
                            <?php if(session()->has('ticket')): ?>
                                <?php echo date('H:i A', strtotime(session('ticket')->schedule->startTime)); ?>

                            <?php endif; ?>
                        </span></td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td id="status">
                            <?php if(session()->has('ticket')): ?>
                                <?php echo e(session('ticket')->status); ?>

                            <?php endif; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <form action="admin/staff/confirmTicket" method="post">
                        <?php echo csrf_field(); ?>
                        <label for="ticket_id" class="form-control-label">Mã vé</label>
                        <input id="ticket_id" class="form-control" name="code" type="number" 
                        <?php if(session()->has('ticket')): ?>
                            value="<?php echo e(session('ticket')->code); ?>"
                        <?php else: ?>
                            value=""
                        <?php endif; ?> readonly>
                        <button type="submit" class="btn btn-primary mt-3">Xác nhận</button>
                    </form>
                </div>
                <form action="admin/staff/checkTicket" method="post" id="checkTicket">
                    <?php echo csrf_field(); ?>
                    <input id="userCode" class="form-control" name="code" type="hidden" value="">
                </form>
                <style>
                    canvas.drawingBuffer{
                        display: none;
                    }
                </style>
                <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="barcodeModalLabel">Quét Mã Vạch</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <video id="preview"></video>
                                <div class="mt-3">
                                    <label for="imageInput" class="form-label">Chọn Hình Ảnh</label>
                                    <input type="file" class="form-control" id="imageInput">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsqr"></script>
<script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    // Xử lý khi quét được mã QR
    scanner.addListener('scan', function (content) {
        console.log('Mã QR đã được quét: ' + content);
        // Ở đây bạn có thể thực hiện các hành động khác sau khi quét được mã QR
        $('#userCode').val(content);
        $("#checkTicket").submit();
    });

    // Xử lý khi không tìm thấy camera
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]); // Bắt đầu quét từ camera đầu tiên
        } else {
            console.error('Không tìm thấy camera trên thiết bị!');
            alert('Không tìm thấy camera trên thiết bị!');
        }
    }).catch(function (e) {
        console.error(e);
        alert('Lỗi khi truy cập camera: ' + e);
    });

    // Xử lý khi chọn hình ảnh từ file input
    document.getElementById('imageInput').addEventListener('change', function (e) {
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onload = function (event) {
            let img = new Image();
            img.src = event.target.result;
            img.onload = function () {
                let canvas = document.createElement('canvas');
                let context = canvas.getContext('2d');
                canvas.width = img.width;
                canvas.height = img.height;
                context.drawImage(img, 0, 0, img.width, img.height);
                let imageData = context.getImageData(0, 0, img.width, img.height);
                let code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });
                if (code) {
                    console.log(code.data);
                    $('#userCode').val(code.data);
                    $("#checkTicket").submit();
                } else {
                    console.error('Không tìm thấy mã QR trong hình ảnh!');
                }
            };
        };
        reader.readAsDataURL(file);
    });

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
    <?php if(session('warning')): ?>
        Swal.fire({
            title: '<?php echo e(session('warning')); ?>',
            icon: 'warning',
            confirmButtonText: 'Ok'
        })
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/scanTicket/index.blade.php ENDPATH**/ ?>