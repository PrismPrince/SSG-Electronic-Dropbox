<template>
  <div class="panel list-item post panel-default">
    <div class="panel-body">

      <div class="media">
        <div class="media-left">
          <a :href="profile">
            <img class="media-object" :src="image" :alt="fullname">
          </a>
        </div>
        <div class="media-body">
          <div v-if="opt" class="dropdown pull-right">
            <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <span></span>
            </a>
            <slot name="dropdown-menu"></slot>
          </div>
          <h4 class="media-heading"><a :href="profile">{{fullname}}</a><br><small>{{formatDate(date)}}</small></h4>
          <slot></slot>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    props: {
      profile: {
        type: String,
        required: true
      },
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
        if (moment().diff(moment(date), 'second') <= 5) {
          return 'just now'
        }
        return moment(date).fromNow()
      }
    }
  }
</script>