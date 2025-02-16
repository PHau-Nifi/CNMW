
<?php $__env->startSection('content'); ?>
<section class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Doanh thu trong ngày</p>
                                <h5 class="font-weight-bolder">
                                    <?php echo number_format($sum_today,0,",","."); ?> Vnđ
                                </h5>
                                <p class="mb-0">
                                    <span class="text-info text-sm font-weight-bolder"><?php echo date("d-m-Y",strtotime($now)); ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Khách hàng</p>
                                <h5 class="font-weight-bolder">
                                    <?php echo count($user); ?>

                                </h5>
                                <p class="mb-0">
                                     <span class="text-success text-sm font-weight-bolder"><?php echo date("d-m-Y",strtotime($now)); ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Số vé bán ra</p>
                                <h5 class="font-weight-bolder">
                                    <?php echo $ticket_seat; ?>

                                </h5>
                                <span class="text-danger text-sm font-weight-bolder"><?php echo date("d-m-Y",strtotime($year)); ?>

                                        | <?php echo date("d-m-Y",strtotime($now)); ?></span>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng doanh thu</p>
                                <h5 class="font-weight-bolder">
                                    <?php echo number_format($sum,0,",","."); ?> Vnđ
                                </h5>
                                <p class="mb-0">
                                    <span class="text-warning text-sm font-weight-bolder"><?php echo date("d-m-Y",strtotime($year)); ?>

                                        | <?php echo date("d-m-Y",strtotime($now)); ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Thông kê</h6>
                </div>
                <div class="card-body ms-8">
                    <div class="row">
                            <div class="col-md-5">
                                <label for="start_time" class="form-control-label">Từ</label>
                                <div class="form-group" style="text-align:center">
                                    <input name="start_time"  id="start_time" class="form-control datepicker" placeholder="Please select date" type="text">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="end_time"  class="form-control-label">Đến</label>
                                <div class="form-group" style="text-align:center">
                                    <input name="end_time" id="end_time" value="<?php echo date("Y-m-d"); ?>" class="form-control datepicker" placeholder="Please select date" type="text" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button  id="btn-statistical-filter" class="form-control">Xác nhận</button>
                                </div>
                            </div>
    
                        <div class="col-md-5">
                            <label for="statistical" class="form-control-label">Theo thời gian</label>
                            <div class="form-group" style="text-align:center">
                                <select id="statistical" style="width: 50%" class="statistical-filter form-control">
                                    <option value="null" selected>Chọn</option>
                                    <option value="week" >Tuần</option>
                                    <option value="this_month">Tháng</option>
                                    <option value="year">Năm</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="theater" class="form-control-label">Rạp</label>
                            <div class="form-group" style="text-align:center">
                                <select id="theater" style="width: 50%" class="statistical-sortby form-control">
                                    <option value="null" selected>Chọn</option>
                                    <option value="ticket">Lọc theo vé</option>
                                    <option value="theater">Lọc theo rạp</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 ">
        <div id="admin_chart" style="height: 300px; width: 100%" ></div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between ">
                        <h6 class="mb-2">
                            Doanh thu theo phim
                        </h6>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#movie" class="float-end">Xem tất cả</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                            <?php $__currentLoopData = $movies->where('status', 1)->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Tên phim</p>
                                            <h6 class="text-sm mb-0">
                                                <?php echo e($movie['name']); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Số vé bán</p>
                                        <h6 class="text-sm mb-0">
                                            <?php echo e($movie['ticketseats']); ?>

                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Tổng tiền</p>
                                        <h6 class="text-sm mb-0">
                                            <?php echo e(number_format($movie['totalPrice'],0,",",".")); ?> đ
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Doanh thu theo rạp</h6>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#theater_modal" class="float-end">Xem tất cả</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                            <?php $__currentLoopData = $theaters->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Rạp</p>
                                            <h6 class="text-sm mb-0"><?php echo $theater['name']; ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Số vé bán</p>
                                        <h6 class="text-sm mb-0">
                                            <?php echo e($theater['ticketseats']); ?>

                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Tổng tiền</p>
                                        <h6 class="text-sm mb-0">
                                            <?php echo e(number_format($theater['totalPrice'],0,",",".")); ?> đ
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="movie" tabindex="-1" aria-labelledby="movie_title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movie_title">
                        Doanh thu theo phim
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table align-items-center ">
                                    <tbody id="tbody_movie">
                                        <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <p class="text-xs font-weight-bold mb-0">Tên phim</p>
                                                        <h6 class="text-sm mb-0">
                                                            <?php echo e($movie['name']); ?>

                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Số vé bán</p>
                                                    <h6 class="text-sm mb-0">
                                                        <?php echo e($movie['ticketseats']); ?>

                                                    </h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Tổng tiền</p>
                                                    <h6 class="text-sm mb-0">
                                                        <?php echo e(number_format($movie['totalPrice'],0,",",".")); ?> đ
                                                    </h6>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="theater_modal" tabindex="-1" aria-labelledby="theater_modal_title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="theater_modal_title">
                        Doanh thu theo rạp
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table align-items-center ">
                                    <tbody id="tbody_theater">
                                        <?php $__currentLoopData = $theaters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theater): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <p class="text-xs font-weight-bold mb-0">Rạp</p>
                                                        <h6 class="text-sm mb-0"><?php echo $theater['name']; ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Số vé bán</p>
                                                    <h6 class="text-sm mb-0">
                                                        <?php echo e($theater['ticketseats']); ?>

                                                    </h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Tổng tiền</p>
                                                    <h6 class="text-sm mb-0">
                                                        <?php echo e(number_format($theater['totalPrice'],0,",",".")); ?> đ
                                                    </h6>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
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
        flatpickr($("#end_time"), {
        maxDate: "today",
        dateFormat: "Y-m-d ",
        "locale": "<?php echo app('translator')->get('lang.language'); ?>"
        });
        start_time = flatpickr($("#start_time"), {
            maxDate: "today",
            dateFormat: "Y-m-d ",
            "locale": "<?php echo app('translator')->get('lang.language'); ?>"
        });
        $('#end_time').on("change", function() {
            start_time.set(
                'maxDate', $('#end_time').val()
            );
        });
        $(document).ready(function() {
            var chart = new Morris.Bar({
                element: 'admin_chart',
                barColors: ['#09b1f3', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                hideHover: 'auto',
                data: [{
                    date: null,
                    total: null
                }],
                xkey: 'date',
                ykeys: ['total'],
                labels: ['total']
            });
        //btn-statistical-filter-from-to-date
        $('#btn-statistical-filter').click(function() {
            var from_date = $('#start_time').val();
            var to_date = $('#end_time').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "admin/filter-by-date",
                method: "GET",
                datatype: "JSON",
                data: {
                    from_date: from_date,
                    to_date: to_date
                },
                success: function(data) {
                    $('#admin_chart').empty();
                    chart = new Morris.Bar({
                        element: 'admin_chart',
                        barColors: ['#09b1f3', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                        parseTime: false,
                        hideHover: 'auto',
                        data: [{
                            date: null,
                            total: null
                        }],
                        xkey: 'date',
                        ykeys: ['total'],
                        labels: ['total']
                    });
                    if (data['success']) {
                        chart.setData(data.chart_data);
                    } else if (data['error']) {
                        alert(data.error);
                    }
                },

            })
        });

        //statistical-filter
        $('.statistical-filter').change(function() {
            var statistical_value = $(this).val();
            if (statistical_value === "null") {
                chart.setData([{
                    date: null,
                    total: null,
                    seat_count: null
                }]);
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "admin/statistical-filter",
                method: "GET",
                datatype: "JSON",
                data: {
                    'statistical_value': statistical_value,
                },
                success: function(data) {
                    $('#admin_chart').empty();
                    chart = new Morris.Bar({
                        element: 'admin_chart',
                        barColors: ['#09b1f3', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                        parseTime: false,
                        hideHover: 'auto',
                        data: [{
                            date: null,
                            total: null
                        }],
                        xkey: 'date',
                        ykeys: ['total'],
                        labels: ['total']
                    });
                    if (data['success']) {
                        chart.setData(data.chart_data);
                    } else if (data['error']) {
                        alert(data.error);
                    }
                }
            });
        });

        //statistical sortby
        $('.statistical-sortby').change(function() {
            var statistical_value = $(this).val();
            if (statistical_value === "null") {
                chart.setData([{
                    date: null,
                    seat_count: null
                }]);
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "admin/statistical-sortby",
                method: "GET",
                datatype: "JSON",
                data: {
                    'statistical_value': statistical_value,
                },
                success: function(data) {
                    $('#admin_chart').empty();
                    if (statistical_value == 'ticket') {
                        chart = new Morris.Bar({
                            element: 'admin_chart',
                            barColors: ['#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                            parseTime: false,
                            hideHover: 'auto',
                            data: [{
                                date: null,
                                seat_count: null
                            }],
                            xkey: 'date',
                            ykeys: ['seat_count'],
                            labels: ['Số vé']
                        });
                        if (data['success']) {
                            chart.setData(data.chart_data);
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    } else if (statistical_value == 'theater') {
                        chart = new Morris.Bar({
                            element: 'admin_chart',
                            barColors: ['#fc8710', '#2dce89', '#A4ADD3', '#766B56'],
                            parseTime: false,
                            hideHover: 'auto',

                            data: [{
                                date: null,
                                '1': null,
                                '2': null,
                                '3': null
                            }],
                            xkey: 'date',
                            ykeys: ['1', '2', '3'],
                            labels: ['Rạp Xuân Khánh', 'Rạp Hùng Vương', 'Rạp Bình Thạnh']
                        });
                        if (data['success']) {
                            chart.setData(data.chart_data);
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                }
            });
        });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/admin/web/Home/home.blade.php ENDPATH**/ ?>