@extends('layouts.app')

@section('content')
<div class="container root-content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2" v-cloak>

      @if (session('status'))
        <alert-success>
          {{ session('status') }}
        </alert-success>
      @endif

      @if ($errors->has('email') || $errors->has('password'))
        <alert-danger>
          <strong>Error!</strong>
          <ul>
            @if ($errors->has('email'))
              <li>{{ $errors->first('email') }}</li>
            @endif
            @if ($errors->has('password'))
              <li>{{ $errors->first('password') }}</li>
            @endif
          </ul>
        </alert-danger>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Reset Password</div>
        <div class="panel-body">
          <input type="hidden" id="errEmail" value="{{ old('email') }}">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div
              class="form-group"
              :class="errors.email.status != errors.email.dirty ? 'has-error' : ''"
            >
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  required
                  v-model="email"
                  @keyup.enter.prevent="focus('#password')"
                >

                <span class="help-block" v-if="errors.email.status != errors.email.dirty">
                  <strong>@{{errors.email.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.password.status != errors.password.dirty ? 'has-error' : ''"
            >
              <label for="password" class="col-md-4 control-label">Password</label>

              <div class="col-md-6">
                <input
                  id="password"
                  type="password"
                  class="form-control"
                  name="password"
                  required
                  v-model="password"
                  @keyup.enter.prevent="focus('#password-confirm')"
                >

                <span class="help-block" v-if="errors.password.status != errors.password.dirty">
                  <strong>@{{errors.password.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.password_confirm.status != errors.password_confirm.dirty ? 'has-error' : ''"
            >
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

              <div class="col-md-6">
                <input
                  id="password-confirm"
                  type="password"
                  class="form-control"
                  name="password_confirmation"
                  required
                  v-model="password_confirm"
                >

                <span class="help-block" v-if="errors.password_confirm.status != errors.password_confirm.dirty">
                  <strong>@{{errors.password_confirm.text}}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" :disabled="btnDisabled">
                  Reset Password
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('/js/reset.min.js') }}"></script>
@endpush
