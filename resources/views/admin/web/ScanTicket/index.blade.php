@extends('admin.layouts.index')
@section('content')
    
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
                            @if (session()->has('ticket'))
                                {{session('ticket')->schedule->room->theater->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Phòng</td>
                        <td id="room">
                            @if (session()->has('ticket'))
                                {{session('ticket')->schedule->room->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Chổ ngồi</td>
                        <td id="seats">
                            @if (session()->has('ticket'))
                                @foreach(session('ticket')->ticketSeats as $seat)
                                    @if ($loop->first)
                                        {{ $seat->seat->row.$seat->seat->col }}
                                    @else
                                        ,{{ $seat->seat->row.$seat->seat->col }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Combo</td>
                        <td id="combos">
                            @if (session()->has('ticket'))
                                @foreach(session('ticket')->ticketCombos as $combo)
                                    @if ($loop->first)
                                        {{ $combo->combo->name}} x {{$combo->quantity }} 
                                    @else
                                        ,{{ $combo->combo->name}} x {{$combo->quantity}}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Phim</td>
                        <td id="movie">
                            @if (session()->has('ticket'))
                                {{session('ticket')->schedule->movie->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Thời gian</td>
                        <td><span id="date">
                            @if (session()->has('ticket'))
                                {!! date('d/m/y', strtotime(session('ticket')->schedule->date)) !!}
                            @endif    
                        </span > | <span id="startTime">
                            @if (session()->has('ticket'))
                                {!! date('H:i A', strtotime(session('ticket')->schedule->startTime)) !!}
                            @endif
                        </span></td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td id="status">
                            @if (session()->has('ticket'))
                                {{session('ticket')->status}}
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <form action="admin/staff/confirmTicket" method="post">
                        @csrf
                        <label for="ticket_id" class="form-control-label">Mã vé</label>
                        <input id="ticket_id" class="form-control" name="code" type="number" 
                        @if (session()->has('ticket'))
                            value="{{session('ticket')->code}}"
                        @else
                            value=""
                        @endif readonly>
                        <button type="submit" class="btn btn-primary mt-3">Xác nhận</button>
                    </form>
                </div>
                <form action="admin/staff/checkTicket" method="post" id="checkTicket">
                    @csrf
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
@endsection
@section('js')
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

    @if(session('success'))
        Swal.fire({
            title: '{{session('success')}}',
            icon: 'success',
            confirmButtonText: 'Ok'
        })
        @endif
    @if(session('fail'))
        Swal.fire({
            title: '{{session('fail')}}',
            icon: 'error',
            confirmButtonText: 'Ok'
        })
    @endif
    @if(session('warning'))
        Swal.fire({
            title: '{{session('warning')}}',
            icon: 'warning',
            confirmButtonText: 'Ok'
        })
    @endif
</script>
@endsection
