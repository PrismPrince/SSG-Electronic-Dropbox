@extends('layouts.error')

@section('error-title', 'Method Not Allowed')

@section('error-code', '405')

@section('error-message')
The Webserver cannot recognize the request method.<br>Go back to <a href="{{ url('/home') }}">Homepage</a>.
@endsection
