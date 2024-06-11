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

export function getProducts({commit, state}, {url = null, search = '', per_page , sort_field, sort_direction} = {}) {
    commit('setProducts', [true])
    url = url || '/products'
    const params = {
        per_page: state.products.limit,
    }
    return axiosClient.get(url, {
        params: {
            ...params,
            search, per_page, sort_field, sort_direction
        }
    })
        .then((response) => {
            commit('setProducts', [false, response.data])
        })
        .catch(() => {
            commit('setProducts', [false])
        })
}

export function createProduct({commit}, product) {
    if (product.image instanceof File){
        const  form = new FormData();
        form.append('title', product.title);
        form.append('image', product.image);
        form.append('description', product.description);
        form.append('price', product.price);
        product = form;
    }

    return axiosClient.post('/products', product)

}

export function updateProduct({commit}, product) {
    const id = product.id
    if (product.image instanceof File){
        const form = new FormData();
        form.append('id', product.id);
        form.append('title', product.title);
        form.append('image', product.image);
        form.append('description', product.description);
        form.append('price', product.price);
        form.append('_method', 'PUT');
        product = form
    }else {
        product._method = 'PUT'
    }
    return axiosClient.post(`/products/${id}`, product)
}


