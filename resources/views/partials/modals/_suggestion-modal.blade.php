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
                :class="{'has-error': suggestion.errors.title.status != suggestion.errors.title.dirty}"
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
                :class="{'has-error': suggestion.errors.direct.status != suggestion.errors.direct.dirty}"
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
                :class="{'has-error': suggestion.errors.message.status != suggestion.errors.message.dirty}"
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
