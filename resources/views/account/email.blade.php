@extends('layouts.app')

@section('content')
<div class="container root-content">
  <div class="row" v-cloak>
    <div class="col-md-8 col-md-offset-2">

      @if ($errors->has('email'))
        <alert-danger>
          <strong>Error!</strong>
          <ul>
            @if ($errors->has('email'))
              <li>{{ $errors->first('email') }}</li>
            @endif
          </ul>
        </alert-danger>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Change Password</div>
        <div class="panel-body">

          <form class="form-horizontal" role="form" method="POST" action="{{ url('/account/email') }}">
            {{ csrf_field() }}
            {{ method_field('patch') }}

            <div class="form-group">
              <label class="col-md-4 control-label">Current E-mail</label>
              <div class="col-sm-6">
                <p class="form-control-static">@{{email}}</p>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.newEmail.status != errors.newEmail.dirty ? 'has-error' : ''"
            >
              <label for="newEmail" class="col-md-4 control-label">New E-mail</label>

              <div class="col-md-6">
                <input
                  id="newEmail"
                  type="email"
                  class="form-control"
                  name="email"
                  required
                  v-model="newEmail"
                >

                <span class="help-block" v-if="errors.newEmail.status != errors.newEmail.dirty">
                  <strong>@{{errors.newEmail.text}}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <p class="form-control-static text-muted account-tip"><b>Please note:</b> Make sure to use an active e-mail for resetting your password in case you forgot it.</p>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" :disabled="btnDisabled">
                  Change E-mail
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
  <script src="/js/account-email.js"></script>
@endpush