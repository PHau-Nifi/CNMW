
<?php $__env->startSection('content'); ?>
<title>HCinema - Trang chủ</title>
<section class="container clearfix">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo e($i); ?>" class="active" aria-current="true" aria-label="Slide <?php echo e($i+1); ?>"></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="carousel-inner">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->first): ?>
                    <div class="carousel-item active">         
                        <img 
                        <?php if(strstr($banner->image,"https") === false): ?>
                            src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($banner->image); ?>.jpg"
                        <?php else: ?>
                            src="<?php echo e($banner->image); ?>"
                        <?php endif; ?>
                         class="d-block w-100" style="max-height: 550px; object-fit: contain; object-position: 50% 100%" alt="...">
                    </div>
                <?php else: ?>
                    <div class="carousel-item">
                        <img <?php if(strstr($banner->image,"https") === false): ?>
                            src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($banner->image); ?>.jpg"
                        <?php else: ?>
                            src="<?php echo e($banner->image); ?>"
                        <?php endif; ?> 
                    class="d-block w-100" style="max-height: 550px; object-fit: contain; object-position: 50% 100%" alt="...">
                    </div>
                <?php endif; ?>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="main-content">
        <div class="now-showing">
            <h3 class="text-white mb-3">Phim đang chiếu</h3>
            <div class="owl-features owl-carousel">
                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($movie->releaseDate <= date('Y-m-d') && $movie->endDate >= date('Y-m-d')): ?>
                        <div class="item">
                            <div class="thumb">
                                <img 
                                <?php if(strstr($movie->image,"https") === false): ?>
                                    src="https://res.cloudinary.com/<?php echo $cloud_name; ?>/image/upload/<?php echo e($movie->image); ?>.jpg"
                                <?php else: ?>
                                    src="<?php echo e($movie->image); ?>"
                                <?php endif; ?>
                                alt="" style="height: 400px">
                                <div class="hover-effect">
                                    <h6><?php echo $movie['name']; ?></h6>
                                    <a href="/movie/<?php echo e($movie->id); ?>"><button class="button btn-booking"><i class="fa-solid fa-receipt"></i> Xem chi tiết</button></a>
                                </div>
                            </div>
                         </div>
                    <?php endif; ?>
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="mt-5">
                        <h5 class="page-heading">Tin Tức Mới Nhất</h5>
                        <div class="row mt-2 g-2 row-cols-1 row-cols-sm-2 row-cols-md-3 justify-content-start">
                
                                <div class="col">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-lg-4 col-12">
                                <a class="link" href="/news-detail/5">
                                                                        <img style="width: 300px" src="https://www.galaxycine.vn/media/2023/5/17/doraemon-movie-2023-1_1684306892503.jpg" class="img-fluid mt-3 w-100" alt="user1">
                                                                    </a>
                            </div>
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <a href="/news-detail/5" class="link link-dark text-decoration-none">
                                        <h5 class="card-title" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical">
                                            Doraemon Hóa Phi Công Trong Phim Điện Ảnh Mới Nhất</h5>
                                        <p class="card-text text-truncate">'Doraemon: Nobita và vùng đất lý tưởng trên bầu trời' - phần phim điện ảnh mới nhất năm 2023 từng kéo hơn 3,3 triệu khán giả Nhật đến rạp sẽ công chiếu tại Việt Nam từ 26/5/2023.Phần phim mới nhất xoay quanh chuyến phiêu lưu của Doraemon, Nobita và những người bạn thân tới Paradapia - hòn đảo hình trăng lưỡi liềm lơ lửng trên bầu trời. Ở đó, tất cả đều hoàn hảo đến mức cậu nhóc Nobita mê ngủ ngày cũng có thể trở thành một thần đồng toán học, một siêu sao thể thao.Cả hội cùng sử dụng một món bảo bối độc đáo chưa từng xuất hiện để đến với xứ sở tuyệt vời này. Cùng với những người bạn ở đây, đặc biệt là chàng robot mèo Sonya, Doraemon và các chiến hữu đã có chuyến hành trình tới vương quốc trên mây cho đến khi nhiều bí mật đằng sau vùng đất lý tưởng được hé lộ…Doraemon: Nobita và vùng đất lý tưởng trên bầu trời ra mắt tại Nhật Bản hồi tháng 3 vừa qua và nhận được phản ứng vô cùng tích cực. Phim đạt số điểm 3.9/5.0 trên trang đánh giá Eiga.com và 4.1/5.0 trên trang đánh giá Yahoo Movies, lọt top những phần có điểm số cao nhất.&nbsp;Ở tuần thứ 7 sau khi khởi chiếu, Doraemon: Nobita và vùng đất lý tưởng trên bầu trời (Doraemon The Movie: Nobita’s Sky Utopia 2023) đã hút 3,37 triệu lượt khán giả đến rạp tại Nhật Bản, vượt mốc doanh thu 4 tỷ Yên.&nbsp;&nbsp;&nbsp;Khán giả Nhật Bản đánh giá, phần phim thứ 42 của loạt Doraemon có cốt truyện đặc sắc nhất, chạm đến trái tim của không chỉ các bạn nhỏ mà cả người lớn. Cùng với kịch bản được đánh giá cao, phần hình ảnh&nbsp;nhận được rất nhiều lời khen.Nét vẽ của phim trau chuốt, phần chuyển động hoạt hình mượt mà, những góc máy quay mới mẻ đặc tả cảm xúc nhân vật giúp trải nghiệm điện ảnh tại rạp thêm trọn vẹn. Tạo hình siêu đáng yêu của nhóm bạn với bộ đồ phi công, cũng như những biểu cảm dễ thương của Doraemon hứa hẹn gây cơn sốt lớn.&nbsp;&nbsp;Bên cạnh đó, sự tham gia của “quốc bảo ikemen” - nam ca sĩ, diễn viên rất được yêu mến Nagase Ren trong vai trò lồng tiếng cho nhân vật mèo máy Sonya cũng là một điểm khiến người xem cực kỳ phấn khích.&nbsp;</p>
                                        <p class="card-text"><small class="text-muted">29 June 2023</small></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-lg-4 col-12">
                                <a class="link" href="/news-detail/4">
                                    <img style="width: 300px" src="https://www.galaxycine.vn/media/2023/6/8/spider-man-across-the-spider-verse-phim-sieu-anh-hung-xuat-sac-nhat-tu-truoc-den-nay-3_1686212459824.jpg" class="img-fluid mt-3 w-100" alt="user1">
                                </a>
                            </div>
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <a href="/news-detail/4" class="link link-dark text-decoration-none">
                                        <h5 class="card-title" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical">
                                            [Review] Spider-Man Across The Spider-Verse: Phim Siêu Anh Hùng Xuất Sắc Nhất Từ Trước Đến Nay?</h5>
                                        <p class="card-text text-truncate">5 năm trước, cả thế giới chao đảo vì Spider-Man: Into The Spider-Verse phá vỡ mọi giới hạn phim siêu anh hùng. Cậu nhóc Miles Morales đang sống cuộc đời bình thường với vài rắc rối của tuổi dậy thì. Thế nhưng, mọi thứ đổi hoàn toàn khi cậu bị nhện đột biến cắn. Được Người Nhện Peter Parker hi sinh cứu sống, Miles phải thay anh đối đầu gã Kingpin điên cuồng. Khao khát làm vợ con “sống lại”, tên phản diện này quyết tâm xé toạc vũ trụ để “bắt cóc” họ từ dòng thời gian khác… Năm 2023, cùng trở lại thành phố New York - nơi cậu nhóc Miles Morales mười lăm tuổi đang ngày càng thành thạo kĩ năng siêu anh hùng. Tuy nhiên, tương tự những Người Nhện khác, càng nhiều người được cứu, cậu càng tạo ra vô số kẻ thù. Liệu cậu có thể thay đổi số mệnh của mình? Dù thay đổi ít nhiều ghế đạo diễn và biên kịch, Across The Spider-Verse vẫn thống nhất về cốt truyện Into The Spider-Verse. Tâm lý nhân vật chính - Miles và Gwen đến vai phụ - Peter Parker hay bố mẹ Miles đều được xây dựng hợp lí và liền mạch với phần trước. Độ dài 140 phút cũng đủ giúp Across The Spider-Verse tô da đắp thịt cho những cái tên mới xuất hiện - Hobie Brown hay Miguel O’Hara. “Làm Spider-Man là một sự hi sinh.”, “Sức mạnh càng lớn, trách nhiệm càng nhiều.”… Số mệnh định sẵn muốn trở thành Người Nhện là PHẢI mất mát. Thế nhưng, cậu nhóc Miles Morales còn quá nhỏ để thấu hiểu Miguel O'Hara.</p>
                                        <p class="card-text"><small class="text-muted">29 June 2023</small></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-lg-4 col-12">
                                <a class="link" href="/news-detail/3">
                                    <img style="width: 300px" src="https://www.galaxycine.vn/media/2023/6/16/the-flash-ezra-miller-dien-xuat-sac-lam-lu-mo-loat-scandal-chan-dong-4_1686932681045.jpg" class="img-fluid mt-3 w-100" alt="user1">
                                </a>
                            </div>
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <a href="/news-detail/3" class="link link-dark text-decoration-none">
                                        <h5 class="card-title" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical">
                                            [Review] The Flash: Ezra Miller Diễn Xuất Sắc Làm Lu Mờ Loạt Scandal Chấn Động!</h5>
                                        <p class="card-text text-truncate">Trong The Flash, Ezra Miller thành công hóa thân thành hai Barry Allen rất khác biệt. Barry lớn mất mẹ xa cha, thiếu thốn tình cảm, sống khép kín và đầy tài năng. Barry nhỏ lớn lên giữa tình yêu thương, đang ở giai đoạn nổi loạn tuổi mới lớn, bạn bè vây quanh. Khán giả khó lòng cảm thấy một người đang đảm nhận hai vai. Điều đó không phải diễn viên trẻ nào cũng làm nổi, nhất là khi Barry lớn - nhỏ đi chung quá nhiều. Người bình thường và chẳng hề có năng lực đặc biệt ngoài tiền đầy kho, Batman luôn là nhân vật  cộng đồng fan DC yêu thích nhất nhì. Lần này, “Batman” Ben Affleck chỉ lên hình ít ỏi nhưng gây ấn tượng mạnh mẽ nhờ phong thái chững chạc. Mặt khác, đất diễn quan trọng trong phim được trao về ngài Batman từng làm nức lòng khán giả cuối thế kỉ 20 – Michael Keaton. Điềm tĩnh, phong độ, oai vệ… “Batman” Keaton mang đến cảm giác khác biệt rõ rệt so với Christian Bale, Ben Affleck hay Robert Pattinson. Cao 1m7, gương mặt cá tính, thân hình tuyệt đẹp… Xuất hiện không nhiều, Sasha Calle hút hồn bởi hình ảnh Supergirl cá tính, cứng rắn nhưng tốt bụng. Hy vọng rằng dù DC Comic và Warner Bros thay máu toàn bộ, Calle vẫn nằm trong danh sách chọn lựa thể hiện Supergirl. Andy Muschietti đâu phải cái tên xa lạ gì với mọt phim. Mama (2013), It (2017), It: Chapter Two (2019) đều là tác phẩm thành công và nhận đánh giá khá tốt từ giới chuyên môn. Lần đầu bước qua mảng siêu anh hùng,
         vị đạo diễn sinh năm 1973 chẳng hề bỡ ngỡ. Nhịp phim nhanh gọn, đôi chỗ dài dòng nhưng mang mục đích đào sâu hơn về nội tâm nhân vật, tình tiết hài xen kẽ hợp lý. Những màn xáp lá cà, đua tốc độ dàn trải suốt phim, khiến người xem khó thể rời mắt khỏi màn hình. Đặc biệt, tài năng của Muschietti kết hợp cùng diễn xuất tuyệt vời của Miller làm nên khung hình Flash vs Flash vô cùng sinh động, khó phim siêu anh hùng nào sánh được. Ngoài phân đoạn tri ân loạt tên tuổi lừng danh đã từng gắn bó với các chuyển thể siêu anh hùng DC lên màn ảnh rộng cũng khiến công chúng vô cùng xúc động, phim còn có một cameo bất ngờ.   Sự xuất sắc của The Flash là dấu chấm hết đẹp cho 10 năm DCEU, hãy cùng chờ xem tân chủ tịch James Gunn  sẽ khởi động lại vũ trụ điện ảnh hoành tráng này như thế nào!</p>
                                        <p class="card-text"><small class="text-muted">29 June 2023</small></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            </div>
                        <div class="row m-2 mb-5 justify-content-end">
                <a href="/news" class="btn btn-outline-warning w-auto">Xem Thêm &gt;</a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\LVTN\QLRapPhim\resources\views/web/home.blade.php ENDPATH**/ ?>