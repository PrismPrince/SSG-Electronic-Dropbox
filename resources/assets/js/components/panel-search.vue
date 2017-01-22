<template>
  <a :href="url" class="list-group-item list-item">
    <h4 class="list-group-item-heading" v-html="head"></h4>
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

      body: {
        type: String,
        required: true
      } 

    }

  }
</script>