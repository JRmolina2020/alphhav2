<template>
    <div>
        <Search-Item titleinput="Buscar Categoria de productos"></Search-Item>
        <div class="table-responsive">
            <v-table
                :data="categories"
                :currentPage.sync="currentPage"
                :filters="filters"
                :pageSize="3"
                @totalPagesChanged="totalPages = $event"
                class="table table-striped table-valign-middle table-borderless mt-3 table-bordered"
            >
                <thead slot="head">
                    <tr>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody slot="body" slot-scope="{ displayData }">
                    <tr v-for="(row, index) in displayData" :key="index">
                        <td scope="row">{{ row.name }}</td>
                        <td>
                            <description-categorie
                                v-bind:row="row"
                            ></description-categorie>
                        </td>
                        <td>
                            <button
                                type="button"
                                @click="thestatus(row)"
                                v-bind:class="{
                                    'btn   btn-flat btn-sm': true,
                                    ' btn-success': row.status,
                                    'btn-danger': row.status == 0
                                }"
                            >
                                <i class="fas fa-power-off"></i>
                            </button>
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
        </div>
        <!-- {{ (this.rodo = currentUser.name) }} -->
        <smart-pagination
            :currentPage.sync="currentPage"
            :totalPages="totalPages"
        />
    </div>
</template>
<script>
import SearchItem from "../utilities/search";
import { mapState, mapMutations, mapActions } from "vuex";
import DescriptionCategorie from "./descriptionview";

export default {
    components: {
        DescriptionCategorie,
        SearchItem
    },
    data() {
        return {
            url: "categoria/",
            rodo: "",
            currentPage: 1,
            totalPages: 0
        };
    },
    computed: {
        ...mapState(["filters", "categories", "status"])
    },
    created() {
        this.getcategories();
    },
    methods: {
        getcategories() {
            this.$store.dispatch("ListCategorieA");
        },
        async remove(row) {
            let url = this.url + row.id;
            let response = await axios.delete(url);
            try {
                this.getcategories();
                Swal.fire({
                    title: `La categoria ${row.name} ha sido Eliminada`,
                    icon: "success"
                });
            } catch (error) {
                console.log(error);
            }
        },
        async thestatus(row) {
            if (row.status == 1) {
                let url = this.url + "locked/" + row.id;
                let response = await axios.put(url);
                Swal.fire({
                    title: `La categoria ${row.name} ha sido Bloqueada`,
                    icon: "success"
                });
            } else {
                let url = this.url + "available/" + row.id;
                let response = await axios.put(url);
                Swal.fire({
                    title: `La categoria ${row.name} ha sido Habilitada`,
                    icon: "success"
                });
            }
            this.getcategories();
        }
    }
};
</script>
