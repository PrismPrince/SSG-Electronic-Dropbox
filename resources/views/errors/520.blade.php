@extends('layouts.error')

@section('error-title', 'Origin Error - Unknown Host')

@section('error-code', '520')

@section('error-message')
The requested hostname is not routed. Use only hostnames to access resources.
@endsection
