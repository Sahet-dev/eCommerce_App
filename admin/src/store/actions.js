import axiosClient from "../axios.js";


export function getUser({commit}) {
    return axiosClient.get('/user')
        .then((response) => {
            commit('setUser', response.data)
            return response
        })
}

export function login({commit}, data) {
    return axiosClient.post('/login', data)
        .then(({data}) => {
            commit('setUser', data.user)
            commit('setToken', data.token)
            return data
        })
}

export function logout({commit}) {
    return axiosClient.post('/logout')
    .then((response) => {
        commit('setToken', null)
        return response
    })
    .catch((error) => {
            commit('setToken', null)
    })
}

export function getProducts({commit}, {url} = null) {
    commit('setProducts', [true])
    url = url || 'products';
    return axiosClient.get(url)
        .then((res) => {
            commit('setProducts', [false, res.data])
            return res
        })
        .catch((error) => {
            commit('setProducts', [false, error])
        })

}


