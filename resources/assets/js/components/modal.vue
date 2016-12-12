<template>
  <div class="modal fade" :id="modalId" tabindex="-1" role="dialog" :aria-labelledby="ariaLabelledBy">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" :id="ariaLabelledBy">{{modalTitle}}</h4>
        </div>
        <div class="modal-body">
          <slot name="modal-body">Modal body</slot>
        </div>
        <div class="modal-footer">
          <slot name="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      modalId: {
        type: String,
        required: true
      },
      ariaLabelledBy: {
        type: String,
        default: ''
      },
      modalTitle: {
        type: String,
        required: true
      }
    }
  }
</script>