import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

const actions = {
createResource(context, data, options = {}) {
        return axios.post('/admin/resource/create', data, options)
    }
}

export default new Vuex.Store({
    actions
})
