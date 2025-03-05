@extends('web.layouts.app')
@section('content')
@php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp
<section class="container clearfix">
    <div class="container">
        <h1 class="mb-5"></h1>
        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
                <div class="p-5">
                    <h4 class="text-center">{!! $user['fullname'] !!}</h4>
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
                        @csrf
                        <h4 class="text-center">Mã thành viên</h4>
                        <div class="text-center mt-3">
                            <img src="data:image/png;base64,{!! base64_encode($generatorPNG->getBarcode($user['code'],$generatorPNG::TYPE_CODE_128)) !!}" />
                        </div>
                        <div class="text-center mt-3">{!! $user['code'] !!}</div>
                        
                        <!-- Hiển thị điểm và hạng khách hàng -->
                        <div class="mt-3 text-center">
                            <p><strong>Điểm tích lũy:</strong> {!! $user['point'] !!}</p>
                            <p><strong>Hạng khách hàng:</strong> {!! $user->level->name !!}</p>
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
                                                @foreach($user->level->discount as $i => $discount)
                                                <tr>
                                                    <th scope="row">{{$i+1}}</th>
                                                    <td>{{$discount->name}}</td>
                                                    <td>{{$discount->percent}}%</td>
                                                    <td>{{$discount->code}}</td>
                                                </tr>
                                                @endforeach
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
                                <input type="text" class="form-control" name="fullname" required value="{!! $user['fullname'] !!}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{!! $user['email'] !!}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="{!! $user['phone'] !!}">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                            </div>
                        </div>
                    </form>

                    <!-- Form đổi mật khẩu -->
                    <form action="/changePassword" method="POST" class="collapse" id="password" data-bs-parent="#mainContent">
                        @csrf
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
                                    @foreach($sort_ticket as $value)
                                        @if(isset($value['schedule']['movie']['image']))
                                            <div class="row mb-3">
                                                <p class="col-12">Code: {!! $value['code'] !!}</p>
                                                <div class="col-3">
                                                    <img class="img-fluid" 
                                                    @if(strstr($value->image,"https") === false)
                                                    src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{{ $value['schedule']['movie']['image'] }}.jpg"
                                                    @else
                                                        src="{{$value['schedule']['movie']['image']}}"
                                                    @endif  alt="{!! $value['schedule']['movie']['name'] !!}">
                                                </div>
                                                <div class="col-md-7">
                                                    <p>{!! $value['schedule']['movie']['name'] !!}</p>
                                                    <p class="badge @if($value['schedule']['movie']['rating']['name'] == 'C18') bg-danger @elseif($value['schedule']['movie']['rating']['name'] == 'C16') bg-warning @elseif($value['schedule']['movie']['rating']['name'] == 'P') bg-success @elseif($value['schedule']['movie']['rating']['name'] == 'K') bg-primary @else bg-info @endif">
                                                        {!! $value['schedule']['movie']['rating']['name'] !!}
                                                    </p>
                                                    <p>{!! date("d/m/Y", strtotime($value['schedule']['date'])) !!}</p>
                                                    <p>Phòng {!! date("H:i A", strtotime($value['schedule']['startTime'])) !!} ~ Đến {!! date("H:i A", strtotime($value['schedule']['endTime'])) !!}</p>
                                                    <p>
                                                        {!! $value['schedule']['room']['theater']['name'] !!}: {!! $value['schedule']['room']['name'] !!}
                                                        (@foreach($value['ticketSeats'] as $seat) {{ $loop->first ? $seat->seat->row.$seat->seat->col : ', '.$seat->seat->row.$seat->seat->col }} @endforeach)
                                                    </p>
                                                    <p>Giá tiền: {!! number_format($value['totalPrice'], 0, ",", ".") !!}</p>
                                                    <a href="/ticketPaid/{{$value->id}}" class="btn btn-warning"><i class="fa-solid fa-ticket"></i></a>
                                                    <button data-bs-target="#profileModal{!! $value['id'] !!}" data-bs-toggle="modal" class="btn btn-warning">@lang('lang.detail')</button>
        
                                                    <!-- Modal Chi tiết vé -->
                                                    <div class="modal fade" id="profileModal{!! $value['id'] !!}" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center" id="profileModalLabel">@lang('lang.ticket_code') : {!! $value['code'] !!}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-body">
                                                                        <div class="text-center">#{!! $value['code'] !!}</div>
                                                                        <p>@lang('lang.purchase_date') : {!! date("d/m/Y", strtotime($value['created_at'])) !!}</p>
                                                                        <span>@lang('lang.payment_methods'): {{$value->payment}} </span>
                                                                        <div class="d-flex justify-content-end">
                                                                            <button data-bs-target="#billModal{!! $value['id'] !!}" data-bs-toggle="modal" class="btn btn-danger m-2">@lang('lang.print_bill')</button>
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
                                                                                    <td>{!! $value['schedule']['movie']['name'] !!}</td>
                                                                                    <td>{!! date("d/m/Y", strtotime($value['schedule']['date'])) !!} {!! date("H:i A", strtotime($value['schedule']['startTime'])) !!} - {!! date("H:i A", strtotime($value['schedule']['endTime'])) !!}</td>
                                                                                    <td>
                                                                                        @foreach($value['ticketSeats'] as $seat)
                                                                                            {{ $loop->first ? $seat->seat->row.$seat->seat->col : ', '.$seat->seat->row.$seat->seat->col }}
                                                                                        @endforeach
                                                                                    </td>
                                                                                    <td>{!! number_format($value['totalPrice'], 0, ",", ".") !!}</td>
                                                                                    <td>
                                                                                        @if ($value->status)
                                                                                            Đã xác nhận
                                                                                        @elseif ($value->status == 0)
                                                                                            Đã hủy
                                                                                        @else
                                                                                            Chờ
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <div>
                                                                            <a href="#refundTicket" data-toggle="tooltip" data-bs-target="#refundTicket{!! $value['id'] !!}" data-bs-toggle="modal" class="text-uppercase text-center link link-dark text-decoration-none text-xl text-dark ">@lang('lang.refund_ticket')</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @include('web.bill_modal')
                                            @include('web.refund_ticket_modal')
                                        @endif
                                    @endforeach
                                    {{ $sort_ticket->links() }}
                                </div>
                                <div class="col-md-3">
                                    <div class="card border border-dark shadow-0 mb-3" style="max-width: 18rem;">
                                        <div class="card-header">Chi tiêu</div>
                                        <div class="card-body">
                                          <p class="card-text">Số vé: {{count($tickets)}}</p>
                                          <p class="card-text">Tổng tiền: {{number_format($sum, 0, ",", ".")}} VND</p>
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
@endsection
@section('js')
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
@endsection