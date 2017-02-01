@extends('layouts.app')

@section('content')
<div class="container root-content">
  <div class="row" v-cloak>
    <div class="col-md-8 col-md-offset-2">

      @if ($errors->has('oldPassword') || $errors->has('newPassword'))
        <alert-danger>
          <strong>Error!</strong>
          <ul>
            @if ($errors->has('oldPassword'))
              <li>{{ $errors->first('oldPassword') }}</li>
            @endif
            @if ($errors->has('newPassword'))
              <li>{{ $errors->first('newPassword') }}</li>
            @endif
          </ul>
        </alert-danger>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Change Password</div>
        <div class="panel-body">

          <form class="form-horizontal" role="form" method="POST" action="{{ url('/account/password') }}">
            {{ csrf_field() }}

            <div
              class="form-group"
              :class="errors.oldPassword.status != errors.oldPassword.dirty ? 'has-error' : ''"
            >
              <label for="oldPassword" class="col-md-4 control-label">Old Password</label>

              <div class="col-md-6">
                <input
                  id="oldPassword"
                  type="password"
                  class="form-control"
                  name="oldPassword"
                  required
                  v-model="oldPassword"
                  @keyup.enter.prevent="focusNext('newPassword')"
                >

                <span class="help-block" v-if="errors.oldPassword.status != errors.oldPassword.dirty">
                  <strong>@{{errors.oldPassword.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.newPassword.status != errors.newPassword.dirty ? 'has-error' : ''"
            >
              <label for="newPassword" class="col-md-4 control-label">New Password</label>

              <div class="col-md-6">
                <input
                  id="newPassword"
                  type="password"
                  class="form-control"
                  name="newPassword"
                  required
                  v-model="newPassword"
                  @keyup.enter.prevent="focusNext('newPasswordConfirm')"
                >

                <span class="help-block" v-if="errors.newPassword.status != errors.newPassword.dirty">
                  <strong>@{{errors.newPassword.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.newPasswordConfirm.status != errors.newPasswordConfirm.dirty ? 'has-error' : ''"
            >
              <label for="newPasswordConfirm" class="col-md-4 control-label">Confirm New Password</label>
              <div class="col-md-6">
                <input
                  id="newPasswordConfirm"
                  type="password"
                  class="form-control"
                  name="newPassword_confirmation"
                  required
                  v-model="newPasswordConfirm"
                >

                <span class="help-block" v-if="errors.newPasswordConfirm.status != errors.newPasswordConfirm.dirty">
                  <strong>@{{errors.newPasswordConfirm.text}}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" :disabled="btnDisabled">
                  Change Password
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
  <script src="/js/account-password.js"></script>
@endpush