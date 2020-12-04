const axios = require('axios')

axios.defaults.baseURL = adminBaseUrl
axios.defaults.withCredentials = true
axios.defaults.timeout = 10 * 1000
axios.defaults.headers['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers['X-CSRF-TOKEN'] = adminCsrfToken

axios.interceptors.request.use(config => {
    if (config.label) {
        admin.setTrue(config.label)
    }

    if (typeof config.message === 'undefined') {
        config.message = true
    }

    return config
}, error => {
    admin.message.error('发送网络请求错误')

    Object.keys(error).forEach(key => {
        if (typeof error[key] !== 'function') {
            console.log(`[${key}]`, error[key])
        }
    })

    return Promise.reject(error)
})

axios.interceptors.response.use(response => {
    if (response.config.label) {
        admin.setFalse(response.config.label)
    }

    if (response.status === 200) {
        if (response.data.code === 0) {
            if (response.config.message) {
                admin.message.success(response.data.message || '网络请求成功')
            }
            return response.data
        } else {
            if (response.config.message) {
                admin.message.error(response.data.message || '响应数据错误')
            }

            Object.keys(response).forEach(key => {
                if (typeof response[key] !== 'function') {
                    console.log(`[${key}]`, response[key])
                }
            })

            return Promise.reject(response.data.message)
        }
    } else {
        if (response.config.message) {
            admin.message.error(response.data.message || '请求响应错误')
        }
        Object.keys(response).forEach(key => {
            if (typeof response[key] !== 'function') {
                console.log(`[${key}]`, response[key])
            }
        })
    }
    return Promise.reject(response.data.message)
}, error => {
    if (error.config.label) {
        admin.setFalse(error.config.label)
    }

    if (error.config.message) {
        admin.message.error('网络请求错误')
    }

    Object.keys(error).forEach(key => {
        if (typeof error[key] !== 'function') {
            console.log(`[${key}]`, error[key])
        }
    })

    return Promise.reject(error)
})

Vue.prototype.$http = axios
