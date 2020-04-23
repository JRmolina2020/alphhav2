<template>
    <div class="login-box mt-5">
        <div class="login-logo">
            <a href> <b>Admin</b>LTE </a>
        </div>
        <ValidationObserver v-slot="{ invalid }" ref="form">
            <form method="POST" @submit.prevent="Login" autocomplete="off">
                <div class="form-group">
                    <ValidationProvider
                        :rules="{ required: true }"
                        v-slot="{ errors }"
                    >
                        <input
                            type="email"
                            v-bind:class="{
                                'form-control form-control-sm': true,
                                'is-invalid': errors.length > 0
                            }"
                            v-model="form.email"
                            placeholder="email"
                            name="email"
                            autofocus
                        />
                        <div class="invalid-feedback">{{ errors[0] }}</div>
                    </ValidationProvider>
                </div>
                <div class="form-group">
                    <ValidationProvider
                        :rules="{ required: true, min: 5, max: 10 }"
                        v-slot="{ errors }"
                    >
                        <input
                            type="password"
                            v-bind:class="{
                                'form-control form-control-sm': true,
                                'is-invalid': errors.length > 0
                            }"
                            v-model="form.password"
                            placeholder="password"
                            name="password"
                        />
                        <div class="invalid-feedback">{{ errors[0] }}</div>
                    </ValidationProvider>
                </div>
                <button
                    type="submit"
                    :disabled="invalid"
                    class="btn btn-danger btn-sm"
                >
                    Ingresar
                </button>
            </form>
        </ValidationObserver>
    </div>
</template>
<script>
export default {
    name: "login",
    data() {
        return {
            url: "login",

            form: {
                email: null,
                password: null
            }
        };
    },
    methods: {
        Login() {
            this.$refs.form.validate().then(success => {
                if (!success) {
                    return;
                } else {
                    axios
                        .post(this.url, {
                            email: this.form.email,
                            password: this.form.password
                        })
                        .then(response => {
                            window.location.replace("/categoria");
                        })
                        .catch(error => {
                            this.form.password = null;
                        });
                    this.$nextTick(() => {
                        this.$refs.form.reset();
                    });
                }
            });
        }
    }
};
</script>
