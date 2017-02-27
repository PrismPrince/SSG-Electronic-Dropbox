@extends('layouts.app')

@section('content')

<div class="container root-content">
  <div class="row" v-cloak>
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

      @if (session('status'))
        <alert-success>
          <strong>Success!</strong>
          {{ session('status') }}
        </alert-success>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Account Settings</div>
        <div class="panel-body text-muted">
          <ul class="list-unstyled">
            <li>Change your information here.
              <ul>
                <li>Change your name.</li>
                <li>Update your e-mail.</li>
                <li>Secure your password.</li>
              </ul>
            </li>
          </ul>
        </div>
        <ul class="list-group">
          <li class="list-group-item"><a href="{{ url('/account/name') }}">Change Name</a></li>
          <li class="list-group-item"><a href="{{ url('/account/email') }}">Change Email</a></li>
          <li class="list-group-item"><a href="{{ url('/account/password') }}">Change Password</a></li>
        </ul>
      </div>

    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script src="{{ asset('/js/account.js') }}"></script>
@endpush