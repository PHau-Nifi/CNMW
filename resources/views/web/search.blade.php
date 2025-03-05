@extends('web.layouts.app');
@section('content')
<section class="container clearfix">
    <div class="product w-100">
        <div class="row d-flex justify-content-center">
            <div class="product-list col-10">
                <h5 class="mb-3"> 
                    @if ($search)
                        @if ($search) 
                            | Tìm kiếm: {{$search}}
                        @endif
                    @else
                        @if ($movieGenres) 
                        | Thể loại:
                        @foreach ($movieGenres as $value)
                            {{$value->name}} 
                        @endforeach
                        @endif
                        @if ($rate!=NULL) 
                            | Xếp hạng: {{$rate->name}} ({{$rate->description}})
                        @endif
                    @endif
                    
                    
                </h5>
                
                <div class="row">
                    @foreach ($result as $movie)
                        <article class="col-md-3 col-sm-4 col-xs-6 thumb grid-item post-38424">
                            <div class="item">
                               <a class="thumb" href="/movie/{{ $movie->id }}" title="{!! $movie['name'] !!}">
                                <figure><img class="lazy img-responsive" 
                                    @if(strstr($movie->image,"https") === false)
                                    src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{{ $movie['image'] }}.jpg"
                                    @else
                                        src="{{$movie['image']}}"
                                    @endif 
                                    alt="" title="{!! $movie['name'] !!}" style="height: 350px"></figure>
                                <span class="status
                                @if($movie->rating->name == 'C18') bg-danger
                                @elseif($movie->rating->name == 'C16') bg-warning
                                @elseif($movie->rating->name == 'P') bg-success
                                @elseif($movie->rating->name == 'K') bg-primary
                                @else bg-info
                                @endif me-1">{!! $movie->rating->name !!}</span>
                                <div class="product-info">
                                    <h2 class="product-name">{!! $movie['name'] !!}</h2>
                                    <div class="movie-info">
                                        <span class="bold">Thể loại: </span>
                                        <span class="normal">
                                            @foreach($movie->movieGenres as $genre)
                                                @if ($loop->first)
                                                    {{$genre->name}}
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
                                        <span class="normal">{!! $movie['releaseDate'] !!}</span>
                                    </div>
                                </div>
                               </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="product-rating col-2 text-end">
                <button class="btn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="fa-solid fa-filter "></i>
                </button>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Bộ lọc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="/movies/filter" method="get">
                    <div class="m-2 form-group mb-3">
                        <label class="form-label" for="movieGenres">Thể loại</label>
                        <select id="movieGenres" class="form-select" name="movieGenres[]" multiple>
                             @foreach ($genres as $genre)
                                 <option value="{{$genre->id}}">{{ $genre->name }}</option>
                             @endforeach
                        </select>
                    </div>
     
                    <div class="m-2 form-group mb-3">
                        <label class="form-label" for="rating ">Giới hạng độ tuổi</label>
                        <select id="rating" class="form-select" name="rating">
                             <option value="">Chọn</option>
                             @foreach ($rating as $rating)
                                 <option value="{{$rating->id}}">{{ $rating->name }}</option>
                             @endforeach
                        </select>
                    </div>
 
                    <button type="submit" class="btn btn-primary m-2 mt-4 w-100">Xác nhận</button>
                </form>
            </div>
        </div>
    
    </div>
</section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $('#rating').select2({
                tags: true
            })

            $('#movieGenres').select2({
                tags: true
            });

            $("#Movies .nav .nav-item .nav-link").on("click", function () {
                $("#Movies .nav-item").find(".active").removeClass("active fw-bold border-bottom border-2 movie-border").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active fw-bold border-bottom border-2 movie-border").removeClass("link-secondary").prop('disabled', true);
            });
        });
    </script>
@endsection