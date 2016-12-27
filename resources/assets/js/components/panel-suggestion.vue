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
      <h4><a :href="profile">{{fullname}}</a> suggest to <b>{{direct}}</b><br><small>{{date | formatDate | capitalize}}</small></h4>
    </div>
    <div class="panel-body">
      <h3 v-html="title"></h3><hr>
      <p :class="enlarge ? 'enlarge' : ''" v-html="htmlEntities(message)"></p>
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
      direct: {
        type: String,
        required: true
      },
      message: {
        type: String,
        required: true
      },
      opt: {
        type: Boolean,
        required: true
      }
    },
    data() {
      return {
        enlarge: false
      }
    },
    methods: {
      htmlEntities(text) {
        if (text.length <= 85) this.enlarge = true

        text = text.replace(/[(<>"'&]/g, function (x) {
          if (x == "<") return "&lt;"
          else if (x == ">") return "&gt;"
          else if (x == "\"") return "&quot;"
          else if (x == "'") return "&apos;"
          else if (x == "&") return "&amp;"
        })

        var hashed = text.match(/\s?#\w+\s?/g)
        hashed = _.map(hashed, function (x) {return _.trim(x)})

        _.forEach(hashed, function (x) {
          if (/^#\d+$/.test(x)) return
          else {
            text = text.replace(x, '<a href="' + window.location.origin + '/search/' + x + '">' + x + '</a>')
          }
        })

        text = text.replace(/[\n\r\f]/g, '<br>')

        return text
      }
    },
    filters: {
      formatDate(date) {
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
      capitalize(value) {
        if (!value) return ''
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
      }
    }
  }
</script>