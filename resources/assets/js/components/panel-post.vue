<template>
  <div class="panel list-item post panel-default">
    <div class="panel-head">
      <slot name="dropdown-menu"></slot>
      <a class="profile-img" :href="profile">
        <img :src="image" :alt="fullname">
      </a>
      <h4><a :href="profile">{{fullname}}</a><br><small class="text-capitalize">{{date}}</small></h4>
    </div>
    <div class="panel-body">
      <h3>{{postAct.title}}</h3><hr>
      <p :class="enlarge ? 'enlarge' : ''" v-html="desc"></p>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      postAct: {
        type: Object,
        required: true
      }
    },
    computed: {
      enlarge() {
        if (this.desc.length <= 85) return true
        else return false
      },
      image() {
        return window.location.origin + '/images/user.jpg'
      },
      profile() {
        return window.location.origin + '/profile/' + this.postAct.user.id
      },
      fullname() {
        return this.postAct.user.fname + ' ' + this.postAct.user.lname
      },
      date() {
        var date = this.postAct.created_at

        if (moment().diff(moment(date), 'second') <= 5) {
          return 'just now'
        } else if (moment().diff(moment(date), 'day') == 0) {
          return moment().fromNow()
        } else if (moment().diff(moment(date), 'day') == 1) {
          return 'yesterday at ' + moment(date).format('h:mm a')
        } else if (moment().diff(moment(date), 'day') < 7) {
          return moment(date).format('ddd [at] h:mm a')
        } else if (moment().diff(moment(date), 'year') == 0) {
          return moment(date).format('MMM D [at] h:mm a')
        } else {
          return moment(date).format('MMM D, YYYY [at] h:mm a')
        }
      },
      desc() {
        var text = this.postAct.desc

        text = text.replace(/[(<>"'&]/g, function (char) {
          if (char == "<") return "&lt;"
          else if (char == ">") return "&gt;"
          else if (char == "\"") return "&quot;"
          else if (char == "'") return "&apos;"
          else if (char == "&") return "&amp;"
        })

        var hashed = text.match(/\s?#\w+\s?/g)
        hashed = _.map(hashed, function (word) {return _.trim(word)})

        _.forEach(hashed, function (word) {
          if (/^#\d+$/.test(word)) return
          else {
            text = text.replace(word, '<a href="' + window.location.origin + '/search/' + word + '">' + word + '</a>')
          }
        })

        text = text.replace(/[\n\r\f]/g, '<br>')

        return text
      }
    }
  }
</script>