<template>
  <div class="answer">

    <div class="tooltip tooltip-answer" role="tooltip" v-show="tooltip">
      <div class="tooltip-inner">{{tooltipInner}}</div>
    </div>

    <button
      class="bar-wrapper btn-default"
      :class="{
        selected: selected,
        disabled: btnDisabled
      }"
      @click="vote(answer.id)"
      @mouseenter="showTooltip"
      @mouseleave="hideTooltip"
    >

      <div class="bar" :style="'width: ' + bar + '%;'"></div>
      <div class="bar-label">
        <span class="glyphicon" :class="selected ? 'glyphicon-ok-sign' : 'glyphicon-ok-circle'"></span>
        <span>{{answer.answer}}</span>
      </div>
      <input v-if="pollType == 'once'" v-show="false" type="radio" name="answer" :value="answer.id" v-model="selected">
      <input v-else-if="pollType == 'multi'" v-show="false" type="checkbox" name="answer" :value="answer.id" v-model="selected">

    </button>

  </div>
</template>

<script>
  export default {

    props: {

      authUser: {
        type:       Object,
        required:   true
      },

      answer: {
        type:       Object,
        required:   true
      },

      allVoters: {
        type:       Array,
        required:   true
      },

      pollType: {
        type:       String,
        required:   true
      },

      btnDisabled:{
        type:       Boolean,
        required:   true
      }

    },

    data() {

      return {

        voters:   [],
        tooltip:  false

      }
    },
    mounted() {

      this.getVoters()

    },

    computed: {

      bar() {

        if (this.allVoters.length <= 0) return 0
        else return (this.voters.length / this.allVoters.length) * 100

      },

      selected() {

        return _.indexOf(this.voters, _.find(this.voters, this.authUser)) != -1 ? true : false

      },

      tooltipInner() {

        var text =  ''

        text += (Math.round(this.bar * 100) / 100) + '% - '

        if (this.voters.length == 0) text += 'no votes'
        else
          if (this.selected)
            if (this.voters.length == 1) text += 'you voted'
            else {
              text += 'you and '
              if ((this.voters.length - 1) == 1) text += (this.voters.length - 1) + ' other voted'
              else text += (this.voters.length - 1) + ' others voted'
            }
          else text += (this.voters.length) + ' voted'

        return text

      }

    },

    methods: {

      getVoters() {

        this.$http
          .get(window.location.origin + '/api/answer/' + this.answer.id + '/voters')

          .then((response) => {

            this.voters = response.data

          })

          .catch((response) => {

            console.error('error')

          })

      },

      showTooltip() {

        this.tooltip = true

      },

      hideTooltip() {

        this.tooltip = false

      },

      vote(answer) {

        this.$http

          .post(window.location.origin + '/api/vote', {

            answer: answer

          })

          .then((response) => {

            this.$emit('updateanswers')

          })

          .catch((response) => {

            console.error(response.error)

          })

      }
    }
  }
</script>