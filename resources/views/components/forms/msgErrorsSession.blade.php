<!-- resources/views/components/forms/msgErrorsSession.blade.php -->
@props(['errors', 'success'])

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if ($success)
<div class="alert alert-success">
    <ul>
        @foreach ($success as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif
