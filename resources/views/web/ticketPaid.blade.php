@extends('web.layouts.app')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    section .bg_shadow{
        display: grid;
        font-family: "Roboto", "cursive";
        color: black;
        font-size: 14px;
        letter-spacing: 0.1em;
    }

    .bg_shadow {
        width: 680px;
        height: 275px;
        margin: auto;
        display: flex;
        box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
    }

    .ticket {
        margin: auto;
        width: 680px;
        height: 275px;
        display: flex;
        background: white;
    }

    .left {
        display: flex;
    }


    .left .ticket-number {
        height: 300px;
        width: 300px;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        padding: 5px;
    }

    .ticket-info {
        width: 500px;
        padding: 10px 30px;
        display: flex;
        flex-direction: column;
        text-align: center;
        justify-content: space-between;
        align-items: center;
    }

    .date {
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
        padding: 5px 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .date span {
        width: 150px;
    }

    .date span:first-child {
        text-align: left;
    }

    .date span:last-child {
        text-align: right;
    }

    .date .june-29 {
        color: #d83565;
        font-size: 20px;
    }

    .show-name {
        font-size: 24px;
        color: #d83565;
        padding: 4px;
    }

    .show-name h1 {
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 0.1em;
        color: #4a437e;
    }

    .show-name h2 {
        font-size: 18px;
        font-weight: 700;
        padding: 2px;
        letter-spacing: 0.1em;
    }

    .time {
        padding: 10px 0;
        color: #4a437e;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 10px;
        font-weight: 700;
    }


    .time span {
        font-weight: 400;
        color: gray;
    }

    .left .time {
        font-size: 16px;
    }

    .location {
        display: flex;
        justify-content: space-around;
        font-weight: 900;
        align-items: center;
        width: 100%;
        padding-top: 8px;
        border-top: 1px solid gray;
    }

    .location .separator {
        font-size: 20px;
    }

    .right {
        border-left: 1px dashed #404040;
        position: relative;
        width: 250px;
    }

    .right .right-info-container {
            height: 250px;
            width: 145px;
            padding: 10px 10px 10px 35px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .right .show-name h6 {
            font-size: 18px;
        }

        .barcode {
            height: 100px;
        }

    .right .ticket-number {
        padding: 0 8px;
        color: gray;
    }
    .border-2 {
        border-width: 2px!important;
    }
    .fw-bold {
        font-weight: 700!important;
    }

</style>
<section class="container clearfix">
    <div class="bg_shadow">
        <div id="photo" class="ticket" >
            <div class="left">
                <div class="ticket-info">
                    <p class="date">
                        @php
                            $daysMap = [
                                'Monday' => 'Thứ Hai',
                                'Tuesday' => 'Thứ Ba',
                                'Wednesday' => 'Thứ Tư',
                                'Thursday' => 'Thứ Năm',
                                'Friday' => 'Thứ Sáu',
                                'Saturday' => 'Thứ Bảy',
                                'Sunday' => 'Chủ Nhật'
                            ];
                        @endphp

                        <span>{{ $daysMap[date('l', strtotime($ticket->schedule->date))] }}</span>
                        @php
                            $monthsMap = [
                                'January' => 'Tháng Một',
                                'February' => 'Tháng Hai',
                                'March' => 'Tháng Ba',
                                'April' => 'Tháng Tư',
                                'May' => 'Tháng Năm',
                                'June' => 'Tháng Sáu',
                                'July' => 'Tháng Bảy',
                                'August' => 'Tháng Tám',
                                'September' => 'Tháng Chín',
                                'October' => 'Tháng Mười',
                                'November' => 'Tháng Mười Một',
                                'December' => 'Tháng Mười Hai'
                            ];
                        @endphp

                        <span class="june-29">{{ date('d', strtotime($ticket->schedule->date)) }} {{ $monthsMap[date('F', strtotime($ticket->schedule->date))] }}</span>
                        <span>{!! date('Y', strtotime($ticket->schedule->date)) !!}</span>
                    </p>
                    <div class="show-name">
                        <h1>{!! $ticket['schedule']['movie']['name']  !!}</h1>
                        <h2>{!! $ticket['schedule']['room']['name'] !!}</h2>
                    </div>
                    <div class="time">
                         <p>
                            <span>Thời gian</span> {!! date('H:i A', strtotime($ticket->schedule->startTime)) !!}
                             <span>Đến</span> {!! date('H:i A', strtotime($ticket->schedule->endTime)) !!}
                         </p>
                        <p> <span>Ghế</span>
                            @foreach($ticket->ticketSeats as $seat)
                                @if ($loop->first)
                                    {{ $seat->seat->row.$seat->seat->col }}
                                @else
                                    ,{{ $seat->seat->row.$seat->seat->col }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <p class="location">
                        <span>{!! $ticket->schedule->room->theater->name !!}</span>
                        <span>{!! $ticket->schedule->room->theater->city !!}</span>
                    </p>
                </div>
            </div>
            <div class="right">
                <div class="right-info-container">
                    <div class="barcode">
                        @php
                            $base64 = new SimpleSoftwareIO\QrCode\Facades\QrCode();
                            $base64 = QrCode::size(128)->generate($ticket->code);
                        @endphp
                        <div class=" text-center">
                            {{$base64}}
                        </div>
                        <p class="ticket-number" >
                            #{{ $ticket->code }}
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        {{-- <div class="row d-flex justify-content-center mt-5">
            <h3 class="text-center ">Thông tin vé</h3>
            <div class="col-md-3 ">
                <div>Khách hàng: {{$user->fullname}}</div>
                <div>Mã vé: {{$ticket->code}} </div>
                <div>Tên phim:  {!! $ticket['schedule']['movie']['name']  !!}</div>
            </div>
            <div class="col-md-3">
                <div>Ngày: {{date('d/m/Y', strtotime($ticket->schedule->date))}} </div>
                <div>
                    Thời gian</span> {!! date('H:i A', strtotime($ticket->schedule->startTime)) !!}
                    <span>Đến</span> {!! date('H:i A', strtotime($ticket->schedule->endTime)) !!}
                </div>
                <div>Phòng: {!! $ticket['schedule']['room']['name'] !!}</div>
                <div>  
                    Rạp: <span>{!! $ticket->schedule->room->theater->name !!}</span>
                </div>
                <div>
                    Địa chỉ: <span>{!! $ticket->schedule->room->theater->address !!}</span> 
                </div>
            </div>
            <div class="col-md-3">
                <div>Ghế: 
                    @foreach($ticket->ticketSeats as $seat)
                        @if ($loop->first)
                            {{ $seat->seat->row.$seat->seat->col }}
                        @else
                            ,{{ $seat->seat->row.$seat->seat->col }}
                        @endif
                    @endforeach
                </div>
                <div>Combo:  
                    @foreach($ticket->ticketCombos as $combo)
                    @if ($loop->first)
                    {{ $combo->combo->name }} x {{$combo->quantity}}
                    @else
                        ,{{ $combo->combo->name }} x {{$combo->quantity}}
                    @endif
                    @endforeach
                </div>
                <div>
                    Tổng tiền: {{ number_format($ticket->totalPrice,0,",",".") }} đ
                </div>
                <div>
                    Phương thức thanh toán: 
                    @if ($ticket->payment == "QR")
                        Thanh toán bằng ứng dụng hỗ trợ
                    @elseif ($ticket->payment == "ATM")
                        Thanh toán qua thẻ ATM/Tài khoản nội địa
                    @endif
                </div>
            </div>
        </div> --}}

        <div class="row d-flex justify-content-center mt-5">
            <h3 class="text-center mb-4">Thông tin vé</h3>
        
            <div class="col-md-3">
                <div class="card shadow border-0 bg-light p-3">
                    <h5 class="text-primary mb-3">Chi tiết khách hàng</h5>
                    <div>Khách hàng: {{$user->fullname}}</div>
                    <div>Mã vé: {{$ticket->code}}</div>
                    <div>Tên phim: {!! $ticket['schedule']['movie']['name'] !!}</div>
                </div>
            </div>
        
            <div class="col-md-3">
                <div class="card shadow border-0 bg-light p-3">
                    <h5 class="text-primary mb-3">Thông tin lịch chiếu</h5>
                    <div>Ngày: {{ date('d/m/Y', strtotime($ticket->schedule->date)) }}</div>
                    <div>
                        Thời gian: {!! date('H:i A', strtotime($ticket->schedule->startTime)) !!}
                        <span>Đến</span> {!! date('H:i A', strtotime($ticket->schedule->endTime)) !!}
                    </div>
                    <div>Phòng: {!! $ticket['schedule']['room']['name'] !!}</div>
                    <div>Rạp: {!! $ticket->schedule->room->theater->name !!}</div>
                    <div>Địa chỉ: {!! $ticket->schedule->room->theater->address !!}</div>
                </div>
            </div>
        
            <div class="col-md-3">
                <div class="card shadow border-0 bg-light p-3">
                    <h5 class="text-primary mb-3">Thông tin vé & thanh toán</h5>
                    <div>Ghế: 
                        @foreach($ticket->ticketSeats as $seat)
                            @if ($loop->first)
                                {{ $seat->seat->row.$seat->seat->col }}
                            @else
                                ,{{ $seat->seat->row.$seat->seat->col }}
                            @endif
                        @endforeach
                    </div>
                    <div>Combo:  
                        @foreach($ticket->ticketCombos as $combo)
                            @if ($loop->first)
                                {{ $combo->combo->name }} x {{$combo->quantity}}
                            @else
                                ,{{ $combo->combo->name }} x {{$combo->quantity}}
                            @endif
                        @endforeach
                    </div>
                    <div>Tổng tiền: {{ number_format($ticket->totalPrice,0,",",".") }} đ</div>
                    <div>Phương thức thanh toán: 
                        @if ($ticket->payment == "QR")
                            Thanh toán bằng ứng dụng hỗ trợ Momo QR
                        @elseif ($ticket->payment == "ATM")
                            Thanh toán qua thẻ ATM/Tài khoản nội địa
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div style="display: flex; justify-content: center; letter-spacing: 20px;" class="mt-5">
            <div style="display: flex;">
                <form action="/">
                    <button  type="submit" class="btn border-2 fw-bold">Quay về trang chủ</button>&nbsp
                </form>
                <div style="display: inline-block" >
                    <button id="download" class="btn btn-info border-2 fw-bold">Tải xuống</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        window.onload = () => {
            ticket = document.getElementById('photo');
            html2canvas(ticket).then((canvas) => {
                image = canvas.toDataURL('image/PNG');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/ticketPaid/image',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'image' : image
                        },
                        statusCode: {
                            200: (data) => {
                            },
                            500: (data) => {
                            }
                        }
                    });
            });
        }



        $(document).ready(() => {
            $("#download").on('click', () => {
                ticket = document.getElementById('photo');
                html2canvas(ticket).then((canvas) => {
                    downloadImage(canvas.toDataURL('image/PNG', 1.0),"TicketInfo_" + {{$ticket->code}} + ".png");
                });
            });
        })


        function downloadImage(uri, filename){
            var link = document.createElement('a');
            if(typeof link.download !== 'string'){
                window.open(uri);
            }
            else{
                link.href = uri;
                link.download = filename;
                accountForFirefox(clickLink, link);
            }
        }

        function clickLink(link){
            link.click();
        }

        function accountForFirefox(click){
            var link = arguments[1];
            click(link);
        }
    </script>
@endsection
