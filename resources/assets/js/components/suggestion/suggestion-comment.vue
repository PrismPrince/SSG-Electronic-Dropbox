<template>
  <li class="list-group-item">
    <div class="media">
      <div class="media-left">
        <a href="#">
          <img class="media-object" :src="image" :alt="fullname">
        </a>
      </div>
      <div class="media-body">
        <h5 class="media-heading"><a :href="userUrl">{{fullname}}</a> <small>{{date}}</small></h5>
        <p v-html="comment"></p>
      </div>
    </div>
  </li>
</template>

<script>
  export default {

    props: {

      sComment: {
        type: Object,
        required: true
      }

    },

    computed: {

      image() {

        return window.location.origin + '/image/user/' + this.sComment.user.id + '?wh=34'

      },

      fullname() {

        return this.sComment.user.fname + ' ' + this.sComment.user.lname

      },


      userUrl() {

        return window.location.origin + '/profile/' + this.sComment.user.id

      },

      date() {

        var date = this.sComment.created_at

        if      (moment().diff(moment(date), 'second') <= 5)  return 'just now'
        else if (moment().diff(moment(date), 'day') == 0)     return moment(date).fromNow()
        else if (moment().diff(moment(date), 'day') == 1)     return 'yesterday at ' + moment(date).format('h:mm a')
        else if (moment().diff(moment(date), 'day') < 7)      return moment(date).format('ddd [at] h:mm a')
        else if (moment().diff(moment(date), 'year') == 0)    return moment(date).format('MMM D [at] h:mm a')
        else                                                  return moment(date).format('MMM D, YYYY [at] h:mm a')

      },

      comment() {

        var text = this.sComment.comment

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