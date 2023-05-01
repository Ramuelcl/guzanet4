@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')

@section('message')
{{ __('Page Expired') }}
<br>
<hr>
<a href="{{ route('dashboard') }}" class="text-black">{{ __('Back')}}</a>
@endsection
