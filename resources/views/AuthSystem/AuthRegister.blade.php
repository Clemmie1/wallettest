
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Создать учетную запись кошелька</title>


    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#6366f1">
    <link rel="shortcut icon" href="assets/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#080032">
    <meta name="msapplication-config" content="assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" media="screen" href="assets/vendor/boxicons/css/boxicons.min.css"/>
    <link rel="stylesheet" media="screen" href="assets/css/theme.min.css">
    @livewireStyles
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all .4s .2s ease-in-out;
            transition: all .4s .2s ease-in-out;
            background-color: #fff;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }
        .dark-mode .page-loading {
            background-color: #0b0f19;
        }
        .page-loading.active {
            opacity: 1;
            visibility: visible;
        }
        .page-loading-inner {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            text-align: center;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: opacity .2s ease-in-out;
            transition: opacity .2s ease-in-out;
            opacity: 0;
        }
        .page-loading.active > .page-loading-inner {
            opacity: 1;
        }
        .page-loading-inner > span {
            display: block;
            font-size: 1rem;
            font-weight: normal;
            color: #9397ad;
        }
        .dark-mode .page-loading-inner > span {
            color: #fff;
            opacity: .6;
        }
        .page-spinner {
            display: inline-block;
            width: 2.75rem;
            height: 2.75rem;
            margin-bottom: .75rem;
            vertical-align: text-bottom;
            border: .15em solid #b4b7c9;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner .75s linear infinite;
            animation: spinner .75s linear infinite;
        }
        .dark-mode .page-spinner {
            border-color: rgba(255,255,255,.4);
            border-right-color: transparent;
        }
        @-webkit-keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        let mode = window.localStorage.getItem('mode'),
            root = document.getElementsByTagName('html')[0];
        root.classList.add('dark-mode');
    </script>

    <script>
        (function () {
            window.onload = function () {
                const preloader = document.querySelector('.page-loading');
                preloader.classList.remove('active');
                setTimeout(function () {
                    preloader.remove();
                }, 1000);
            };
        })();
    </script>

</head>
<body>

<div class="page-loading active">
    <div class="page-loading-inner">
        <div class="page-spinner"></div>
    </div>
</div>

<main class="page-wrapper">

    <section class="position-relative h-100 pt-5 pb-4">

        <div class="container d-flex flex-wrap justify-content-center justify-content-xl-start h-100 pt-5">
            <div class="w-100 align-self-end pt-1 pt-md-4 pb-4" style="max-width: 526px;">
                <h3 class="text-center text-xl-start">Создать учетную запись кошелька</h3>
                <p class="text-center text-xl-start pb-3 mb-3">У вас уже есть аккаунт? <a href="{{url('/login')}}">Войдите здесь.</a></p>
                @livewire('auth-system.register')
            </div>
            <div class="w-100 align-self-end">
                <p class="nav d-block fs-xs text-center text-xl-start pb-2 mb-0">
                    &copy; Все права защищены
                </p>
            </div>
        </div>

        <!-- Background -->
        <div class="position-absolute top-0 end-0 w-50 h-100 bg-position-center bg-repeat-0 bg-size-cover d-none d-xl-block" style="background-image: url('https://silicon.createx.studio/assets/img/account/signin-bg.jpg');"></div>
    </section>
</main>

@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../assets/vendor/nouislider/dist/nouislider.min.js"></script>
<script src="../assets/vendor/cleave.js/dist/cleave.min.js"></script>
<script src="../assets/vendor/prismjs/components/prism-core.min.js"></script>
<script src="../assets/vendor/prismjs/components/prism-markup.min.js"></script>
<script src="../assets/vendor/prismjs/components/prism-clike.min.js"></script>
<script src="../assets/vendor/prismjs/plugins/toolbar/prism-toolbar.min.js"></script>
<script src="../assets/vendor/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
<script src="../assets/vendor/prismjs/plugins/line-numbers/prism-line-numbers.min.js"></script>

<!-- Main Theme Script -->
<script src="../assets/js/theme.min.js"></script>
</body>
</html>
