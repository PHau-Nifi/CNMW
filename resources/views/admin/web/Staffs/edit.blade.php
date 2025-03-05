<form action="admin/staff/edit/{{$value->id}}" method="POST">
    @csrf
    <div class="modal fade" id="editStaff{!! $value['id'] !!}" tabindex="-1" aria-labelledby="staff_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staff_title">@lang('lang.staff') {{$value->fullname}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.name')</label>
                                    <input aria-label="" id="fn" class="form-control" type="text" value="{{$value->fullname}}" name="fullname"
                                           placeholder="@lang('lang.type') @lang('lang.name')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input aria-label="" id="e" class="form-control" type="email" value="{{$value->email}}" name="email"
                                           placeholder="@lang('lang.type') email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.phone')</label>
                                    <input aria-label="" id="p" class="form-control" type="text" value="{{$value->phone}}" name="phone"
                                           placeholder="@lang('lang.phone')">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.theater')</label>
                                    <select id="theater" aria-label="" class="form-control" name="theater_id">
                                        <option value="Admin">Admin</option>
                                        @foreach($theaters as $theater)
                                            <option value="{{$theater->id}}"
                                            @if ($value->theater_id == $theater->id)
                                                selected
                                            @endif
                                                >{{$theater->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.role')</label>
                                    <select id="role" aria-label="" class="form-control" name="role_id">
                                        @foreach($role as $role)
                                            <option value="{{$role->id}}"
                                            @if ($value->role_id == $role->id)
                                                selected
                                            @endif
                                                >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <button type="submit" class="btn bg-gradient-info">@lang('lang.save')</button>
                </div>
            </div>
        </div>
    </div>
</form>     