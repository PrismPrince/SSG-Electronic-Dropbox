@extends('layouts.app')

@section('content')

@include('partials.modals._suggestion-modal')
@include('partials.modals._confirm-suggestion-modal')

<div class="container root-content">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" v-cloak>

      <div v-if="!suggestion.object" class="loading-circle"><span class="sr-only">loading...</span></div>
      <panel-suggestion
        v-else
        :suggestion-act="suggestion.object"
        :auth-user="user"
      >
        <div v-if="suggestion.object.user.id == user.id" slot="dropdown-menu" class="media-right">
          <div class="dropdown pull-right">
            <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#" @click.prevent="edit(suggestion.object.id)">Edit</a></li>
              <li><a href="#" @click.prevent="showModal('#confirm-suggestion-modal', 'Delete', suggestion.object.id)">Delete</a></li>
            </ul>
          </div>
        </div>
      </panel-suggestion>

    </div> {{-- .col-sm-8 --}}
  </div> {{-- .row --}}
</div> {{-- .container --}}

@endsection

@push('scripts')
  <script src="{{ asset('/js/suggestion.js') }}"></script>
@endpush