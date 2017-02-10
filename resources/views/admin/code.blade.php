@extends('layouts.app')

@section('content')

<div class="container root-content">

  <div class="row">
    <div class="col-sm-12 col-md-7 col-md-offset-1" v-cloak>

      <alert-info><strong>Note!</strong> Please secure the code as a password.</alert-info>
      <div v-if="error" class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" @click="error = null" aria-label="Close">&times;</button>
        <strong>Error!</strong> @{{error}}
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          User Registration Request Codes <span class="badge">{{ $user_request_count }}</span>
          <button class="btn btn-xs btn-default pull-right" @click="resetUsers">Reset</button>
        </div>

        <table class="table table-striped table-hover table-condensed">
          <thead class="text-nowrap">
            <tr>
              <th>ID Number</th>
              <th>
                Code
                <button
                  v-if="student_id"
                  class="close"
                  aria-label="Close"
                  @click="student_id = null"
                ><span aria-hidden="true">&times;</span></button>
              </th>
              <th>Generated at</th>
            </tr>
            <tr>
              <th colspan="2">
                <label class="sr-only" for="student_id">Search ID number</label>
                <input type="text" name="student_id" id="student_id" class="form-control input-sm" placeholder="Search ID number" v-model="student_id">
              </th>
              <th>
                <button class="btn btn-sm btn-default btn-block" @click="searchUsers">Search</button>
              </th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="user in users" :key="user.id">
              <th>@{{user.id}}</th>
              <td>@{{user.code}}</td>
              <td>@{{user.created_at | formatDateTimeNormal}}</td>
            </tr>
          </tbody>
        </table>

        <div v-if="!full" class="full-option text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="full-option"><div class="loading-circle"></div><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="full-option text-center"><span class="full"></span><span class="sr-only">No more user registration request codes</span></div>

      </div> {{-- .panel --}}
    </div> {{-- .col-sm-12 --}}

    <div class="col-sm-12 col-md-3" v-cloak>
      <div class="affix" data-offset-top="0" data-spy="affix">
        <div class="panel panel-default">
          <div class="panel-heading">Generate New Code</div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-12">
                <div
                  class="form-group"
                  :class="errors.new_student_id.status != errors.new_student_id.dirty ? 'has-error' : ''"
                >
                  <label for="new-student-id">Student ID</label>
                  <input type="text" id="new-student-id" name="new_student_id" class="form-control" placeholder="Enter ID number" v-model="new_student_id" @keypress.enter="createCode">
                  <span class="help-block" v-if="errors.new_student_id.status != errors.new_student_id.dirty">
                    <strong>@{{errors.new_student_id.text}}</strong>
                  </span>
                </div>
              </div>
              <div class="col-sm-12">
                <button class="btn btn-default pull-right" @click="createCode" :disabled="btnDisabled">Generate Code</button>
              </div>
            </div>
          </div> {{-- .panel-body --}}
        </div> {{-- .panel --}}
      </div> {{-- .affix --}}
    </div> {{-- .col-sm-12 --}}
  </div> {{-- .row --}}
</div> {{-- .contaiiner --}}

@endsection

@push('scripts')
  <script src="/js/admin-code.js"></script>
@endpush