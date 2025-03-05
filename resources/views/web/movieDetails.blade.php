@extends('web.layouts.app')
@section('content')
<section class="container clearfix">
    <nav aria-label="breadcrumb mt-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="link link-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
            <li class="breadcrumb-item"><a href="/movies" class="link link-dark text-decoration-none">
            @if ($movie['releaseDate'] > date('Y-m-d'))
                Phim sắp chiếu
            @else
                Phim đang chiếu
            @endif
                </a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$movie->name}}</li>
        </ol>
    </nav>
    <div class="movieDetails mt-5">
        <h3 class="mb-3 pb-3 border-bottom border-3">Nội dung phim</h3>
        <div class="row">
            <div class="col-2">
                <img class="lazy img-responsive" 
                    @if(strstr($movie->image,"https") === false)
                        src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{{ $movie->image }}.jpg"
                    @else
                        src="{{$movie->image}}"
                    @endif 
                    alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN">
            </div>
            <div class="col">
                <h4 class="pb-3 border-bottom">{!!$movie['name']!!}</h4>
                <div class="mt-3">
                    <div class="product-info">
                        <div class="movie-info">
                            <span class="bold">Đạo diễn: </span>
                            <span class="normal">{!!$movie['director']!!}</span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Diễn viên: </span>
                            <span class="normal">{!!$movie['cast']!!}</span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Thể loại: </span>
                            <span class="normal">
                            @foreach($movie->movieGenres as $genre)
                                @if ($loop->first)
                                    {{ $genre->name }}
                                @else
                                    , {{ $genre->name }}
                                @endif
                            @endforeach
                            </span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Thời lượng: </span>
                            <span class="normal">{!!$movie['showTime']!!}</span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Khởi chiếu: </span>
                            <span class="normal">{!!$movie['releaseDate']!!}</span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Quốc gia: </span>
                            <span class="normal">{!!$movie['nation']!!}</span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Rate: </span>
                            <span class="normal">
                                {{ $movie->rating->name }}
                            </span>
                            - {{ $movie->rating->description }}
                        </div>
                        @if ($movie['releaseDate'] > date('Y-m-d'))
                           
                        @else
                            <ul>
                                <li class="booking mt-3">
                                    <button class="btn btn-booking" data-bs-toggle="modal" data-bs-target="#datve"><i class="fa-solid fa-receipt"></i> Đặt vé</button>
                                </li>
                            </ul>
                        @endif
                        
                    </div>
                </div>
            </div>
            @include('web.movieDetailSchedules')
{{-- Detail --}}
            <div id="Detail" class="mt-3">
                <ul class="nav justify-content-center mb-4 align-items-center m-auto">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold border-bottom detail"
                                aria-expanded="true"
                                data-bs-toggle="collapse"
                                data-bs-target="#chitiet" disabled>
                            Chi tiết
                        </button>
                    </li>
                    <li class="vr mx-5"></li>
                    <li class="nav-item">
                        <button class="nav-link link-secondary trailer"
                                aria-expanded="false"
                                data-bs-toggle="collapse" data-bs-target="#trailer">
                                Trailer
                        </button>
                    </li>
                </ul>
                <div id="chitiet" class="row g-4 mt-2 collapse show" data-bs-parent="#Detail">
                    <div class="movie-info">
                        <span class="bold">Nội dung: </span>
                        <span class="normal">{!!$movie['description']!!}</span>
                    </div>
                </div>
                <div id="trailer" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse justify-content-center" data-bs-parent="#Detail">
                    <iframe width="560" height="315" src="{!!$movie['trailer']!!}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#cityParent .d-flex .flex-city .btn").on("click", function () {
                $("#cityParent .flex-city").find(".btn").removeClass("btn-danger").addClass("btn-outline-dark").prop('disabled', false);
                $(this).addClass("btn-danger").removeClass("btn-outline-dark").prop('disabled', true);
        });
        $(".listDate button").on('click', function () {
                $(".listDate").find(".btn").removeClass('active');
                $(this).addClass("active");
        })

        $('.detail').click(function() {
            $(this).removeClass('link-secondary').addClass('active fw-bold border-bottom').attr('disabled', true);
            $('.trailer').removeClass('active fw-bold border-bottom').addClass('link-secondary').attr('disabled', false);
        });

        $('.trailer').click(function() {
            $(this).removeClass('link-secondary').addClass('active fw-bold border-bottom').attr('disabled', true);
            $('.detail').removeClass('active fw-bold border-bottom').addClass('link-secondary').attr('disabled', false);
        });
    });
</script>    
@endsection