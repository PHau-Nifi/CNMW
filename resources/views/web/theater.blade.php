@extends('web.layouts.app')
@section('content')
<section class="container clearfix">
    @section('content')
    <section class="container-lg clearfix" style="min-height: 1000px">
        <div class="mt-5" id="schedules">
            <div id="lichtheorap" data-bs-parent="#schedules">
                <div class="d-flex flex-row mt-4">
                    @foreach($cities as $city)
                        <div class="flex-city p-2 m-1 border-0">
                            <button class="btn @if($loop->first) btn-danger @else btn-outline-dark @endif p-3"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#Theater_{{str_replace(' ', '', $city)}}" @if($loop->first) disabled @endif>{{$city}}
                            </button>
                        </div>
                    @endforeach
                </div>
                <div id="theaterParent">
                    @foreach($cities as $city)
                        <div class="collapse @if($loop->first) show @endif" id="Theater_{{str_replace(' ', '', $city)}}"
                             data-bs-parent="#theaterParent">
                            <div class="row g-4 mt-2 row-cols-1 row-cols-sm-2 row-cols-md-4 ">
                                @foreach($theaters as $theater)
                                    @if($city == $theater->city)
                                        <!-- Theater -->
                                        <div class="col">
                                            <div class="card px-0 overflow-hidden theater_item"
                                                 style="background: #f5f5f5">
                                                <button class="btn rounded-0 border-0 btn_theater @if($loop->first) btn-warning @endif"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#TheaterSchedules_{{$theater->id}}"
                                                        @if($loop->first) disabled @endif>
                                                    <div class="card-body">
                                                        <h5 class="card-title fs-4">{{ $theater->name }}</h5>
                                                        <p class="card-text fs-6 text-secondary">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            {{ $theater->address }}
                                                        </p>
                                                    </div>
                                                </button>

                                                <div class="card-footer">
                                                    <a href="{{ $theater->location }}"
                                                       class="btn w-100 h-100 text-uppercase" target="_blank">xem Bản đồ
                                                        <i class="fa-solid fa-map-location-dot"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Theater: end -->
                                    @endif

                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div id="theaterSchedulesParent">
                        @foreach($theaters as $theater)
                        <div class="collapse @if($loop->first) show @endif" id="TheaterSchedules_{{$theater->id}}" data-bs-parent="#theaterSchedulesParent">
                            <ul class="list-group list-group-horizontal flex-wrap mt-4 listDate">
                                @for($i = 0; $i <= 7; $i++)
                                    <li class="list-group-item border-0">
                                        <button data-bs-toggle="collapse"
                                                data-bs-target="#schedule_{{$theater->id}}_date_{{$i}}"
                                                @if($i == 0)
                                                    aria-expanded="true"
                                                @else
                                                    aria-expanded="false"
                                                @endif
                                                class="btn btn-block btn-outline-dark p-2 m-2 @if($i==0) active @endif btn-date">
                                            {{ date('d/m', strtotime('+ '.$i.' day', strtotime(today()))) }}
                                        </button>
                                    </li>
                                @endfor
                            </ul>
                            <div class="mt-2">
                                <h4>Lịch chiếu phim</h4>
                                <div>
                                    <div class="d-block mt-2 mb-5"  id="schedulesMain_{{$theater->id}}">
                                        @for($i = 0; $i <= 7; $i++)
                                            <div class="collapse collapse-horizontal @if($i == 0) show @endif" id="schedule_{{$theater->id}}_date_{{$i}}" data-bs-parent="#schedulesMain_{{$theater->id}}">
                                                @foreach($movies as $movie)
                                                    @if($movie->schedulesByDateAndTheater(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id)->count() > 0)
                                                        <div class="p-2 d-flex flex-row m-1 align-items-center rounded" style="background: #f5f5f5">
                                                            <div class="flex-shrink-0 p-2 border-end border-4 border-white">
                                                                <img class="lazy img-responsive" 
                                                                @if(strstr($movie->image,"https") === false)
                                                                src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{{ $movie['image'] }}.jpg"
                                                                @else
                                                                    src="{{$movie['image']}}"
                                                                @endif 
                                                                alt="" title="{!! $movie['name'] !!}" style="height: 150px">
                                                            </div>
                                                            {{-- a Theater schedule --}}
                                                            <div class="flex-grow-1 border-start border-5 border-white p-2 ps-4">
                                                                @foreach($roomTypes as $roomType)
                                                                    @if($roomType->schedulesByDateAndTheaterAndMovie(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id, $movie->id)->count() > 0)
                                                                        <div class="d-flex flex-column flex-nowrap overflow-auto mb-4">
                                                                            <div class="fw-bold">{{ $movie->name}}</div>
                                                                            <div class="fw-bold">{{ $roomType->name }}</div>
                                                                            <div class="d-flex flex-wrap overflow-wrapper">
                                                                                @foreach($roomType->schedulesByDateAndTheaterAndMovie(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id, $movie->id) as $schedule)
                                                                                    @if ($i===0)
                                                                                        @if(date('H:i', strtotime('+ 20 minutes', strtotime($schedule->startTime))) >= $current_time)
                                                                                            <a href="/ticket/{{$schedule->id}}"
                                                                                            class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                                                                            style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                                                                                <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                                                                                    {{ date('H:i', strtotime($schedule->startTime ))}}
                                                                                                </p>
                                                                                            </a>
                                                                                        @endif
                                                                                    @else
                                                                                        <a href="/tickets/{{$schedule->id}}"
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
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#schedules .nav .nav-item .nav-link").on("click", function () {
                $("#schedules .nav-item").find(".active").removeClass("active link-warning fw-bold border-bottom border-2 border-warning").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active link-warning fw-bold border-bottom border-2 border-warning").removeClass("link-secondary").prop('disabled', true);
            });

            $("#lichtheorap .d-flex .flex-city .btn").on("click", function () {
                $("#lichtheorap .flex-city").find(".btn").removeClass("btn-danger").addClass("btn-outline-dark").prop('disabled', false);
                $(this).addClass("btn-danger").removeClass("btn-outline-dark").prop('disabled', true);
            });

            $(".theater_item .btn_theater").on("click", function () {
                $(".theater_item ").find(".btn_theater").removeClass("btn-warning").prop('disabled', false);
                $(this).addClass("btn-warning").prop('disabled', true);
            });

            $(".listDate button").on('click', function () {
                $(".listDate").find(".btn").removeClass('active');
                $(this).addClass("active");
            })
        })
    </script>
@endsection