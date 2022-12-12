<div class="card d-sm-flex flex-sm-row align-items-sm-center justify-content-between border-0 shadow-sm p-3 p-md-4 mb-4">
    <div class="d-flex align-items-center pe-sm-3">
        <img src="https://silicon.createx.studio/assets/img/account/visa.svg" width="84" alt="Mastercard">
        <div class="ps-3 ps-sm-4">
            <h6 class="mb-2">**** **** **** 4298</h6>
            <div class="fs-sm">Средства на карте <b>{{$player->balance_kzt}}₸</b></div>
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
