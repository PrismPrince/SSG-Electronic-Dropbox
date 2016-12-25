<template>
  <div class="panel list-item post panel-default">
    <div class="panel-head">
      <div v-if="opt" class="dropdown pull-right">
        <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <span></span>
        </a>
        <slot name="dropdown-menu"></slot>
      </div>
      <a class="profile-img" :href="profile">
        <img :src="image" :alt="fullname">
      </a>
      <h4><a :href="profile">{{fullname}}</a><br><small>{{formatDate(date)}}</small></h4>
    </div>
    <div class="panel-body">
      <h3 v-html="title"></h3>
      <p v-html="description"></p>
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
      title: {
        type: String,
        required: true
      },
      description: {
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