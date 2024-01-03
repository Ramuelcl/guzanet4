<x-layouts.layout01 titulo="- Contactez nous">
    <x-slot name="header">
        {{ __('Contactez nous') }}
    </x-slot>

    <div class="mx-auto py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded">
                <h1>Déjanos un mensaje</h1>
                <form action="{{ route('contacto.enviar') }}" method="post">
                    @csrf
                    <fieldset>
                        <label class="form-label" for="name">* Nombre:
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="ingrese nombre" tabindex="1" autofocus>
                        </label>
                        @error('name')
                        <small>{{ $message }}</small>
                        @enderror

                        <br><br>
                        <label class="form-label" for="email">* eMail:
                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" tabindex="2" autofocus placeholder="ingrese su eMail">
                        </label>
                        @error('email')
                        <small>{{ $message }}</small>
                        @enderror

                        <br><br>
                        <label class="form-label" for="messagge">* Mensaje:
                            <textarea name="messagge" id="messagge" row="5" tabindex="3" autofocus placeholder="ingrese su mensaje"></textarea>
                        </label>
                        @error('messagge')
                        <small>{{ $message }}</small>
                        @enderror

                        <br><br>
                        <p>* : champ required</p>
                        <div class="mb-3">
                            <button class="btn btn-green" type="submit">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</x-layouts.layout01>