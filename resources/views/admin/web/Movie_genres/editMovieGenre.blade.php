<form action="admin/moviegenre/edit/{{$value->id}}" method="POST">
    @csrf
    <div class="modal fade" id="editMovieGenre{!! $value['id'] !!}" tabindex="-1" aria-labelledby="staff_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rating_title">@lang('lang.movie_genre'): {{$value->name}} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('lang.name')</label>
                                    <input aria-label="" id="fn" class="form-control" type="text" value="{{$value->name}}" name="name"
                                           placeholder="@lang('lang.type') @lang('lang.name')">
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