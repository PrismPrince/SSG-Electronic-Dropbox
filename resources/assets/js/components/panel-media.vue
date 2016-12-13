<template>
  <div class="panel panel-default">
    <div class="panel-body">

      <div class="media">
        <div class="media-left">
          <a href="#">
            <img class="media-object" :src="image" :alt="fullname">
          </a>
        </div>
        <div class="media-body">
          <div v-if="opt" class="dropdown">
            <button class="btn-link opt dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">Edit</a></li>
              <li><a href="#">Delete</a></li>
            </ul>
          </div>
          <h4 class="media-heading">{{fullname}}<br><small>{{formatDate(date)}}</small></h4>
          <slot></slot>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    props: {
      image: {
        type: String,
        required: true
      },
      fullname: {
        type: String,
        required: true
      },
      date: {
        type: String,
        required: true
      },
      opt: {
        type: Boolean,
        required: true
      }
    },
    methods: {
      formatDate(date) {
        console.log(date)
        if (moment().diff(moment(date), 'second') <= 5) {
          return 'just now'
        }
        return moment(date).fromNow()
      }
    }
  }
</script>