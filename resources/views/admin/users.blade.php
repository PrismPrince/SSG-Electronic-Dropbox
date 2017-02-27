@extends('layouts.app')

@section('content')

<div class="container root-content">

  <div class="row">
    <div class="col-sm-12" v-cloak>
      <div class="panel panel-default">
        <div class="panel-heading">
          Users <span class="badge">{{ $user_count }}</span>
          <button class="btn btn-xs btn-default pull-right" @click="resetUsers">Reset</button>
        </div>

        <table class="table table-striped table-hover table-condensed">
          <thead class="text-nowrap">
            <tr>
              <th>
                ID Number
                <button
                  v-if="student_id"
                  class="close"
                  aria-label="Close"
                  @click="student_id = null"
                ><span aria-hidden="true">&times;</span></button>
              </th>
              <th>
                Name
                <button
                  v-if="name"
                  class="close"
                  aria-label="Close"
                  @click="name = null"
                ><span aria-hidden="true">&times;</span></button>
              </th>
              <th>
                E-mail
                <button
                  v-if="email"
                  class="close"
                  aria-label="Close"
                  @click="email = null"
                ><span aria-hidden="true">&times;</span></button>
              </th>
              <th>
                Role
                <button
                  v-if="role"
                  class="close"
                  aria-label="Close"
                  @click="role = null"
                ><span aria-hidden="true">&times;</span></button>
              </th>
              <th>
                Status
                <button
                  v-if="status"
                  class="close"
                  aria-label="Close"
                  @click="status = null"
                ><span aria-hidden="true">&times;</span></button>
              </th>
              <th>Joined At</th>
            </tr>
            <tr>
              <th style="max-width: 110px;">
                <label class="sr-only" for="student_id">Search student ID</label>
                <input type="text" name="student_id" id="student_id" class="form-control input-sm" placeholder="Search ID number" v-model="student_id">
              </th>
              <th>
                <label class="sr-only" for="name">Search name</label>
                <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Search name" v-model="name">
              </th>
              <th>
                <label class="sr-only" for="email">Search e-mail</label>
                <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Search e-mail" v-model="email">
              </th>
              <th>
                <label class="sr-only" for="role">Filter role</label>
                <select class="form-control input-sm" name="role" id="role" v-model="role">
                  <option value="null" hidden>Filter role</option>
                  <option value="administrator">Administrator</option>
                  <option value="moderator">Moderator</option>
                  <option value="student">Student</option>
                </select>
              </th>
              <th>
                <label class="sr-only" for="status">Filter status</label>
                <select class="form-control input-sm" name="status" id="status" v-model="status">
                  <option value="null" hidden>Filter status</option>
                  <option value="active">Active</option>
                  <option value="deactive">Deactive</option>
                </select>
              </th>
              <th>
                <button v-if="student_id || name || email || role || status" class="btn btn-sm btn-default" style="width: calc(50% - 5px)" @click="searchUsers">Search</button>
                <button v-if="student_id || name || email || role || status" class="btn btn-sm btn-default" style="width: 50%" @click="clearUserSearch">Clear All</button>
              </th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="user in users" :key="user.id">
              <th>@{{user.id}}</th>
              <td><a :href="'{{ url('/profile') }}/' + user.id">@{{user.fname + ' ' + user.lname}}</a></td>
              <td>@{{user.email}}</td>
              <td class="text-capitalize">
                <span class="label" :class="{'label-primary': user.role == 'administrator','label-default': user.role == 'moderator','label-info': user.role == 'student'}">@{{user.role}}</span>
              </td>
              <td class="text-capitalize dropdown">
                <button
                  class="btn btn-xs"
                  :class="{'btn-success': !user.deleted_at, 'btn-danger': user.deleted_at}"
                  data-toggle="dropdown"
                >@{{user.deleted_at ? 'Deactive' : 'Active'}} <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li v-if="user.deleted_at"><a href="#" @click.prevent="toggleStatus(user.id, 'activate')">Activate</a></li>
                  <li v-if="!user.deleted_at"><a href="#" @click.prevent="toggleStatus(user.id, 'deactivate')">Deactivate</a></li>
                </ul>
              </td>
              <td>@{{user.created_at.date | formatDateTimeNormal}}</td>
            </tr>
          </tbody>
        </table>

        <div v-if="!full" class="full-option text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="full-option"><div class="loading-circle"></div><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="full-option text-center"><span class="full"></span><span class="sr-only">No more users</span></div>

      </div> {{-- .panel --}}
    </div> {{-- .col-sm-12 --}}
  </div> {{-- .row --}}
</div> {{-- .contaiiner --}}

@endsection

@push('scripts')
  <script src="{{ asset('/js/admin-users.js') }}"></script>
@endpush