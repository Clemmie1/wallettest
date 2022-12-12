<form wire:submit.prevent="login">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="mb-4">
                <div class="input-group">
                      <span class="input-group-text px-2">
                        <b>+7</b>
                      </span>
                    <input class="form-control form-control-lg" type="number" id="validationCustom05" name="phone" wire:model="phone" required>
                </div>
            </div>
            <div class="form-floating mb-4">
                <input class="form-control" name="pass" wire:model="pass" type="password"  placeholder="Пароль" required>
                <label for="fl-text">Пароль</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary shadow-primary btn-lg w-100" wire:target="login" wire:loading.remove>Войти</button>
    <button type="button" class="btn btn-primary btn-lg w-100" wire:loading wire:target="login" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
            <span class="visually-hidden">Loading...</span>
          </span>
    </button>
</form>
