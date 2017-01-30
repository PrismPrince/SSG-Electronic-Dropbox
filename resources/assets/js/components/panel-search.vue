<template>
  <a :href="url" class="list-group-item list-item">
    <h4 class="list-group-item-heading" v-html="head"></h4>
    <h4 v-if="actDate" class="list-group-item-heading"><small>{{actDate | formatDateTimeNormal}}</small></h4>
    <p class="list-group-item-text" v-html="body"></p>
  </a>
</template>

<script>
  export default {

    props: {

      url: {
        type: String,
        required: true
      },

      head: {
        type: String,
        required: true
      },

      actDate: {
        type: String,
        required: false,
        default: null
      },

      body: {
        type: String,
        required: true
      } 

    },

    filters: {

      formatDateTimeNormal(date) {

        return moment(date).format('MMM D, YYYY [at] h:mm a')

      }

    }

  }
</script>