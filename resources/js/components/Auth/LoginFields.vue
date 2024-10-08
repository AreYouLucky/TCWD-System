<template>
    <v-form @submit.prevent="submitForm">
        <v-card class="pa-13 card-container border border-t-xl" elevation="10"
            width="500" rounded="xl">
            <v-card-item class="mt-2 card-items">
                <v-row dense class="animate__animated animate__rubberBand animate__delay-1s">
                    <v-col class="d-flex justify-center align-center mb-4" cols="12" md="12" sm="12">
                        <v-img :src="`/storage/logos/login_whiz.png`" height="220" contain></v-img>
                    </v-col>
                </v-row>

                <v-text-field v-model="fields.username" class="mb-3 " label="Username" rounded="xl"
                    :rules="[rules.required, rules.min]" prepend-inner-icon="mdi-email-outline" variant="outlined"
                    :error-messages="err.username ? err.username[0] : ''" required></v-text-field>

                <v-text-field v-model="fields.password" label="Password" :rules="[rules.required]" rounded="xl" class=""
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" :type="visible ? 'text' : 'password'"
                    placeholder="Enter your password" prepend-inner-icon="mdi-lock-outline" variant="outlined"
                    @click:append-inner="visible = !visible" :error-messages="err.password ? err.password[0] : ''"
                    required></v-text-field>
                <v-row class="px-10 mb-10 mt-2 d-flex justify-center">
                    <v-btn block :loading="loading" class="my-5 animate__animated animate__rubberBand animate__delay-1s grow-rotate"
                        color="light-blue" rounded="xl" size="large" type="submit">
                        Log In
                    </v-btn>
                    <span class="mt-4 text-medium-emphasis register-text grow-rotate" @click="register()">Don't have an
                        account?</span>
                </v-row>
            </v-card-item>
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
            this.playSound();
            this.loading = true
            axios.post('/login', this.fields).then(res => {
                this.playSelect()
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
                this.errors = error.response.data.errors.logs;
                this.err = error.response.data;
                this.playError()
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
        async playSound() {
            const audio =  new Audio('/storage/bgm/click_button.mp3');
            await audio.play()
        },
        async playError(){
            const audio =  new Audio('/storage/bgm/error.mp3');
            await audio.play()
        },
        async playSelect(){
            const audio =  new Audio('/storage/bgm/success.mp3');
            await audio.play()
        },
        register() {
            this.$emit('setToTen');
            this.playSound();
        }
    },
    mounted() {

    },
}
</script>
<style scoped>
.blur {
    background: rgba(12, 51, 84, 0.4) !important;
    backdrop-filter: blur(2.6px);
    -webkit-backdrop-filter: blur(2.6px);
}

.register-text {
    font-size: .8rem;
    cursor: pointer;
}

@media (max-width: 500px) {
    .card-container {
        width: 100% !important;
        margin: 0px !important;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }

    .card-items {
        padding: 0px !important;
        margin: 0px;
    }

    .blur {
        background: rgba(12, 51, 84, 0.4) !important;
        backdrop-filter: blur(2.6px);
        -webkit-backdrop-filter: blur(2.6px);
    }
}
</style>