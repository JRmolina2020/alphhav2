import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        filters: {
            data: { value: "", keys: ["name"] }
        },
        users: [],
        categories: [],
        permissions: [],
        status: false,
        urluser: "users",
        urlpermission: "permisos/data",
        urlcategorie: "categoria/data"
    },
    mutations: {
        ListUserM(state, item) {
            state.users = item;
        },
        ListCategorieM(state, item) {
            state.categories = item;
        },
        ListPermissionM(state, item) {
            state.permissions = item;
        }
    },
    actions: {
        async ListUserA({ commit, state }) {
            try {
                let response = await axios.get(state.urluser);
                commit("ListUserM", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async ListCategorieA({ commit, state }) {
            try {
                let response = await axios.get(state.urlcategorie);
                commit("ListCategorieM", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        },
        async ListPermissionA({ commit, state }) {
            try {
                let response = await axios.get(state.urlpermission);
                commit("ListPermissionM", response.data);
                state.status = true;
            } catch (error) {
                console.log(error);
            }
        }
    }
});
