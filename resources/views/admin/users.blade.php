@extends('layouts.app')

@section('content')

<div class="container root-content">

  <div class="row">
    <div class="col-sm-12" v-cloak>
      <div class="panel panel-default">
        <div class="panel-heading">Users</div>

        <table class="table table-striped table-hover table-condensed">
          <thead class="text-nowrap">
            <tr>
              <th>ID Number</th>
              <th>Name</th>
              <th>E-mail</th>
              <th>Role</th>
              <th>Status</th>
              <th>Joined At</th>
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
        <div v-else-if="full" class="full-option text-center"><span class="full"></span><span class="sr-only">No more suggestion</span></div>

      </div> {{-- .panel --}}
    </div> {{-- .col-sm-12 --}}
  </div> {{-- .row --}}
</div> {{-- .contaiiner --}}

@endsection

@push('scripts')
  <script src="/js/admin-users.js"></script>
@endpush