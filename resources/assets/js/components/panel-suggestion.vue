<template>
  <div class="panel list-item panel-default">
    <div class="panel-head">
      <slot name="dropdown-menu"></slot>
      <a class="profile-img" :href="userUrl">
        <img :src="image" :alt="fullname">
      </a>
      <h4><a :href="userUrl">{{fullname}}</a> suggest to <b>{{suggestionAct.direct}}</b><br><small>{{date}}</small></h4>
    </div>
    <div class="panel-body">
      <h3>{{suggestionAct.title}}</h3><hr>
      <p :class="enlarge ? 'enlarge' : ''" v-html="message"></p>
    </div>
  </div>
</template>

<script>
  export default {

    props: {

      suggestionAct: {
        type:       Object,
        required:   true
      }

    },

    computed: {

      enlarge() {

        if (this.suggestionAct.message.length <= 85)  return true
        else                                          return false

      },

      image() {

        return window.location.origin + '/images/user.jpg'

      },

      userUrl() {

        return window.location.origin + '/profile/' + this.suggestionAct.user.id

      },

      fullname() {

        return this.suggestionAct.user.fname + ' ' + this.suggestionAct.user.lname

      },

      date() {

        var date = this.suggestionAct.created_at

        if      (moment().diff(moment(date), 'second') <= 5)  return 'just now'
        else if (moment().diff(moment(date), 'day') == 0)     return moment(date).fromNow()
        else if (moment().diff(moment(date), 'day') == 1)     return 'yesterday at ' + moment(date).format('h:mm a')
        else if (moment().diff(moment(date), 'day') < 7)      return moment(date).format('ddd [at] h:mm a')
        else if (moment().diff(moment(date), 'year') == 0)    return moment(date).format('MMM D [at] h:mm a')
        else                                                  return moment(date).format('MMM D, YYYY [at] h:mm a')

      },

      message() {

        var text = this.suggestionAct.message

        text = text.replace(/[(<>"'&]/g, function (char) {

          if      (char == "<")   return "&lt;"
          else if (char == ">")   return "&gt;"
          else if (char == "\"")  return "&quot;"
          else if (char == "'")   return "&apos;"
          else if (char == "&")   return "&amp;"

        })

        var hashed = text.match(/\s?#\w+\s?/g)

        hashed = _.map(hashed, function (word) {

          return _.trim(word)

        })

        _.forEach(hashed, function (word) {

          if (/^#\d+$/.test(word))  return
          else                      text = text.replace(word, '<a href="' + window.location.origin + '/search?key=' + word + '">' + word + '</a>')

        })

        text = text.replace(/[\n\r\f]/g, '<br>')

        return text

      }

    }

  }
</script>