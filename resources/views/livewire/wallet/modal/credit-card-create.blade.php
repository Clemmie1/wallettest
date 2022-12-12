<form wire:submit.prevent="createCreditCard">



    <div wire:target="createCreditCard" wire:loading.remove>
        <p class="text-center">После создание проверьте вашу почту</p>
        <button type="submit" class="btn btn-primary w-100">СОЗДАТЬ</button>
    </div>


    <div class="text-center" wire:loading wire:target="createCreditCard">
        <br>
        <div class="spinner-grow text-primary" style="width: 3.5rem; height: 3.5rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <br>
        <p class="mt-5">Виртуальная карта создаётся. Пожалуйста, подождите.</p>
    </div>



</form>
