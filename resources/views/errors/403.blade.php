@extends('layouts.error')

@section('error-title', 'Access Denied')

@section('error-code', '403')

@section('error-message')
The requested resource requires an authentication.<br>Go back to <a href="{{ url('/home') }}">Homepage</a>.
@endsection
