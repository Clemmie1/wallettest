
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Виртуальные карты</title>


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
        if (mode !== null && mode === 'dark') {
            root.classList.add('dark-mode');
        } else {
            root.classList.remove('dark-mode');
        }
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


<!-- Page loading spinner -->
<div class="page-loading active">
    <div class="page-loading-inner">
        <div class="page-spinner"></div>
    </div>
</div>


<!-- Page wrapper for sticky footer -->
<!-- Wraps everything except footer to push footer to the bottom of the page if there is little content -->
<main class="page-wrapper">


    @include('template/header')
    <section class="container pt-5">
        <div class="row">


            <!-- Sidebar (User info + Account menu) -->
            <aside class="col-lg-3 col-md-4 border-end pb-5 mt-n5">
                <div class="position-sticky top-0">
                    <div class="text-center pt-5">
                        <div class="d-table position-relative mx-auto mt-2 mt-lg-4 pt-5 mb-3">
                            <img src="https://silicon.createx.studio/assets/img/avatar/18.jpg" class="d-block rounded-circle" width="120">
                        </div>
                        <h2 class="h5 mb-1">{{\App\Http\Controllers\MyWalletController::getMyName(session()->get('sessionPhone'))}} {{\App\Http\Controllers\MyWalletController::getMySurname(session()->get('sessionPhone'))}}</h2>
                        <p class="mb-3 pb-3">+{{substr_replace(\App\Http\Controllers\MyWalletController::getMyPhone(session()->get('sessionPhone')), '******', -10, 8)}}</p>
                        <button type="button" class="btn btn-secondary w-100 d-md-none mt-n2 mb-3" data-bs-toggle="collapse" data-bs-target="#account-menu">
                            <i class="bx bxs-user-detail fs-xl me-2"></i>
                            Меню аккаунта
                            <i class="bx bx-chevron-down fs-lg ms-1"></i>
                        </button>
                        <div id="account-menu" class="list-group list-group-flush collapse d-md-block">
                            <a href="{{url('/')}}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bx bx-wallet-alt fs-xl opacity-60 me-2"></i>
                                Мой бумажник
                            </a>
                            <a href="{{url('/payment')}}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="bx bx-time-five fs-xl opacity-60 me-2"></i>
                                История операций
                            </a>
                            <a class="list-group-item list-group-item-action d-flex align-items-center active">
                                <i class="bx bx-credit-card-front fs-xl opacity-60 me-2"></i>
                                Виртуальные карты
                            </a>
                            {{--                            <a href="account-notifications.html" class="list-group-item list-group-item-action d-flex align-items-center">--}}
                            {{--                                <i class="bx bx-bell fs-xl opacity-60 me-2"></i>--}}
                            {{--                                Notifications--}}
                            {{--                            </a>--}}
                            {{--                            <a href="account-messages.html" class="list-group-item list-group-item-action d-flex align-items-center">--}}
                            {{--                                <i class="bx bx-chat fs-xl opacity-60 me-2"></i>--}}
                            {{--                                Messages--}}
                            {{--                            </a>--}}
                            {{--                            <a href="account-saved-items.html" class="list-group-item list-group-item-action d-flex align-items-center">--}}
                            {{--                                <i class="bx bx-bookmark fs-xl opacity-60 me-2"></i>--}}
                            {{--                                Saved Items--}}
                            {{--                            </a>--}}
                            {{--                            <a href="account-collections.html" class="list-group-item list-group-item-action d-flex align-items-center">--}}
                            {{--                                <i class="bx bx-collection fs-xl opacity-60 me-2"></i>--}}
                            {{--                                My Collections--}}
                            {{--                            </a>--}}
                            {{--                            <a href="account-payment.html" class="list-group-item list-group-item-action d-flex align-items-center">--}}
                            {{--                                <i class="bx bx-credit-card-front fs-xl opacity-60 me-2"></i>--}}
                            {{--                                Payment Details--}}
                            {{--                            </a>--}}
                            {{--                            <a href="account-signin.html" class="list-group-item list-group-item-action d-flex align-items-center">--}}
                            {{--                                <i class="bx bx-log-out fs-xl opacity-60 me-2"></i>--}}
                            {{--                                Sign Out--}}
                            {{--                            </a>--}}
                        </div>
                    </div>
                </div>
            </aside>


            <!-- Account details -->
            <div class="col-md-8 offset-lg-1 pb-5 mb-2 mb-lg-4 pt-md-5 mt-n3 mt-md-0">
                <div class="ps-md-3 ps-lg-0 mt-md-2 py-md-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h1 class="h2 pt-xl-1">Виртуальные карты</h1>
                        @if(\App\Http\Controllers\MyWalletController::getCreditCardsList(session()->get('sessionPhone')) != null)
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#CreateCreditCard">СОЗДАТЬ</button>
                        @endif
                    </div>

                    @if(\App\Http\Controllers\MyWalletController::getCreditCardsList(session()->get('sessionPhone')) != null)
                        @foreach(DB::select('SELECT * FROM `creditcards` WHERE `owner_card`='.session()->get('sessionPhone').'  LIMIT 10') as $cards_list)

                            @if($cards_list->closed == 1)
                                <div class="card d-sm-flex flex-sm-row align-items-sm-center justify-content-between border-0 shadow-sm p-3 p-md-4 mb-4">
                                    <div class="d-flex align-items-center pe-sm-3">
                                        <img src="https://silicon.createx.studio/assets/img/account/visa.svg" width="84" alt="Mastercard">
                                        <div class="ps-3 ps-sm-4">
                                            <h6 class="mb-2">{{\App\Http\Controllers\MyWalletController::getCCNumberFormat($cards_list->cardNumber)}}</h6>
                                            <div class="fs-sm">Средства на карте <b>{{$cards_list->balance_kzt}}₸</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end pt-3 pt-sm-0">
                                        <span class="badge bg-danger ms-1">ЗАКРЫТА</span>
                                    </div>
                                </div>
                            @else
                                <div class="card d-sm-flex flex-sm-row align-items-sm-center justify-content-between border-0 shadow-sm p-3 p-md-4 mb-4">
                                    <div class="d-flex align-items-center pe-sm-3">
                                        <img src="https://silicon.createx.studio/assets/img/account/visa.svg" width="84" alt="Mastercard">
                                        <div class="ps-3 ps-sm-4">
                                            <h6 class="mb-2">{{\App\Http\Controllers\MyWalletController::getCCNumberFormat($cards_list->cardNumber)}}</h6>
                                            <div class="fs-sm">Средства на карте <b>{{$cards_list->balance_kzt}}₸</b></div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end pt-3 pt-sm-0">
                                        <button type="button" class="btn btn-outline-secondary px-3 px-xl-4 me-3">
                                            <i class="bx bx-edit fs-xl me-lg-1 me-xl-2"></i>
                                            <span class="d-none d-lg-inline">Реквизиты</span>
                                        </button>
                                        <button class="btn btn-outline-danger btn-icon" type="button">
                                            <i class="bx bx-error-circle"></i>
                                        </button>
                                    </div>
                                </div>

                            @endif

                        @endforeach
                    @else
                        <div class="card border-0 bg-gradient-primary">
                            <div class="card-body p-md-5 p-4 bg-size-cover" style="background-image: url('https://silicon.createx.studio/assets/img/landing/digital-agency/contact-bg.png');">
                                <div class="py-md-5 py-4 text-center">
                                    <p class="display-3 text-light">Виртуальная карта</p>
                                    <div class="pt-md-5 pt-4 pb-md-2">
                                        <button type="button" class="btn btn-lg btn-light" data-bs-toggle="modal" data-bs-target="#CreateCreditCard">СОЗДАТЬ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="sendMoney" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Перевод на Кошелек</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('wallet.modal.send-balance')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CreateCreditCard" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Создать виртуальную карту</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('wallet.modal.credit-card-create')
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
@include('template/footer')

<a href="#top" class="btn-scroll-top" data-scroll>
    <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
</a>

@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="assets/vendor/cleave.js/dist/cleave.min.js"></script>
<script src="assets/js/theme.min.js"></script>
</body>
</html>
