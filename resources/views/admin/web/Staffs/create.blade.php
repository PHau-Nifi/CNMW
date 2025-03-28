<form action="admin/staff/create" method="POST">
    @csrf
    <div class="modal fade" id="staff" tabindex="-1" aria-labelledby="staff_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staff_title">Nhân viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.name')</label>
                                    <input aria-label="" id="fn" class="form-control" type="text" value="" name="fullname"
                                           placeholder="@lang('lang.type') @lang('lang.name')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input aria-label="" id="e" class="form-control" type="email" value="" name="email"
                                           placeholder="@lang('lang.type') email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.phone')</label>
                                    <input aria-label="" id="p" class="form-control" type="text" value="" name="phone"
                                           placeholder="@lang('lang.phone')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.password')</label>
                                    <input aria-label="" id="rp" class="form-control" type="password" value="" name="password"
                                           placeholder="@lang('lang.password')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.theater')</label>
                                    <select id="t" aria-label="" class="form-control" name="theater_id">
                                        @foreach($theaters as $theater)
                                            <option value="{{$theater->id}}">{{$theater->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn bg-gradient-info">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>     