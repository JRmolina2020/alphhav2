<template>
    <div>
        <Search-Item titleinput="Buscar Permisos de usuario"></Search-Item>
        <v-table
            :data="permissions"
            :currentPage.sync="currentPage"
            :filters="filters"
            :pageSize="10"
            @totalPagesChanged="totalPages = $event"
            class="table table-striped table-valign-middle table-borderless mt-3 table-bordered"
        >
            <thead slot="head">
                <tr>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody slot="body" slot-scope="{ displayData }">
                <tr v-for="(row, index) in displayData" :key="index">
                    <td scope="row">{{ row.name }}</td>
                    <td>
                        <button
                            type="button"
                            @click="$emit('show', row)"
                            class="btn btn-flat btn-sm btn-warning"
                        >
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button
                            type="button"
                            @click="remove(row)"
                            class="btn btn-flat btn-sm btn-danger"
                        >
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </v-table>
        <smart-pagination
            :currentPage.sync="currentPage"
            :totalPages="totalPages"
        />
    </div>
</template>
<script>
import SearchItem from "../utilities/search";
import { mapState, mapMutations, mapActions } from "vuex";

export default {
    components: {
        SearchItem
    },
    data() {
        return {
            url: "permisos/",
            currentPage: 1,
            totalPages: 0
        };
    },
    computed: {
        ...mapState(["filters", "permissions", "status"])
    },
    created() {
        this.getpermissions();
    },
    methods: {
        getpermissions() {
            this.$store.dispatch("ListPermissionA");
        },
        async remove(row) {
            let url = this.url + row.id;
            let response = await axios.delete(url);
            try {
                this.getpermission();
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
