@extends('layouts.app')

@section('content')
<div class="container root-content">
  <div class="row" v-cloak>
    <div class="col-md-8 col-md-offset-2">

      @if ($errors->has('fname') || $errors->has('mname') || $errors->has('lname'))
        <alert-danger>
          <strong>Error!</strong>
          <ul>
            @if ($errors->has('fname'))
              <li>{{ $errors->first('fname') }}</li>
            @endif
            @if ($errors->has('mname'))
              <li>{{ $errors->first('mname') }}</li>
            @endif
            @if ($errors->has('lname'))
              <li>{{ $errors->first('lname') }}</li>
            @endif
          </ul>
        </alert-danger>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Update Name</div>
        <div class="panel-body">

          <form class="form-horizontal" role="form" method="POST" action="{{ url('/account/name') }}">
            {{ csrf_field() }}
            {{ method_field('patch') }}

            <div
              class="form-group"
              :class="errors.first_name.status != errors.first_name.dirty ? 'has-error' : ''"
            >
              <label for="first-name" class="col-md-4 control-label">First Name</label>

              <div class="col-md-6">
                <input
                  id="first-name"
                  type="text"
                  class="form-control"
                  name="fname"
                  required
                  v-model.trim="first_name"
                  @keyup.enter.prevent="focus('#middle-name')"
                >

                <span class="help-block" v-if="errors.first_name.status != errors.first_name.dirty">
                  <strong>@{{errors.first_name.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.middle_name.status != errors.middle_name.dirty ? 'has-error' : ''"
            >
              <label for="middle-name" class="col-md-4 control-label">Middle Name</label>

              <div class="col-md-6">
                <input
                  id="middle-name"
                  type="text"
                  class="form-control"
                  name="mname"
                  v-model.trim="middle_name"
                  @keyup.enter.prevent="focus('#last-name')"
                >

                <span class="help-block" v-if="errors.middle_name.status != errors.middle_name.dirty">
                  <strong>@{{errors.middle_name.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.last_name.status != errors.last_name.dirty ? 'has-error' : ''"
            >
              <label for="last-name" class="col-md-4 control-label">Last Name</label>

              <div class="col-md-6">
                <input
                  id="last-name"
                  type="text"
                  class="form-control"
                  name="lname"
                  required
                  v-model.trim="last_name"
                >

                <span class="help-block" v-if="errors.last_name.status != errors.last_name.dirty">
                  <strong>@{{errors.last_name.text}}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <p class="form-control-static text-muted account-tip"><b>Please note:</b> Use your real name so that people will know you. Make sure not to add any unusual capitalization, punctuation, characters or random words.</p>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" :disabled="btnDisabled">
                  Update
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
  <script src="{{ asset('/js/account-name.js') }}"></script>
@endpush