@extends('admin.layouts.index')
@section('content')
    <div class="container-fluid py-4">
            <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                ĐĂNG KÝ KHÁCH HÀNG
            </div>

            <div class="card-body pt-2">
                <form method='post' action="/signUp">
                    @csrf
                    <div class="mb-3">
                        <label for="fullname" class="form-label fw-bold">Tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                        @if ($errors->has('fullname'))
                            <p>{{ $errors->first('fullname') }}</p>
                        @endif
                      </div>
                    <div class="mb-3">
                      <label for="email" class="form-label fw-bold">Email</label>
                      <input type="email" class="form-control" id="email" name="email">
                      @if ($errors->has('email'))
                        <p>{{ $errors->first('email') }}</p>
                      @endif
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
                        <input type="nunber" class="form-control" id="phone_number" name="phone">
                        @if ($errors->has('phone'))
                            <p>{{ $errors->first('phone') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-gray-200"> @lang('lang.date')</span>
                            <input name="brithday" id="date" value="" aria-label="" class="form-control ps-2" type="text">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @if ($errors->has('password'))
                            <p>{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="rpassword" class="form-label fw-bold">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="repassword" name="repassword">
                        @if ($errors->has('repassword'))
                            <p>{{ $errors->first('repassword') }}</p>
                        @endif
                    </div>
                    <input type="hidden" name="type" value="staff">
                    
                    
                    <div class="row">
                        <div class="m-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agreement" name="agreement">
                            <label class="form-check-label" for="agreement"> Đồng ý với điều khoản.</label>
                            @if ($errors->has('agreement'))
                                <p>{{ $errors->first('agreement') }}</p>
                            @endif
                        </div>
                         <div class="d-flex justify-content-end">
                            <button type="submit" class="btn fw-bold">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    $(document).ready(function(){
        flatpickr($("#date"), {
            dateFormat: "Y-m-d ",
            "locale": "vn"
        });
    })
</script>
<script>
    @if(session('success'))
        Swal.fire({
            title: '{{ session('success') }}',
            html: 'Mã khách hàng: <span id="customerCode">{{ session('user')->code }}</span><br><br><button id="copyButton" class="btn btn-primary btn-sm">Copy mã</button>',
            icon: 'success',
            confirmButtonText: 'Ok',
            didOpen: () => {
                new ClipboardJS('#copyButton', {
                    text: function() {
                        return $('#customerCode').text();
                    }
                }).on('success', function() {
                    Swal.fire({
                        title: 'Đã sao chép!',
                        text: 'Mã khách hàng đã được sao chép vào clipboard.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                });
            }
        });
    @endif
    @if(session('fail'))
    Swal.fire({
        title: '{{session('fail')}}',
        icon: 'error',
        confirmButtonText: 'Ok'
    })
    @endif
</script>
@endsection