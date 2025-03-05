@extends('admin.layouts.index')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Thông tin phòng</h6>
                </div>
                <div class="card-body">
                    <form action="admin/room/edit/{{$room->id}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Tên phòng</label>
                                    <input id="name" type="text" name="name" class="form-control"
                                           placeholder="Name..." value="{{$room->name}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="type">Loại phòng</label>
                                    <select class="form-control" name="type" id="type">
                                        @foreach($roomTypes as $type)
                                            <option value="{{$type->id}}"
                                                @if($room->roomType_id == $type->id) selected @endif>
                                                {{$type->name}}
                                            </option>
                                        @endforeach
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
            <div class="card mb-2" @if($room->seats->count() > 300) style="width: 1500px" @endif>
                <div class="card-header pb-0">
                    <h6>{{$room->name}}</h6>
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
                            @foreach($room->rows as $row)
                                <div class="row d-block" id="Row_{{ $row->row }}" style="margin: 2px">
                                    @foreach($room->seats as $seat)
                                        @if($seat->row == $row->row)
                                        @for($m = 0; $m < $seat->ms; $m++)
                                            <div class="d-inline-block align-middle disabled seat_empty" style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                        @endfor
                                            <div class="d-inline-block cursor-pointer align-middle py-1 px-0 seat_enable"
                                                 id="Seat_{{ $seat->row.$seat->col}}"
                                                 style="
                                                 @if($seat['status'] == 1)
                                        background-color: {{ $seat->seatType->color }};
                                        @else
                                         background-color: #999;
                                        @endif
                                        width: 30px;
                                        height: 30px;
                                        line-height: 22px;
                                        font-size: 10px;
                                        margin: 2px 0;
                                     "
                                                 data-bs-toggle="offcanvas" data-bs-target="#EditSeat_{{ $seat->id }}">
                                                {{ $seat->row.$seat->col }}
                                            </div>
                                            @for($n = 0; $n < $seat->me; $n++)
                                                <div class="d-inline-block align-middle disabled seat_empty"
                                                style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                            @endfor

                                            <div class="offcanvas offcanvas-start" tabindex="-1" id="EditSeat_{{ $seat->id }}"
                                                aria-labelledby="EditSeatRowLabel">
                                               <div class="offcanvas-header">
                                                   <h5 class="offcanvas-title" id="EditSeatRowLabel">EDIT {{ $seat->row.$seat->col }}</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                           aria-label="Close"></button>
                                               </div>
                                               <div class="offcanvas-body">
                                                   <form action="admin/seat/edit" method="post">
                                                       @csrf
                                                       @foreach($seatTypes as $seatType)
                                                           <div class="form-check">
                                                               <input class="form-check-input seat_type_radio" type="radio" name="seatType"
                                                                      id="ColorRadio_{{ $seatType->id }}_{{ $seat->id }}" value="{{ $seatType->id }}"
                                                                      @if($seat->seatType_id==$seatType->id)
                                                                          checked
                                                                      @endif
                                                               >
                                                               <label class="form-check-label flex-fill d-flex border-0 ps-1 my-2"
                                                                      for="ColorRadio_{{ $seatType->id }}_{{ $seat->id }}">
                                                               <span class="fw-bold d-block text-center me-1"
                                                                     style="width: 20px; height: 20px; background-color: {{ $seatType->color }};"></span>
                                                                   <span style="line-height: 20px">{{ $seatType->name }} - {{ $seatType->surcharge }}</span>
                                           
                                                               </label>
                                           
                                                           </div>
                                                       @endforeach
                                                       <label class="text-sm">
                                                               @if($seat['status'] ==1)
                                                                   <a href="admin/seat/on/{!! $seat['id'] !!},{!! $room['id'] !!}">
                                                                       <span class="badge badge-sm bg-gradient-success">Online</span>
                                                                   </a>
                                                               @else
                                                               <a href="admin/seat/off/{!! $seat['id'] !!},{!! $room['id'] !!}">
                                                                           <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                                   </a>
                                                               @endif
                                                       </label>
                                                       <div class="form-group">
                                                            <label for="seat_ms_{{ $seat->id }}">@lang('lang.left_align')</label>
                                                            <input class="form-control" type="number" name="ms" id="seat_ms_{{ $seat->id }}" value="{{ $seat->ms }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seat_me_{{ $seat->id }}">@lang('lang.right_align')</label>
                                                            <input class="form-control" type="number" name="me" id="seat_me_{{ $seat->id }}" value="{{ $seat->me }}">
                                                        </div>
                                                       <input type="hidden" name="room" value="{{ $room->id }}">
                                                       <input type="hidden" name="seat" value="{{ $seat->id }}">
                                                       <a href="admin/seat/delete/{{$seat->id}}?room={{ $room->id }}" class="btn btn-primary mt-4">
                                                           <i class="fa-solid fa-trash-can fa-lg"></i> Xóa
                                                       </a>
                                                       <button type="submit" class="btn btn-primary mt-4"
                                                               data-bs-dismiss="offcanvas">
                                                           Xác nhận
                                                       </button>
                                                   </form>
                                               </div>
                                           </div>
                                                                                      
                                        @endif
                                        @if($loop->last)
                                            <div class="d-inline-block border cursor-pointer align-middle py-1 px-0"
                                                 style=" width: 30px; height: 30px; margin: 2px -30px 2px 0;"
                                                 data-bs-toggle="offcanvas" data-bs-target="#EditRow_{{ $room->id }}_{{ $row->row }}">
                                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                            </div>
                                            
                                            <div class="offcanvas offcanvas-start" tabindex="-1" id="EditRow_{{ $room->id }}_{{ $row->row }}"
                                                aria-labelledby="EditSeatRowLabel">
                                               <div class="offcanvas-header">
                                                   <h5 class="offcanvas-title" id="EditSeatRowLabel">EDIT Hàng</h5>
                                                   <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                           aria-label="Close"></button>
                                               </div>
                                               <div class="offcanvas-body">
                                                   <form action="admin/seat/row" method="post">
                                                       @csrf
                                                       @foreach($seatTypes as $seatType)
                                                           <div class="form-check">
                                                               <input class="form-check-input seat_type_radio" type="radio" name="seatType"
                                                                      id="ColorRadio_{{ $seatType->id }}_{{ $room->id }}_{{ $row->row }}" value="{{ $seatType->id }}">
                                                               <label class="custom-control-label flex-fill d-flex border-0 ps-1 my-2"
                                                                      for="ColorRadio_{{ $seatType->id }}_{{ $room->id }}_{{ $row->row }}">
                                                               <span class="fw-bold d-block text-center me-1 seat_color_{{ $seatType->id }}"
                                                                     style="width: 20px; height: 20px; background-color: {{ $seatType->color }};"></span>
                                                                   <span style="line-height: 20px">{{ $seatType->name }} - {{ $seatType->surcharge }}</span>
                                                               </label>
                                                           </div>
                                                       @endforeach
                                                       <div class="form-group">
                                                            <label for="row_mb_{{ $room->id }}_{{ $row->row }}">@lang('lang.below_align')</label>
                                                            <input class="form-control" type="number" name="mb" id="row_mb_{{ $room->id }}_{{ $row->row }}" value="0">
                                                        </div>
                                                       <input type="hidden" name="room" value="{{ $room->id }}">
                                                       <input type="hidden" name="row" value="{{ $row->row }}">
                                                       <button type="submit" class="btn btn-primary" data-bs-dismiss="offcanvas">
                                                           Xác nhận
                                                       </button>
                                                   </form>
                                               </div>
                                           </div>
                                        @endif
                                    @endforeach
                                    @for($m = 0; $m < $row->mb; $m++)
                                                <div class="row d-block" style="margin: 2px">
                                                    <div class="d-inline-block align-middle disabled seat_empty"
                                                         style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                                </div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
