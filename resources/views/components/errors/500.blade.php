@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')

@section('message')
{{ __('Server Error') }}
<br>
<hr>
<a href="{{ route('dashboard') }}" class="text-black">{{ __('Back')}}</a>
@endsection
