<form wire:submit.prevent="register">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-floating mb-4">
                <input class="form-control" name="name" wire:model="name" type="text" id="fl-text" placeholder="Имя" required>
                <label for="fl-text">Имя</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-floating mb-4">
                <input class="form-control" name="surname" wire:model="surname" type="text" id="fl-text" placeholder="Фамилия" required>
                <label for="fl-text">Фамилия</label>
            </div>
        </div>
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
                <input class="form-control" name="email" wire:model="email"  type="email" id="fl-text" placeholder="Почта" required>
                <label for="fl-text">Почта</label>
            </div>
            <div class="form-floating mb-4">
                <input class="form-control" name="pass" wire:model="pass"  type="password" id="fl-text" placeholder="Пароль" required>
                <label for="fl-text">Пароль</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary shadow-primary btn-lg w-100" wire:target="register" wire:loading.remove>Зарегистрироваться</button>
    <button type="button" class="btn btn-primary btn-lg w-100" wire:loading wire:target="register" disabled>
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
        <span class="visually-hidden">Loading...</span>
      </span>
    </button>
</form>
