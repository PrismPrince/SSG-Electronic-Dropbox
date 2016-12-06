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
          <h4 class="media-heading">{{fullname}}</h4>
          <slot></slot>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    props: ['image', 'fullname'],
  }
</script>