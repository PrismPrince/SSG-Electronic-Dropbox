@extends('layouts.app')

@section('content')

<div class="modal fade" id="suggestion-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#suggestion-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Send a Suggestion</h4>
        </div>

        <div class="modal-body">

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="suggestion.errors.title.status != suggestion.errors.title.dirty ? 'has-error' : ''"
              >
                <label for="suggestion-title" class="control-label">Title</label>
                <input
                  id="suggestion-title"
                  type="text"
                  class="form-control"
                  placeholder="Write the title"
                  maxlength="255"
                  required
                 
                  v-model.trim="suggestion.title"
                  @keyup.enter.prevent="focus('#suggestion-direct')"
                >

                <span class="help-block" v-if="suggestion.errors.title.status != suggestion.errors.title.dirty">
                  <strong>@{{suggestion.errors.title.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="suggestion.errors.direct.status != suggestion.errors.direct.dirty ? 'has-error' : ''"
              >
                <label for="suggestion-direct" class="control-label">Direct</label>
                <input
                  id="suggestion-direct"
                  type="text"
                  class="form-control"
                  placeholder="To whom is the concern"
                  maxlength="255"
                  required
                 
                  v-model.trim="suggestion.direct"
                  @keyup.enter.prevent="focus('#suggestion-message')"
                >

                <span class="help-block" v-if="suggestion.errors.direct.status != suggestion.errors.direct.dirty">
                  <strong>@{{suggestion.errors.direct.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="suggestion.errors.message.status != suggestion.errors.message.dirty ? 'has-error' : ''"
              >
                <label for="suggestion-message" class="control-label">Message</label>
                <textarea
                  id="suggestion-message"
                  class="form-control"
                  placeholder="Write about it"
                 
                  v-model.trim="suggestion.message"
                ></textarea>

                <span class="help-block" v-if="suggestion.errors.message.status != suggestion.errors.message.dirty">
                  <strong>@{{suggestion.errors.message.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#suggestion-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" :disabled="btnSuggestionDisabled" @click.prevent="submitAct">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-suggestion-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#confirm-suggestion-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Suggestion</h4>
        </div>

        <div class="modal-body">
          <div class="row" slot="modal-body">
            <div class="col-xs-12">
              Are you sure you want to delete this?
            </div>
          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#confirm-suggestion-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="destroy">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="container root-content">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2" v-cloak>

      <div v-if="!suggestion.object" class="loading-circle"><span class="sr-only">loading...</span></div>
      <panel-suggestion
        v-else
        :suggestion-act="suggestion.object"
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
  <script src="/js/suggestion.js"></script>
@endpush