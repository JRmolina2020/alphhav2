<template>
    <div>
        <!-- Button trigger modal -->
        <modalbutton
            v-on:clear="clear"
            title="Registrar categoria"
        ></modalbutton>
        <div class="modal fade" id="model">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- panel header -->
                    <div v-if="!form.id" class="modal-header bg-primary">
                        <p class="modal-title">
                            Registrar categoria de productos
                        </p>
                    </div>
                    <div v-else class="modal-header bg-danger">
                        <p class="modal-title">
                            Modificar categoria de productos
                        </p>
                    </div>
                    <!-- end -->
                    <ValidationObserver v-slot="{ invalid }" ref="form">
                        <form
                            method="POST"
                            @submit.prevent="addcategorie(form.id)"
                            autocomplete="off"
                        >
                            <div class="modal-body">
                                <div class="form-group">
                                    <ValidationProvider
                                        :rules="{
                                            required: true,
                                            min: 2,
                                            max: 25
                                        }"
                                        v-slot="{ errors }"
                                    >
                                        <label for>Nombre</label>
                                        <input
                                            type="text"
                                            placeholder="Digitar el nombre de la categoria"
                                            v-bind:class="{
                                                'form-control form-control-sm': true,
                                                'is-invalid': errors.length > 0
                                            }"
                                            v-model="form.name"
                                            onfocus
                                            name="Nombre"
                                        />
                                        <div class="invalid-feedback">
                                            {{ errors[0] }}
                                        </div>
                                    </ValidationProvider>
                                </div>
                                <div class="form-group">
                                    <ValidationProvider
                                        :rules="{
                                            required: true,
                                            min: 2,
                                            max: 30
                                        }"
                                        v-slot="{ errors }"
                                    >
                                        <label for>Descripción</label>
                                        <input
                                            type="text"
                                            placeholder="Digitar la descripción de la categoria"
                                            v-bind:class="{
                                                'form-control form-control-sm': true,
                                                'is-invalid': errors.length > 0
                                            }"
                                            v-model="form.description"
                                            name="Descripción"
                                        />
                                        <div class="invalid-feedback">
                                            {{ errors[0] }}
                                        </div>
                                    </ValidationProvider>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="submit"
                                    :disabled="invalid"
                                    class="btn btn-success btn-md"
                                >
                                    <i class="fas fa-smile-wink"></i>
                                </button>
                            </div>
                        </form>
                    </ValidationObserver>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import modalbutton from "../utilities/button";
export default {
    name: "addcategorie",
    components: {
        modalbutton
    },
    data() {
        return {
            url: "categoria",
            roledata: [],
            form: {
                id: null,
                name: null,
                description: null
            }
        };
    },
    methods: {
        async addcategorie(id) {
            if (id) {
                let url = `${this.url}/${id}`;
                try {
                    let response = await axios.put(url, this.form);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: `La categoria ${this.form.name} ha sido modificada.`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } catch (error) {
                    console.log(error.response);
                }
            } else {
                try {
                    let response = await axios.post(this.url, this.form);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: `La categoria ${this.form.name} ha sido registrada.`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } catch (error) {
                    console.log(error);
                }
            }
            this.clear();
            this.$store.dispatch("ListCategorieA");
            $("#model").modal("hide");
        },
        show(row) {
            this.form.id = row.id;
            this.form.name = row.name;
            this.form.description = row.description;
            $("#model").modal("show");
        },
        clear() {
            this.form.id = "";
            this.form.name = "";
            this.form.description = "";
            this.$refs.form.reset();
        }
    }
};
</script>
