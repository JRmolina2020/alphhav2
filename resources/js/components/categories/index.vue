<template>
    <div>
        <Add-Categorie ref="form_categorie"></Add-Categorie>
        <List-Categorie class="mt-3" v-on:show="show"></List-Categorie>
    </div>
</template>
<script>
import ListCategorie from "./list";
import AddCategorie from "./add";
export default {
    components: {
        ListCategorie,
        AddCategorie
    },
    methods: {
        show(row) {
            this.$refs.form_categorie.show(row);
        }
    }
};
</script>
