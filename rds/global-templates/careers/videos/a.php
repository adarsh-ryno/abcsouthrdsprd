<?php 
$youtubeItems = $args['page_templates']['career_page']['video']['items']; 
$videoCount = count($youtubeItems);
?>

<div class="row">
    <div class="col-lg-12">
        <h4 class="text-center pt-lg-2"><?php echo $args['page_templates']['career_page']['video']['heading'];?></h4>
        
        <?php if ($videoCount == 1): ?>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 mb-md-5 mb-sm-5 mb-3">
                    <div class="single-video text-center iframe_width">
                        <iframe class="responsive-iframe yt-video" width="100%" height="305" src="<?php echo $youtubeItems[0]['video_url']; ?>" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        <?php elseif ($videoCount == 2): ?>
            <div class="swiper video-swipernew py-md-5 py-lg-2 mb-lg-0 mb-5 mb-md-0 pt-3 pt-lg-3 pt-md-0">
                <div class="swiper-wrapper py-md-5 py-lg-4 mb-lg-0 mb-5 mb-md-0">
                    <?php foreach ($youtubeItems as $value): ?>
                        <div class="col-lg-6 swiper-slide iframe_width">
                            <iframe class="responsive-iframe yt-video" width="100%" height="305" src="<?php echo $value['video_url']; ?>" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination career-video-pagination pagination-variation-a position-relative pb-lg-3 d-lg-none mt-5"></div>
                <div class="swiper-button-prev video_prev text_36 line_height_36 d-md-none d-block"><i class="icon-chevron-left1 true_black d-md-block d-block"></i></div>
                <div class="swiper-button-next video_next text_36 line_height_36 d-md-none d-block"><i class="icon-chevron-right1 true_black d-md-block d-block"></i></div>
            </div>
        <?php else: ?>
            <div class="swiper video-swiper py-md-5 py-lg-2 mb-lg-0 mb-5 mb-md-0 pt-3 pt-lg-3 pt-md-0">
                <div class="swiper-wrapper py-md-5 py-lg-4 mb-lg-0 mb-5 mb-md-0">
                    <?php foreach ($youtubeItems as $value): ?>
                        <div class="swiper-slide iframe_width">
                            <iframe class="responsive-iframe yt-video" width="100%" height="205" src="<?php echo $value['video_url']; ?>" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination career-video-pagination pagination-variation-a position-relative pb-lg-3 d-lg-none mt-5"></div>
                <div class="swiper-button-prev video_prev text_36 line_height_36 d-md-block d-block"><i class="icon-chevron-left1 true_black d-md-block d-block"></i></div>
                <div class="swiper-button-next video_next text_36 line_height_36 d-md-block d-block"><i class="icon-chevron-right1 true_black d-md-block d-block"></i></div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php 
if(is_admin()){?> 
<script>
        var videoCount = <?php echo $videoCount; ?>;
        var players = [];
        var videoSwiper, videoSwiper2; // Declare the swiper variables here
    
            if (videoCount >= 3) {
                videoSwiper = new Swiper('.video-swiper', {
                    slidesPerView: 1,
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    centeredSlides: true,
                    pagination: {
                        el: '.career-video-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1
                        },
                        768: {
                            slidesPerView: 3
                        }
                    }
                });
                function onYouTubeIframeAPIReady() {
            document.querySelectorAll('.video-swiper iframe').forEach(function (iframe) {
                var player = new YT.Player(iframe, {
                    events: {
                        'onStateChange': function(event) {
                            if (event.data === YT.PlayerState.PLAYING) {
                                if (videoCount >= 3 && videoSwiper) {
                                    videoSwiper.autoplay.stop();
                                } else if (videoCount == 2 && videoSwiper2) {
                                    videoSwiper2.autoplay.stop();
                                }
                            }
                        }
                    }
                });
                players.push(player);
            });
        }
                videoSwiper.on('slideChange', function () {
                    players.forEach(function(player) {
                        player.pauseVideo();
                    });
                });
            } else if (videoCount == 2) {
                videoSwiper2 = new Swiper('.video-swipernew', {
                    slidesPerView: 1,
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.career-video-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 1
                        },
                        768: {
                            slidesPerView: 2,
                            loop: false,
                            spaceBetween: 30,
                            noSwiping: true,
                            allowSlidePrev: false,
                            allowSlideNext: false,
                        }
                    }
                });
    
                videoSwiper2.on('slideChange', function () {
                    players.forEach(function(player) {
                        player.pauseVideo();
                    });
                });
            }
        
    
        
    
        
    </script>
    <script src="https://www.youtube.com/iframe_api"></script>
<?php 
} else {
?> 
<?php if ($videoCount >= 2): ?>
    
    <script>
// 100% Working Solution - Slider stops when any video plays
document.addEventListener('DOMContentLoaded', function() {
    var videoCount = <?php echo $videoCount; ?>;
    var currentSwiper = null;
    var videoPlaying = false;
    
    // Initialize the correct swiper
    function initSwiper() {
        if (videoCount >= 3) {
            currentSwiper = new Swiper('.video-swiper', {
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                centeredSlides: true,
                pagination: {
                    el: '.career-video-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 3
                    }
                }
            });
        } 
        else if (videoCount == 2) {
            currentSwiper = new Swiper('.video-swipernew', {
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                pagination: {
                    el: '.career-video-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 2,
                        loop: false,
                        spaceBetween: 30,
                        noSwiping: true,
                        allowSlidePrev: false,
                        allowSlideNext: false,
                    }
                }
            });
        }
        
        // Pause videos when slide changes
        if (currentSwiper) {
            currentSwiper.on('slideChange', function() {
                pauseAllVideos();
            });
        }
    }

    // Pause all videos
    function pauseAllVideos() {
        document.querySelectorAll('.yt-video').forEach(function(iframe) {
            try {
                iframe.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
            } catch(e) {
                console.error('Error pausing video:', e);
            }
        });
        videoPlaying = false;
        startAutoplay();
    }

    // Start autoplay if no videos are playing
    function startAutoplay() {
        if (!videoPlaying && currentSwiper) {
            currentSwiper.autoplay.start();
        }
    }

    // Stop autoplay when video plays
    function stopAutoplay() {
        if (currentSwiper) {
            currentSwiper.autoplay.stop();
        }
    }

    // Initialize swiper
    initSwiper();

    // Listen for play events from iframes
    window.addEventListener('message', function(event) {
        try {
            // Check if message is from YouTube player
            if (event.origin.includes('youtube.com') || 
                event.origin.includes('youtu.be')) {
                
                var data = JSON.parse(event.data);
                
                // Video started playing
                if (data.info === 'playing' || 
                    (data.event === 'infoDelivery' && data.info.currentTime > 0)) {
                    videoPlaying = true;
                    stopAutoplay();
                }
                // Video paused or ended
                else if (data.info === 'paused' || 
                         data.info === 'ended' ||
                         data.event === 'onPause') {
                    videoPlaying = false;
                    startAutoplay();
                }
            }
        } catch(e) {
            // Not a YouTube message we care about
        }
    });

    // Alternative method to detect video play
    document.querySelectorAll('.yt-video').forEach(function(iframe) {
        iframe.addEventListener('load', function() {
            // Listen for play events
            this.contentWindow.postMessage('{"event":"listening","id":"'+this.id+'"}', '*');
        });
    });

    // Load YouTube API if not already loaded
    if (typeof YT === 'undefined') {
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
});
</script>
<?php endif; ?>

<?php } ?>