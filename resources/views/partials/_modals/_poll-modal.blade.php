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
                :class="{'has-error': poll.errors.title.status != poll.errors.title.dirty}"
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
                :class="{'has-error': poll.errors.start.status != poll.errors.start.dirty}"
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
                :class="{'has-error': poll.errors.end.status != poll.errors.end.dirty}"
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
                :class="{'has-error': poll.errors.type.status != poll.errors.type.dirty}"
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
                :class="{'has-error': poll.errors.desc.status != poll.errors.desc.dirty}"
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
                :class="{'has-error': poll.errors.answer.status != poll.errors.answer.dirty}"
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
