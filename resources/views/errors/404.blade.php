@extends('layouts.error')

@section('error-title', 'Resource not found')

@section('error-code', '404')

@section('error-message')
The requested resource could not be found but may be available again in the future.<br>Go back to <a href="{{ url('/home') }}">Homepage</a>.
@endsection
