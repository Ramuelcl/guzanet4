<x-layouts.layout01 titulo="- Acerca de">
    {{-- resources/views/components/principal/acercade.blade.php --}}
    <x-slot name="sub-header">
        {{ __('Acerca de') }}
    </x-slot>
    <div class="mx-auto py-12">
        <h1>Acerca de... probar componentes</h1>
        <hr>
        <form wire:submit.prevent="submitForm">
            <div class="container mx-auto mt-8">

                <x-input label="Name" placeholder="your name" class="pl-40">
                    <x-slot name="prepend">
                        <div class="absolute inset-y-0 left-0 flex items-center px-2 bg-gray-100 w-36">
                            Nombre
                        </div>
                    </x-slot>
                </x-input>

                <x-input wire:model="firstName" label="Name" placeholder="User's first name" />

                <x-inputs.password label="Secret 🙈" value="I love WireUI ❤️" />
                <div class="container">
                    <x-inputs.number label="How many Burgers?" />

                    <x-textarea label="Annotations" placeholder="write your annotations" />
                </div>

                <div class="flex flex-wrap">
                    <x-native-select label="Select Status" wire:model="model" class="w-36 mr-5">
                        <option>Active</option>
                        <option>Pending</option>
                        <option>Stuck</option>
                        <option>Done</option>
                    </x-native-select>
                    <x-native-select label="Select Status" :options="[
                        ['name' => 'Active',  'id' => 1],
                        ['name' => 'Pending', 'id' => 2],
                        ['name' => 'Stuck',   'id' => 3],
                        ['name' => 'Done',    'id' => 4],
                        ]" option-label="name" option-value="id" wire:model="model" class="w-36" />



                    <x-card title="Titulo de la ventana">

                        <x-slot name="action">
                            <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
                                <x-icon name="home" class="w-4 h-4 text-gray-500" />
                            </button>
                        </x-slot>

                        Contenido
                        <x-color-picker label="Select a Color" placeholder="Select the car color" />

                        <x-color-picker label="Seleccione Color" placeholder="Seleccione color del marcador" :colors="[
        '#FFF',
        '#000',
        '#14b8a6',
        '#64748b',
        '#ef4444',
        '#a3e635',
        '#38bdf8',
        '#8b5cf6',
        '#8b5cf6',
        '#6366f1',
    ]" />

                        <x-slot name=" footer">
                            <div class="flex justify-between items-center">
                                <x-button label="Delete" flat negative />
                                <x-button label="Save" primary />
                            </div>
                        </x-slot>
                    </x-card>

                    <x-toggle left-label="Label in Left" wire:model.defer="model" />
                    <x-toggle label="Label in Right" wire:model.defer="model" />

                    <x-checkbox id="left-label" left-label="Label in Left" wire:model.defer="model" />
                    <x-checkbox id="right-label" label="Label in Right" wire:model.defer="model" />

                    <x-radio id="left-label" left-label="Label in Left" wire:model.defer="model" />
                    <x-radio id="right-label" label="Label in Right" wire:model.defer="model" />

                    <x-card class="flex flex-grow">
                        <div class="w-36">
                            <x-datetime-picker label="Fecha-hora desde:" without-time placeholder="Fecha" display-format="DD-MM-YYYY" wire:model.defer="displayFormat" />
                        </div>
                        <x-avatar />
                        <x-avatar xs src="https://picsum.photos/300?size=xs" />
                        <x-avatar sm squared src="https://picsum.photos/300?size=sm" />
                        <x-avatar md src="" label="Maria" />
                        <x-avatar lg squared src="https://picsum.photos/300?size=lg" />
                        <x-avatar xl src="https://picsum.photos/300?size=xl" />

                        <x-dropdown>
                            <x-dropdown.header label="Settings">
                                <x-dropdown.item icon="cog" label="Preferences" />
                                <x-dropdown.item icon="user" label="My Profile" />
                            </x-dropdown.header>

                            <x-dropdown.item separator label="Help Center" />
                            <x-dropdown.item label="Live Chat" />
                            <x-dropdown.item label="Logout" />
                        </x-dropdown>
                    </x-card>


                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <x-button label="Default" />
                            <x-button primary label="Primary" />
                            <x-button secondary label="Secondary" />
                            <x-button positive label="Positive" />
                            <x-button negative label="Negative" />
                            <x-button warning label="Warning" />
                            <x-button info label="Info" />
                            <x-button dark label="Dark" />
                            <x-button white label="White" />
                            <x-button black label="Black" />
                            <x-button slate label="Slate" />
                            <x-button gray label="Gray" />
                            <x-button zinc label="Zinc" />
                            <x-button neutral label="Neutral" />
                            <x-button stone label="Stone" />
                            <x-button red label="Red" />
                            <x-button orange label="Orange" />
                            <x-button amber label="Amber" />
                            <x-button lime label="Lime" />
                            <x-button green label="Green" />
                            <x-button emerald label="Emerald" />
                            <x-button teal label="Teal" />
                            <x-button cyan label="Cyan" />
                            <x-button sky label="Sky" />
                            <x-button blue label="Blue" />
                            <x-button indigo label="Indigo" />
                            <x-button violet label="Violet" />
                            <x-button purple label="Purple" />
                            <x-button fuchsia label="Fuchsia" />
                            <x-button pink label="Pink" />
                            <x-button rose label="Rose" />
                        </div>
                        <div>
                            <x-badge rounded label="No Color" />
                            <x-badge rounded primary label="Primary" />
                            <x-badge rounded secondary label="Secondary" />
                            <x-badge rounded positive label="Positive" />
                            <x-badge rounded negative label="Negative" />
                            <x-badge rounded warning label="Warning" />
                            <x-badge rounded info label="Info" />
                            <x-badge rounded dark label="Dark" />
                        </div>
                        <div>
                            <x-badge icon="home" label="Default" />
                            <x-badge icon="pencil" primary label="Primary" />
                            <x-badge icon="clipboard-list" secondary label="Secondary" />
                            <x-badge icon="check" positive label="Positive" />
                            <x-badge icon="x" negative label="Negative" />
                            <x-badge icon="exclamation" warning label="Warning" />
                            <x-badge right-icon="information-circle" info label="Info" />
                            <x-badge right-icon="ban" dark label="Dark" />
                        </div>
                        <div>
                            <x-badge flat primary label="Prepend">
                                <x-slot name="prepend" class="relative flex items-center w-2 h-2">
                                    <span class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping"></span>
                                    <span class="relative inline-flex w-2 h-2 rounded-full bg-cyan-500"></span>
                                </x-slot>
                            </x-badge>

                            <x-badge flat primary label="Append">
                                <x-slot name="append" class="relative flex items-center w-2 h-2">
                                    <span class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping"></span>
                                    <span class="relative inline-flex w-2 h-2 rounded-full bg-cyan-500"></span>
                                </x-slot>
                            </x-badge>

                            <x-badge flat red label="Laravel">
                                <x-slot name="append" class="relative flex items-center w-2 h-2">
                                    <button type="button">
                                        <x-icon name="x" class="w-4 h-4" />
                                    </button>
                                </x-slot>
                            </x-badge>
                        </div>
                    </div>
                </div>
                <x-button secondary type="submit">Modal</x-button>
                <x-modal.card title="Edit Customer" blur wire:model.defer="cardModal">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input label="Name" placeholder="Your full name" />
                        <x-input label="Phone" placeholder="USA phone" />

                        <div class="col-span-1 sm:col-span-2">
                            <x-input label="Email" placeholder="example@mail.com" />
                        </div>

                        <div class="col-span-1 sm:col-span-2 cursor-pointer bg-gray-100 rounded-xl shadow-md h-72 flex items-center justify-center">
                            <div class="flex flex-col items-center justify-center">
                                <x-icon name="cloud-upload" class="w-16 h-16 text-blue-600" />
                                <p class="text-blue-600">Click or drop files here</p>
                            </div>
                        </div>
                    </div>

                    <x-slot name="footer">
                        <div class="flex justify-between gap-x-4">
                            <x-button flat negative label="Delete" wire:click="delete" />

                            <div class="flex">
                                <x-button flat label="Cancel" x-on:click="close" />
                                <x-button primary label="Save" wire:click="save" />
                            </div>
                        </div>
                    </x-slot>
                </x-modal.card>
            </div>
        </form>
    </div>
    </x-app-layout>