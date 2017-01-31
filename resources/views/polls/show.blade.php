@extends('layouts.app')

@section('content')

<div class="modal fade" id="poll-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#poll-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create a Poll</h4>
        </div>

        <div class="modal-body">

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="poll.errors.title.status != poll.errors.title.dirty ? 'has-error' : ''"
              >
                <label for="poll-title" class="control-label">Title</label>
                <input
                  id="poll-title"
                  type="text"
                  class="form-control"
                  placeholder="Write the title"
                  maxlength="255"
                  required
                  v-model.trim="poll.title"
                  @keyup.enter.prevent="focus('#poll-start')"
                >

                <span class="help-block" v-if="poll.errors.title.status != poll.errors.title.dirty">
                  <strong>@{{poll.errors.title.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row">

            <div class="col-sm-6">
              <div
                class="form-group"
                :class="poll.errors.start.status != poll.errors.start.dirty ? 'has-error' : ''"
              >
                <label for="poll-start" class="control-label">Start Date</label>
                <input
                  id="poll-start"
                  type="text"
                  class="form-control"
                  placeholder="When the poll starts"
                  maxlength="255"
                  required
                  v-model.trim="poll.start"
                  @keyup.enter.prevent="focus('#poll-end')"
                >

                <span class="help-block" v-if="poll.errors.start.status != poll.errors.start.dirty">
                  <strong>@{{poll.errors.start.text}}</strong>
                </span>

              </div>
            </div>

            <div class="col-sm-6">
              <div
                class="form-group"
                :class="poll.errors.end.status != poll.errors.end.dirty ? 'has-error' : ''"
              >
                <label for="poll-end" class="control-label">End Date</label>
                <input
                  id="poll-end"
                  type="text"
                  class="form-control"
                  placeholder="When the poll ends"
                  maxlength="255"
                  required
                  v-model.trim="poll.end"
                  @keyup.enter.prevent="focus('#poll-type')"
                >

                <span class="help-block" v-if="poll.errors.end.status != poll.errors.end.dirty">
                  <strong>@{{poll.errors.end.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row">

            <div class="col-sm-6">
              <div class="form-group">
                <label for="poll-status" class="control-label">Status</label>
                <input
                  id="poll-status"
                  type="text"
                  class="form-control"
                  placeholder="Status"
                  maxlength="255"
                  required
                  readonly
                  v-model.trim="pollstatus"
                >

              </div>
            </div>

            <div class="col-sm-6">
              <div
                class="form-group"
                :class="poll.errors.type.status != poll.errors.type.dirty ? 'has-error' : ''"
              >
                <label class="control-label">Type</label>
                <select
                  id="poll-type"
                  class="form-control"
                  required
                  v-model.trim="poll.type"
                  @keyup.enter.prevent="focus('#poll-desc')"
                >
                  <option value="" disabled hidden>Choose how the users vote</option>
                  <option value="once">One answer</option>
                  <option value="multi">Multiple answers</option>
                </select>

                <span class="help-block" v-if="poll.errors.type.status != poll.errors.type.dirty">
                  <strong>@{{poll.errors.type.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="poll.errors.desc.status != poll.errors.desc.dirty ? 'has-error' : ''"
              >
                <label for="poll-desc" class="control-label">Description</label>
                <textarea
                  id="poll-desc"
                  class="form-control"
                  placeholder="Write about it"
                  v-model.trim="poll.desc"
                ></textarea>

                <span class="help-block" v-if="poll.errors.desc.status != poll.errors.desc.dirty">
                  <strong>@{{poll.errors.desc.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row">

            <div class="col-sm-12">
              <div
                class="form-group"
                :class="poll.errors.answer.status != poll.errors.answer.dirty ? 'has-error' : ''"
              >
                <label for="poll-answers" class="control-label">Answers</label>
                <div class="input-group">
                  <input
                    id="poll-answers"
                    type="text"
                    class="form-control"
                    placeholder="Add an answer"
                    maxlength="255"
                    required
                    v-model.trim="poll.answer"
                    @keyup.enter.prevent="addAnswer(poll.answer)"
                  >
                  <span class="input-group-btn">
                    <button class="btn btn-info" type="button" @click="addAnswer(poll.answer)">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </span>
                </div>

                <span class="help-block" v-if="poll.errors.answer.status != poll.errors.answer.dirty">
                  <strong>@{{poll.errors.answer.text}}</strong>
                </span>

              </div>
            </div>

            <div class="col-sm-12">
              <ul class="list-group">
                <li class="list-group-item" v-for="(answer, key) in poll.answers">
                  <button v-if="poll.answers.length > 2" class="remove btn btn-xs btn-danger" type="button" @click="removeAnswer(key)">
                    <span class="glyphicon glyphicon-remove"></span>
                  </button>
                  @{{answer.answer}}
                </li>
              </ul>
            </div>

          </div> {{-- .row --}}

        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#poll-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" :disabled="btnPollDisabled" @click.prevent="submitAct">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-poll-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#confirm-poll-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Poll</h4>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              Are you sure you want to delete this?
            </div>
          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#confirm-poll-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="destroy">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

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