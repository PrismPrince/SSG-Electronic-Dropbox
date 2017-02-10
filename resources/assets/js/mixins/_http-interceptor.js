Vue.http.interceptors.push((request, next) => {

    request.headers.set('Authorization', Laravel.authorization)

    next()

})
