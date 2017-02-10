<div class="modal fade" id="confirm-suggestion-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#confirm-suggestion-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Suggestion</h4>
        </div>

        <div class="modal-body">
          <div class="row">
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
