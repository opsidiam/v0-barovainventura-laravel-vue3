@extends('layouts.app')

@section('css')
    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            margin-bottom: 15px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .video-container video,
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        .video-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            border: 1px solid #eaeaea;
        }
        .video-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }
        .video-header {
            padding: 20px 20px 15px;
            border-bottom: 1px solid #f0f0f0;
            background-color: #f9f9f9;
            border-radius: 8px 8px 0 0;
        }
        .video-content {
            padding: 0 20px 20px;
        }
        .video-title {
            color: #172651;
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }
        .video-description {
            color: #666;
            font-size: 14px;
            margin-top: 8px;
        }
        .video-fallback {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }
        .video-fallback a {
            color: #172651;
            text-decoration: underline;
            margin-top: 10px;
        }
        .section-title {
            margin-bottom: 40px;
        }
    </style>
@endsection

@section('content')
    <div class="page-header" data-parallax="true" style="background-image: url({{asset('web/assets/img/sidebar_img.jpg')}}); height: 30vh;">
    </div>
    <div class="main main-raised">
        <div class="space-medium">
            <div class="container" style="padding-bottom: 3rem">
                <div class="row">
                    <div class="offset-xl-2 col-xl-8 offset-lg-2 col-lg-8 col-md-12 col-sm-12 col-12 text-center">
                        <!-- section-title -->
                        <div class="section-title">
                            <h2>Návody</h2>
                            <p>Na tejto stránke nájdete všetky návody na obsluhu aplikácie a zariadení. V prípade, ak vám chýba nejaký návod, kontaktujte nás na adrese: info@barovainventura.sk alebo na stránke podpory.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Video 1 -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="video-card">
                            <div class="video-header">
                                <h3 class="video-title">Inštalácia aplikácie</h3>
                                <p class="video-description">Podrobný návod na inštaláciu desktopovej aplikácie</p>
                            </div>
                            <div class="video-content">
                                <div class="video-container">
                                    <video width="100%" height="100%" controls playsinline>
                                        <source src="{{asset('web/video/t_instalacia.mp4')}}" type="video/mp4">
                                        <div class="video-fallback">
                                            <p>Váš prehliadač nepodporuje prehrávanie videa.</p>
                                            <a href="{{asset('web/video/t_instalacia.mp4')}}" download>Stiahnuť video</a>
                                        </div>
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="video-card">
                            <div class="video-header">
                                <h3 class="video-title">Prihlásenie do aplikácie</h3>
                                <p class="video-description">Ako sa prihlásiť do aplikácie po inštalácii</p>
                            </div>
                            <div class="video-content">
                                <div class="video-container">
                                    <video width="100%" height="100%" controls playsinline>
                                        <source src="{{asset('web/video/t_prihlasenie.mp4')}}" type="video/mp4">
                                        <div class="video-fallback">
                                            <p>Váš prehliadač nepodporuje prehrávanie videa.</p>
                                            <a href="{{asset('web/video/t_prihlasenie.mp4')}}" download>Stiahnuť video</a>
                                        </div>
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="video-card">
                            <div class="video-header">
                                <h3 class="video-title">Kalibrácia váhy</h3>
                                <p class="video-description">Návod na správnu kalibráciu pripojenej váhy</p>
                            </div>
                            <div class="video-content">
                                <div class="video-container">
                                    <video width="100%" height="100%" controls playsinline>
                                        <source src="{{asset('web/video/t_kalibracia.mp4')}}" type="video/mp4">
                                        <div class="video-fallback">
                                            <p>Váš prehliadač nepodporuje prehrávanie videa.</p>
                                            <a href="{{asset('web/video/t_kalibracia.mp4')}}" download>Stiahnuť video</a>
                                        </div>
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const videos = document.querySelectorAll('video');

            videos.forEach(video => {
                video.addEventListener('error', function() {
                    const sources = video.querySelectorAll('source');
                    let canPlay = false;

                    sources.forEach(source => {
                        if (video.canPlayType(source.type)) {
                            canPlay = true;
                        }
                    });

                    if (!canPlay) {
                        const fallback = video.querySelector('.video-fallback');
                        if (fallback) {
                            fallback.style.display = 'flex';
                        }
                    }
                });
            });
        });
    </script>
@endsection
