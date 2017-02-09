@extends('layouts.app')

@section('content')

@include('partials._modals._poll-modal')
@include('partials._modals._confirm-poll-modal')

<div class="container root-content">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" v-cloak>

      <div v-if="!poll.object" class="loading-circle"><span class="sr-only">loading...</span></div>
      <panel-poll
        v-else
        :auth-user="user"
        :poll-act="poll.object"
      >
        <div v-if="poll.object.user.id == user.id" slot="dropdown-menu" class="media-right">
          <div class="dropdown pull-right">
            <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#" @click.prevent="edit(poll.object.id)">Edit</a></li>
              <li><a href="#" @click.prevent="showModal('#confirm-poll-modal', 'Delete', poll.object.id)">Delete</a></li>
            </ul>
          </div>
        </div>
      </panel-poll>

    </div> {{-- .col-sm-8 --}}
  </div> {{-- .row --}}
</div> {{-- .container --}}

@endsection

@push('scripts')
  <script src="/js/poll.js"></script>
@endpush