<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laravel 10 Import Export CSV And EXCEL File - Techsolutionstuff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{ route('import') }}" method="POST" name="importform" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">File:</label>
                        <input id="file" type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <a class="btn btn-info" href="{{ route('export') }}">Export File</a>
                    </div>
                    <button class="btn btn-success">Import File</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
