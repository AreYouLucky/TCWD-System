<template>
    <v-form @submit.prevent="submitForm">
        <v-card class="px-10 py-15 elevation-5 blur d-flex align-center" max-width="900" rounded="xl">
            <v-card-text class="d-flex justify-center">
                <section style="max-width: 360px; width: 100%;">
                    <article class="text-center text-light-blue mb-7">
                        <v-avatar :image="`/storage/logos/logo.png`" size="85" class="ma-2" style="border: 3px solid #3EB6D8;"></v-avatar><br>
                        <span class="text-h4 montserrat-black-900">
                            TCWD SYSTEM
                        </span> <br>
                        <v-divider class="mx-15 my-4" color="black"></v-divider>
                    </article>

                    <article>
                        <v-text-field v-model="fields.username" label="Username" rounded="xl" density="comfortable"
                            :rules="[rules.required, rules.min]" prepend-inner-icon="mdi-email-outline" class="mb-2"
                            variant="outlined" :error-messages="err.username ? err.username[0] : ''" color="blue"
                            required></v-text-field>

                        <v-text-field v-model="fields.password" label="Password" :rules="[rules.required]" rounded="xl"
                            class="" :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" density="comfortable"
                            :type="visible ? 'text' : 'password'" color="blue" placeholder="Enter your password"
                            prepend-inner-icon="mdi-lock-outline" variant="outlined"
                            @click:append-inner="visible = !visible"
                            :error-messages="err.password ? err.password[0] : ''" required></v-text-field>
                        <v-row class="ma-2 d-flex justify-center">
                            <v-btn :loading="loading" class="my-1 px-5" color="light-blue" rounded="xl" type="submit"
                                prepend-icon="mdi-home" width="200">
                                Log In
                            </v-btn>
                        </v-row>
                    </article>
                </section>
            </v-card-text>
        </v-card>
    </v-form>
</template>
<script>
import Swal from "sweetalert2";
export default {
    data() {
        return {
            visible: false,
            rules: {
                required: value => !!value || 'Required.',
                min: v => v.length >= 4 || 'Minimum 4 characters',
            },
            loading: false,
            fields: {},
            err: {},
            user: {}
        };
    },
    methods: {
        submitForm() {
            this.loading = true
            axios.post('/login', this.fields).then(res => {
                Swal.fire(
                    {
                        icon: "success",
                        title: "Login Successful!",
                        confirmButtonColor: "#01A9F4",
                        confirmButtonText: `<span class="text-white">Let's Go! <span>`,
                    }
                );
                this.loading = false
                this.user = res.data
                if (this.user.role == 'ADMIN') {
                    window.location = '/admin-dashboard';
                }
                else {
                    window.location = '/user-dashboard';
                }

            }).catch(error => {
                this.loading = false
                this.errors = error.response.data.logs;
                this.err = error.response.data;
                Swal.fire(
                    {
                        icon: "error",
                        text: 'Invalid Credentials!',
                        confirmButtonColor: "#c7063d",
                        confirmButtonText: `<span class="text-white">Okay! <span>`,
                    }
                );
            })

        },
    },
    mounted() {

    },
}
</script>
<style scoped>
.blur {
    width: 600px;
}

@media (max-width: 500px) {
    .blur {
        width: 360px;
    }
}
</style>