<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ url('assets/web') }}/images/icone.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css"
        integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="{{ url('assets/web') }}/css/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ url('assets/web') }}/css/owl.theme.default.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/prettyPhoto.css">
    <link href="{{ url('assets/web') }}/css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/web') }}/css/main.css">
    @if(session()->has('error') || session()->has('success'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">
    @endif
    <title>تطبيق {{ env('APP_NAME') }}</title>
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-sticky">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}" title=""><img src="{{ url('assets/web') }}/images/logo.png"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto p-0 main">
                        <li class="nav-item current">
                            <a class="nav-link" href="{{url('/')}}#home">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}#about">من نحن</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}#screens">واجهة التطبيق</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}#newsletter">النشرة البريدية</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="about" class="section pb-0" style="min-height:400px">
        <div class="container">
            <h2 class="section-title">{{ $page->title }}</h2>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="text-block">
                        <p>{!! $page->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer>
        <div class="footer-top">
            <div class="container wow fadeIn" data-wow-delay="1s">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <a href="#"><img src="{{ url('assets/web') }}/images/logo.png" alt=""></a>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav footer-nav p-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#home">الرئيسية</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">من نحن</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#screens">واجهة التطبيق</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#newsletter">النشرة البريدية</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 text-center text-sm-left">
                        <ul class="list-unstyled mb-0 mt-sm-0 mt-4 p-0 footer-social">
                            <li class="d-inline-block"><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li class="d-inline-block"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="d-inline-block"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container wow fadeIn" data-wow-delay="1s">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-white text-sm-right text-center mb-0">جميع الحقوق محفوظة لتطبيق <a
                                href="#">سيارتي</a> &copy;2020</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-white text-sm-left text-center mb-0">تصميم وتطوير <a href="#">سبارك كلاود</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
