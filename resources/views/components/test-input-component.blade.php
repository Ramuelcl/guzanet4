<div>

    <form action="" wire:submit.prevent="">
        <x-forms.input idName="campo1" :icono="['at-symbol', 'mail']" placeholder="Nombre" />
        <x-forms.input idName="campo2" label="Nombre" placeholder="ingrese Nombre" />
        <x-forms.input-password idName="campo3" placeholder="password" :icono="['eye', 'eyeSlash']" />

    </form>
</div>