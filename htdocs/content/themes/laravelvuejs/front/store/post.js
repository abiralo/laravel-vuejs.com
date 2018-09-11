export const state = () => ({
  featured_posts: [],
  post: {},
  posts: []
})

export const mutations = {
  //Set the latest news to state
  SET_FEATURED_POSTS: (state, val) => {
    state.featured_posts = val
  },

  SET_POST: (state, val) => {
    state.post = val
  },

  SET_POSTS: (state, val) => {
    state.posts = val
  },
}

export const actions = {
  //Get the latest news
  async LOAD_FEATURED_POSTS({commit}) {
    await this.app.$http.posts.featured().then(({data}) => {
      commit('SET_FEATURED_POSTS', data)
    })
  },
  async LOAD_POSTS({commit}) {
    await this.app.$http.posts.list().then(({data}) => {
      commit('SET_POSTS', data)
    })
  },
  async LOAD_POST({commit}, {slug}) {
    await this.app.$http.posts.singular(slug).then(({data}) => {
      commit('SET_POST', data)
    })
  },
}
