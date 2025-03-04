<form action="admin/banners/edit/{!! $value['id'] !!}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="editBanner{!! $value['id'] !!}" tabindex="-1" aria-labelledby="banner_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banner_title">{!! $value['name'] !!}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group file-uploader">
                                    <label for="example-text-input" class="form-control-label">@lang('lang.image')</label>
                                    <input type='file' name='Image' class="form-control image-director">
                                
                                    @if(strstr($value->image,"https") === false)
                                        <img class="img-fluid rounded-start img_direc" style="width: 300px" src="https://res.cloudinary.com/{!! $cloud_name !!}/image/upload/{{ $value->image }}.jpg" alt="">
                                    @else
                                        <img class="img-fluid rounded-start img_direc" style="width: 300px" src="{{ $value->image }}" alt="">
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>

            </div>
        </div>
    </div>
</form>    