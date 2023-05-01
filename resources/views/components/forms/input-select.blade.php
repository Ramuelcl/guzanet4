@props(['disabled' => false])
<div>
    <!-- app/view/components/forms/inputSelect.php -->
    <!-- views/components/forms/input-select.blade.php -->
    @if ($label)
    <label for={{ $idName }} class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <div class="mt-1 relative rounded-md shadow-sm {{ $disabled ? 'disabled' : '' }}">
        <select id="{{ $idName }}" wire:model.lazy="{{ $idName }}" wire:change="{{ $idName }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-1 pr-12 sm:text-sm border-gray-300">
            <option value=''>Seleccione...</option>
            @foreach ($options as $key => $option)
            @php
            $select = $selected === $option ? 'selected' : '';
            @endphp
            <option value={{ $option }} {{ $select }}>{{ $option }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <x-input-error for="{{ $idName }}" />
    </div>
</div>