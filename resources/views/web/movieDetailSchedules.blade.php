<div class="modal fade" id="datve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$movie->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="schedules">
                <ul class="list-group list-group-horizontal flex-wrap mt-4 listDate">
                    @for($i = 0; $i <= 7; $i++)
                        <li class="list-group-item border-0">
                            <button data-bs-toggle="collapse"
                                    data-bs-target="#schedule_date_{{$i}}"
                                    @if($i == 0)
                                        aria-expanded="true"
                                    @else
                                        aria-expanded="false"
                                    @endif
                                    class="btn btn-block btn-outline-dark p-2 m-2 @if($i==0) active @endif btn-date">
                                    @if ($movie->releaseDate > date('Y-m-d'))
                                        {{$date = date('d/m', strtotime('+ '.$i.' day', strtotime($movie->releaseDate)));
                                    }}
                                    @else
                                        {{date('d/m', strtotime('+ '.$i.' day', strtotime(today())))}}
                                    @endif
                            </button>
                        </li>
                    @endfor
                </ul>

                <div id="cityParent">
                    @for ($i = 0; $i <= 7; $i++)
                    <div class="collapse @if($i==0) show @endif" id="schedule_date_{{$i}}" data-bs-parent="#cityParent">
                        <div class="d-flex flex-row mt-4">
                            @foreach($cities as $city)
                            <div class="flex-city p-2 m-1 border-0">
                                <button class="btn @if($loop->first) btn-danger @else btn-outline-dark @endif p-3"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#Theater_{{str_replace(' ', '', $city)}}_date_{{$i}}">{{$city}}
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="mt-4" id="theaterParent">
                    @for ($i = 0; $i <= 7; $i++)
                        @foreach ($cities as $city)
                            <div class="collapse" id="Theater_{{str_replace(' ', '', $city)}}_date_{{$i}}" data-bs-parent="#theaterParent">
                                <ul class="list-group list-group-flush w-100">
                                    @foreach ($theaters as $theater)
                                    @if ($theater->city == $city)
                                    <h4>{!!$theater['name']!!}</h4>
                                    <li class="list-group-item">
                                        <div class="d-flex flex-wrap">
                                            <ul class="list-group  date">
                                                @foreach($roomTypes as $roomType)
                                                    @if($roomType->schedulesByDateAndTheaterAndMovie(date('Y-m-d', strtotime('+ '.$i.' day', strtotime(today()))), $theater->id, $movie->id)->count() > 0) 
                                                        <div class="d-flex flex-column flex-nowrap overflow-auto mb-4">
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
                                                                        <a href="/ticket/{{$schedule->id}}"
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
                                            </ul>
                                        </div>
                                    </li>
                                    @endif
                                        
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    @endfor
                    
                </div>
                
            </div>
        </div>
      </div>
    </div>
</div>