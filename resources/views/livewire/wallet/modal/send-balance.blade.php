<form wire:submit.prevent="sendBalance">

    <div wire:target="sendBalance" wire:loading.remove>
        <div class="mb-4">
            <div class="input-group">
                      <span class="input-group-text px-2">
                        <b>+7</b>
                      </span>
                <input class="form-control form-control-lg" type="number" id="validationCustom05" name="phone" wire:model="phone" required>
            </div>
        </div>
        <div class="form-floating mb-4">
            <input class="form-control" name="sum" wire:model="sum" type="number" placeholder="Сумма" required>
            <label for="fl-text">Сумма</label>
        </div>
        <div class="form-floating mb-4">
            <select class="form-select" id="fl-select">
                <option>Основной</option>
            </select>
            <label for="fl-select">Перевод из</label>
        </div>
        <div class="form-floating mb-4">
            <select class="form-select" id="fl-select" wire:model="WalletTypeSend">
                <option value="KZT">KZT</option>
                <option value="RUB">RUB</option>
                <option value="USD">USD</option>
            </select>
            <label for="fl-select">Счет кошелька</label>
        </div>
        <br>
        <button type="submit" class="btn btn-primary w-100">ОПЛАТИТЬ</button>
    </div>


    <div wire:loading wire:target="sendBalance">
        <div class="spinner-grow text-center" style="width: 3.5rem; height: 3.5rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>



</form>
