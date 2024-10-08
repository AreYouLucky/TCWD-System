<template>
    <div class="animate__animated animate__tada">
        <v-stepper editable :items="['Privacy Notice', 'Account Setup']" width="900" next-text="proceed"
            class="elevation-10 rounded-lg stepper border border-t-xl">
            <template v-slot:item.1>
                <v-card color="transparent" class="text-center">
                    <v-row dense class="animate__animated animate__rubberBand animate__delay-1s">
                        <v-col class="d-flex justify-center align-center mb-4" cols="12" md="12" sm="12">
                            <v-img :src="`/storage/logos/Wait.png`" height="220" contain></v-img>
                        </v-col>
                    </v-row>
                    <v-card-title>
                        Terms and Conditions
                    </v-card-title>
                    <v-card-item class="text-justify">
                        <p class="ma-1">By accessing STARBOOKS QUIZ BEE, you agree to these terms and conditions.
                            We collect personal information and usage data to improve our services and efficiency.
                            We prioritize data security and do not share personal information with third parties without
                            consent, except as required by law. Users must provide accurate information and comply with
                            all laws while using our site. Users must provide accurate information and comply with all
                            laws while using our site. For questions, contact us at <a
                                href="mailto:dost.starbooks@gmail.com">support@starbookswhizbee.com</a>.
                        </p>
                        <p class="mt-5"><a href="https://www.stii.dost.gov.ph/transparency/about-us/stii-privacy-policy"
                                target="_blank">Read more...</a></p>
                    </v-card-item>
                </v-card>
            </template>

            <template v-slot:item.2>
                <v-card class=" bg-transparent pa-5 mt-2">
                    <v-row dense>
                        <v-col cols="12" md="4" sm="12" class="d-flex justify-center align-center">
                            <v-avatar :image="`/storage/avatars/${fields.img}.png`" size="200" class="bg-light-blue-lighten-4 border border-xl">
                            </v-avatar>
                        </v-col>
                        <v-col cols="12" md="8" sm="12">
                            <v-row dense class="d-flex align-center h-100">
                                <v-col cols="12" md="12">
                                    <v-select variant="outlined" label="Avatars" v-model="fields.img" rounded="xl" prepend-icon="mdi-camera"
                                         :items="avatars" :rules="[rules.required]" :error-messages="err.img ? err.img[0] : ''"></v-select>
                                </v-col>
                                <v-col cols="12" md="12">
                                    <v-text-field label="Full name" variant="outlined" v-model="fields.fname"
                                        :rules="[rules.required]" rounded="xl" prepend-icon="mdi-account"
                                        :error-messages="err.fname ? err.fname[0] : ''"></v-text-field>
                                </v-col>
                            </v-row>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select variant="outlined" label="Region" v-model="fields.region" rounded="xl"
                                :items="regions" item-value="region_id" item-title="region_name"
                                @update:modelValue="fetchProvinces" :rules="[rules.required]"
                                :error-messages="err.region ? err.region[0] : ''"></v-select>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select variant="outlined" label="Province" v-model="fields.province" rounded="xl"
                                :rules="[rules.required]" item-value="province_id" item-title="province_name"
                                @update:modelValue="fetchCities" :items="provinces"
                                :error-messages="err.province ? err.province[0] : ''"></v-select>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select variant="outlined" label="City" v-model="fields.city" rounded="xl"
                                item-value="municipality_id" item-title="municipality_name" :items="cities"
                                :rules="[rules.required]" :error-messages="err.city ? err.city[0] : ''"></v-select>
                        </v-col>
                        <v-col cols="12" md="6" sm="12">
                            <v-text-field label="School" variant="outlined" v-model="fields.school"
                                :rules="[rules.required]" rounded="xl" prepend-inner-icon="mdi-town-hall"
                                :error-messages="err.school ? err.school[0] : ''"></v-text-field>
                        </v-col>
                        <v-col cols="12" md="6" sm="12">
                            <v-text-field label="Username" variant="outlined" v-model="fields.username"
                                :rules="[rules.required]" rounded="xl" prepend-inner-icon="mdi-account"
                                :error-messages="err.username ? err.username[0] : ''"></v-text-field>
                        </v-col>
                        <v-col cols="12" md="6" sm="12">
                            <v-text-field label="Password" variant="outlined" v-model="fields.password"
                                :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" rounded="xl"
                                :rules="[rules.required, rules.min]" :type="visible ? 'text' : 'password'"
                                prepend-inner-icon="mdi-lock-outline" @click:append-inner="visible = !visible"
                                :error-messages="err.password ? err.password[0] : ''"></v-text-field>
                        </v-col>
                        <v-col cols="12" md="6" sm="12">
                            <v-text-field label="Confirm Password" variant="outlined"
                                v-model="fields.password_confirmation"
                                :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'" rounded="xl"
                                :rules="[rules.required, rules.min]" :type="visible ? 'text' : 'password'"
                                prepend-inner-icon="mdi-lock-outline" @click:append-inner="visible = !visible"
                                :error-messages="err.password_confirmation ? err.password_confirmation[0] : ''"></v-text-field>
                        </v-col>
                    </v-row>
                    <v-card-actions class="d-flex justify-center">
                        <v-btn text="Save" variant="flat" color="light-blue" width="300" height="40"
                            class=" animate__animated animate__rubberBand mt-5" rounded="xl" elevation="5"
                            :loading="loading" @click="saveProfile"></v-btn>
                    </v-card-actions>
                </v-card>
            </template>
        </v-stepper>
    </div>
</template>
<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
    data() {
        return {
            rules: {
                required: value => !!value || 'Required.',
                min: v => v.length >= 4 || 'Minimum 4 characters',
            },
            finished: false,
            userImage: null,
            userImagePath: '',
            visible: false,
            err: {
                image: null,
                first_name: null,
            },
            fields: {
                img: 'starbooks',
                fname: '',
            },
            loading: false,
            regions: [],
            provinces: [],
            cities: [],
            user: [],
            avatars: [
                'Adventurer', 'Astronaut', 'Brainy' ,'Boy', 'Girl', 'Cool-Monkey', 'Cute-Elephant', 'Leonel', 'Sly-Fox' ,'Sneaky-Snake', 'Twirky',
                'Wise-Turtle','Doctor-Boy', 'Doctor-Girl' , 'Engineer-Boy', 'Engineer-Girl', 'Hacker', 'Scientist-Boy', 'Scientist-Girl', 'Teacher-Boy', 'Teacher-Girl'
                ,'Whiz-Achiever','Whiz-Happy', 'Whiz-Busy', 'Whiz-Ready'
            ]

        };
    },
    methods: {
        fetchRegions() {
            axios.get('/regions').then(
                res => {
                    this.regions = res.data
                }
            )
        },
        fetchProvinces() {
            axios.get('/provinces/' + this.fields.region).then(
                res => {
                    this.provinces = res.data
                }
            )
        },
        fetchCities() {
            axios.get('/cities/' + this.fields.province).then(
                res => {
                    this.cities = res.data
                }
            )
        },
        onChange(e) {
            this.userImage = e.target.files[0];
            this.fields.img = [this.userImage];
            this.previewImage();
        },
        previewImage() {
            const file = this.userImage;
            if (!file) return;

            if (!file.type.match("image.*")) {
                alert("Please select an image file");
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                this.userImagePath = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        saveProfile() {
            this.playSound()
            let formData = new FormData();
            formData.append("img", this.fields.img ? this.fields.img : "");
            formData.append("fname", this.fields.fname ? this.fields.fname : "");
            formData.append("email", this.fields.email ? this.fields.email : "");
            formData.append("school", this.fields.school ? this.fields.school : "");
            formData.append("region", this.fields.region ? this.fields.region : "");
            formData.append("province", this.fields.province ? this.fields.province : "");
            formData.append("city", this.fields.city ? this.fields.city : "");
            formData.append("username", this.fields.username ? this.fields.username : "");
            formData.append("password", this.fields.password ? this.fields.password : "");
            formData.append("password_confirmation", this.fields.password_confirmation ? this.fields.password_confirmation : "");

            this.loading = true
            axios.post('/register', formData).then(
                res => {
                    this.playSelect()
                    this.loading = false
                    this.user = res.data
                    Swal.fire(
                        {
                            icon: "success",
                            title: "Profile Successfully Saved!",
                            confirmButtonColor: "#01A9F4"
                        }
                    );
                    if (this.user.role == 'ADMIN') {
                        window.location = '/admin-dashboard';
                    }
                    else {
                        window.location = '/user-dashboard';
                    }
                }
            ).catch(err => {
                this.playError()
                this.loading = false
                this.err = err.response.data.errors
                Swal.fire(
                    {
                        icon: "error",
                        text: "Please fill out all of the fields!",
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
        initData() {
            this.fetchRegions();
        }
    },
    mounted() {
        this.initData();
    }
}
</script>

<style scoped>
.blur {
    background: rgba(12, 51, 84, 0.4) !important;
    backdrop-filter: blur(2.6px);
    -webkit-backdrop-filter: blur(2.6px);
}

.border-white {
    border: 10px solid rgb(0, 67, 145);
}

@media (max-width: 900px) {
    .stepper {
        width: 90vw !important;
        margin: 0px !important;
        padding-top: 0px !important;
        padding-bottom: 10px !important;
    }
}
</style>
