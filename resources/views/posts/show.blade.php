@extends('layouts.app')

@section('content')

@include('partials.modals._post-photos-modal')
@include('partials.modals._post-modal')
@include('partials.modals._confirm-post-modal')

<div class="container root-content">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" v-cloak>

      <div v-if="!post.object" class="loading-circle"><span class="sr-only">loading...</span></div>
      <panel-post
        v-else
        :post-act="post.object"
        v-on:show-carousel-modal="showPostPhotosModal"
      >
        <div v-if="post.object.user.id == user.id" slot="dropdown-menu" class="media-right">
          <div class="dropdown pull-right">
            <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#" @click.prevent="edit(post.object.id)">Edit</a></li>
              <li><a href="#" @click.prevent="showModal('#confirm-post-modal', 'Delete', post.object.id)">Delete</a></li>
            </ul>
          </div>
        </div>
      </panel-post>

    </div> {{-- .col-sm-8 --}}
  </div> {{-- .row --}}
</div> {{-- .container --}}

@endsection

@push('scripts')
  <script src="{{ asset('/js/post.min.js') }}"></script>
@endpush