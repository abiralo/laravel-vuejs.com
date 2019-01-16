import postsQql from '@/graphql/queries/posts.graphql';
import postBySlugQql from '@/graphql/queries/postBySlug.graphql';

export const state = () => ({
  single: null,
  posts: [],
  featured: []
})

export const mutations = {
  //Set the latest news to state
  SET_FEATURED_POSTS: (state, val) => {
    state.featured = val
  },

  SET_POST: (state, val) => {
    state.single = val
  },

  SET_POSTS: (state, val) => {
    state.posts = val
  },
}

export const actions = {
  //Get the latest news
  async LOAD_FEATURED_POSTS({commit}) {
    await this.app.$http.post.featured().then((data) => {
      commit('SET_FEATURED_POSTS', data)
    })
  },
  async LOAD_POSTS({commit}) {
    let variables = {count: 8};
    await this.app.apolloProvider.defaultClient.query({query: postsQql, variables})
      .then(({data}) => {
        commit('SET_POSTS', data.posts)
      }).catch((error) => {
        console.log(error)
      })
  },
  async LOAD_POST({commit}, {slug}) {
    let variables = {slug};
    await this.app.apolloProvider.defaultClient.query({query: postBySlugQql, variables})
      .then(({data}) => {
        commit('SET_POST', data.postBySlug)
      }).catch((error) => {
        console.log(error)
      })
  },
}
