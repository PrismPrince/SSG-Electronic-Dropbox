@extends('layouts.app')

@section('content')

<div class="modal fade" id="post-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#post-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Write a Post</h4>
        </div>

        <div class="modal-body">

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="post.errors.title.status != post.errors.title.dirty ? 'has-error' : ''"
              >
                <label for="post-title" class="control-label">Title</label>
                <input
                  id="post-title"
                  type="text"
                  class="form-control"
                  placeholder="Write the title"
                  maxlength="255"
                  required
                  v-model.trim="post.title"
                  @keyup.enter.prevent="focus('#post-desc')"
                >

                <span class="help-block" v-if="post.errors.title.status != post.errors.title.dirty">
                  <strong>@{{post.errors.title.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="post.errors.desc.status != post.errors.desc.dirty ? 'has-error' : ''"
              >
                <label for="post-desc" class="control-label">Description</label>
                <textarea
                  id="post-desc"
                  class="form-control"
                  placeholder="Write about it"
                  v-model.trim="post.desc"
                ></textarea>

                <span class="help-block" v-if="post.errors.desc.status != post.errors.desc.dirty">
                  <strong>@{{post.errors.desc.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#post-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" :disabled="btnPostDisabled" @click.prevent="submitAct">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-post-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#confirm-post-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Post</h4>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              Are you sure you want to delete this?
            </div>
          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#confirm-post-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="destroy">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="container root-content">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" v-cloak>

      <div v-if="!post.object" class="loading-circle"><span class="sr-only">loading...</span></div>
      <panel-post
        v-else
        :post-act="post.object"
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
  <script src="/js/post.js"></script>
@endpush