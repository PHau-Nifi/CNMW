@extends('admin.layouts.index')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                BÁN VÉ - Rạp {{auth('staff')->user()->theater->name}}
            </div>

            <div class="card-body pt-2">
                <div id="lichtheorap" class="collapse show" data-bs-parent="#schedules">
                    <div id="theaterParent">
                        <form action="/admin/buyTicket" method="get">
                            @csrf
                            <div class="row container mt-5">
                                <div class="col-10">
                                    <div class="input-group">
                                        <span class="input-group-text bg-gray-200"> Ngày</span>
                                        <input class="form-control ps-2" type="date" min="{{ date('Y-m-d') }}" name="date" value="{{ $date_cur }}"
                                               aria-label="">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                </div>
                            </div>
                        </form>

                        <div id="theaterSchedulesParent">
                            <div id="TheaterSchedules_{{$theater->id}}">
                                <div class="mt-5">
                                    <h4>Lịch chiếu phim</h4>
                                    <div class="d-block mt-2 mb-5">
                                        <div class="row">
                                            @foreach($movies as $movie)
                                                @if($movie->schedulesByDateAndTheater($date_cur ,$theater->id)->count() > 0)
                                                    <div class="col-3">
                                                        <div class="card border mb-2">
                                                            <button type="button" class="btn btn-link"
                                                                data-bs-toggle="modal" data-bs-target="#movieSchedules_{{$movie->id}}">
                                                            <div class="card-header p-2" style="height: 80px">{{$movie->name}}</div>
                                                                <img class="card-img rounded"
                                                                     style="width: 180px; height: 240px" alt="..." @if(strstr($movie->image,"https") === false)
                                                                     src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{{ $movie->image }}.jpg"
                                                                 @else
                                                                     src="{{$movie->image}}"
                                                                 @endif>
                                                            </button>
                                                        </div>
                                                        <div class="modal fade" id="movieSchedules_{{$movie->id}}" tabindex="-1" role="dialog"
                                                             aria-labelledby="movieTitle_{{$movie->id}}" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="movieTitle_{{$movie->id}}">{{$movie->name}}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close">X</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="card-body">
                                                                            {{-- a Theater schedule --}}
                                                                            <div class="flex-grow-1 border-start border-5 border-white p-2 ps-4">
                                                                                @foreach($roomTypes as $roomType)
                                                                                    @if($roomType->schedulesByDateAndTheaterAndMovie($date_cur, $theater->id, $movie->id)->count() > 0)
                                                                                        <div class="d-flex flex-column flex-nowrap overflow-auto mb-4">
                                                                                            <div class="fw-bold">{{ $roomType->name }}</div>
                                                                                            <div class="d-flex flex-wrap overflow-wrapper">
                                                                                                @foreach($roomType->schedulesByDateAndTheaterAndMovie($date_cur, $theater->id, $movie->id) as $schedule)
                                                                                                    @if (strtotime($schedule->startTime) + (15*60) > strtotime($time_cur))
                                                                                                        <a href="/admin/buyTicket/ticket/{{$schedule->id}}"
                                                                                                            class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                                                                                            style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                                                                                            <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                                                                                                {{ date('H:i', strtotime($schedule->startTime ))}}
                                                                                                            </p>
                                                                                                     </a>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                            {{-- a Theater schedule: end --}}
                                                                        </div>
                                                                        <div class="mt-4">
                                                                            <h4>Loại khách hàng</h4>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="customerType" id="customerTypeAdult" value="nl" checked>
                                                                                <label class="form-check-label" for="customerTypeAdult">
                                                                                    Người lớn
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="customerType" id="customerTypeChild" value="nctte">
                                                                                <label class="form-check-label" for="customerTypeChild">
                                                                                    Trẻ em, người già
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="customerType" id="customerTypeSenior" value="hssv">
                                                                                <label class="form-check-label" for="customerTypeSenior">
                                                                                    Học sinh, sinh viên
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
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
    <script>
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

        $(document).ready(function () {
        let selectedCustomerType = 'nl';

        // Cập nhật loại khách hàng khi thay đổi radio button
        $('input[name="customerType"]').on('change', function () {
            selectedCustomerType = $(this).val();
            console.log('Loại khách hàng được chọn:', selectedCustomerType); // Debug
        });

        $('.btn-warning').on('click', function (event) {
            event.preventDefault(); 
            let originalUrl = $(this).attr('href'); 
            let newUrl = originalUrl + '?customerType=' + selectedCustomerType; 
            window.location.href = newUrl;
        });
    });
    </script>
@endsection
