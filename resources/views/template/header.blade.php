<header class="header navbar navbar-expand-lg bg-light border-bottom border-light shadow-sm fixed-top">
    <div class="container px-3">
        <a href="{{url('/')}}" class="navbar-brand pe-3">
            WALLET LITE
        </a>
        <div id="navbarNav" class="offcanvas offcanvas-end">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title">Меню</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-header border-top">
                <a href="{{url('/logout')}}" class="btn btn-primary w-100">
                    &nbsp;ВЫЙТИ
                </a>
            </div>
        </div>
        <div class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4" data-bs-toggle="mode">
            <input type="checkbox" class="form-check-input" id="theme-mode">
        </div>
        <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="{{url('/logout')}}" class="btn btn-primary btn-sm fs-sm rounded d-none d-lg-inline-flex">
            ВЫЙТИ
        </a>
    </div>
</header>
