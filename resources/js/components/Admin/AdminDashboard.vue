<template>
    <v-app class="bg-blue-grey-lighten-2">
        <v-layout>
            <v-navigation-drawer v-model="drawer" :rail="rail" floating
                image="https://cdn.vuetifyjs.com/images/backgrounds/bg-2.jpg"
                class="navigations bg-blue rounded-tr-xl pa-5" elevation="8" min-width="70">
                <v-list-item nav class="text-center  my-2">
                    <v-img :src="`/storage/logos/logo.png`" height="120" contain></v-img>
                    <span class="text-h6 montserrat-black-900" >TCWD SYSTEM</span>
                    <v-divider></v-divider>
                </v-list-item>
                        <v-card append-icon="mdi-exit-to-app mb-5" class="mx-auto blur rounded-lg pa-2" v-bind="props"
                            max-width="344" 
                            rel="noopener" subtitle="Manage System"
                            title="Administrator" @click="logout = true"></v-card>
                <v-list>
                    <v-divider>Menu</v-divider>
                    <v-list-item @click="tab = 'ONE'" prepend-icon="mdi-account"
                        :class="['px-4', 'mt-5', 'text-caption', 'rounded-xl', 'rounded-bs-xl', tab === 'ONE' ? 'bg-light-blue' : 'bg-dark']">
                        <span class="small">Users </span>
                    </v-list-item>
                    <v-list-item @click="tab = 'TWO'" prepend-icon="mdi-cash-register"
                        :class="['px-4', 'text-caption', 'rounded-xl', 'rounded-bs-xl', tab === 'TWO' ? 'bg-light-blue' : 'bg-dark']">
                        <span class="small">Billing </span>
                    </v-list-item>
                    <v-list-item @click="tab = 'THREE'" prepend-icon="mdi-hand-coin"
                        :class="['px-4', 'text-caption', 'rounded-xl', 'rounded-bs-xl', tab === 'THREE' ? 'bg-light-blue' : 'bg-dark']">
                        <span class="small">Rate </span>
                    </v-list-item>
                    <v-list-item @click="tab = 'FOUR'" prepend-icon="mdi-cash-plus"
                        :class="['px-4', 'text-caption', 'rounded-xl', 'rounded-bs-xl', tab === 'FOUR' ? 'bg-light-blue' : 'bg-dark']">
                        <span class="small">Additional Fees </span>
                    </v-list-item>
                    <v-list-item @click="tab = 'FIVE'" prepend-icon="mdi-message-alert"
                        :class="['px-4', 'text-caption', 'rounded-xl', 'rounded-bs-xl', tab === 'FIVE' ? 'bg-light-blue' : 'bg-dark']">
                        <span class="small">Concerns </span>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>
            <v-main>
                <v-container class="d-flex align-center mt-3 rounded-xl" style="width: 95%; height: 70px;">
                    <v-spacer></v-spacer>
                    <v-app-bar-nav-icon variant="text" @click.stop="drawer = !drawer" color="yellow"></v-app-bar-nav-icon>
                </v-container>
                <v-window v-model="tab">
                    <v-window-item value="ONE">
                        <v-card color="transparent" class="pa-5 d-flex justify-center">
                            <users-page ref="ManageParticipants" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="THREE">
                        <v-card color="transparent" class="pa-2 d-flex justify-center">
                            <manage-admin ref="ManageAdmin" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="FOUR">
                        <v-card color="transparent" class="pa-5 d-flex justify-center">
                            <score-logs ref="ScoreLogs" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="FIVE">
                        <v-card color="transparent" class="pa-5 d-flex justify-center">
                            <login-logs ref="LoginLogs" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="SIX">
                        <v-card color="transparent" class="pa-2 d-flex justify-center">
                            <manage-questions ref="ManageQuestions" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="SEVEN">
                        <v-card color="transparent" class="pa-10 d-flex justify-center align-start" min-height="90vh">
                            <manage-difficulty ref="ManageDifficulty" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="EIGHT">
                        <v-card color="transparent" class="pa-5 d-flex justify-center" min-height="90vh">
                            <users-dashboard ref="UserDashboard" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="NINE">
                        <v-card color="transparent" class="pa-10 d-flex justify-center" min-height="90vh">
                            <manage-profile ref="ManageProfile" />
                        </v-card>
                    </v-window-item>
                    <v-window-item value="TEN">
                        <v-card color="transparent" class="pa-5 d-flex justify-center" min-height="90vh">
                            <about-starbooks></about-starbooks>
                        </v-card>
                    </v-window-item>
                    <v-window-item value="ELEVEN">
                        <v-card color="transparent" class="pa-5 d-flex justify-center" min-height="90vh">
                            <about-whizbee></about-whizbee>
                        </v-card>
                    </v-window-item>
                </v-window>
            </v-main>
        </v-layout>

        <v-dialog v-model="logout" width="auto">
            <v-card max-width="400" prepend-icon="mdi-update" rounded="xl">
                <v-card-text class="text-center"> Are you sure you want <br> to logout?</v-card-text>
                <template v-slot:actions>
                    <v-spacer></v-spacer>
                    <v-btn class="mx-2 mb-4" @click="logout = false" variant="flat" rounded="xl"
                        color="red"><v-icon>mdi-alpha-x-circle</v-icon>NO</v-btn>
                    <v-btn class="mx-2 mb-4" text="Confirm" href="/logout" variant="flat" rounded="xl"
                        color="light-blue-darken-2"><v-icon>mdi-check-circle</v-icon> YES</v-btn>
                    <v-spacer></v-spacer>
                </template>
            </v-card>
        </v-dialog>
    </v-app>
</template>
<script>
export default {
    data() {
        return {
            drawerRight: false,
            drawer: true,
            rail: false,
            order: 0,
            tab: null,
            user: {},
            logout: false,
        };
    },
    watch: {
        tab(newTab, oldTab) {
            this.initializeComponent(newTab);
        }
    },
    methods: {
        fetchCurrentUser() {
            axios.get("/user").then((res) => {
                this.user = res.data;
            });
        },
        toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch((err) => {
                    console.error(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
                });
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        },
        initializeComponent(tab) {
            switch (tab) {
                case 'TWO':
                    this.$nextTick(() => {
                        this.$refs.ManageParticipants.initData();
                    });
                    break;
                case 'THREE':
                    this.$nextTick(() => {
                        this.$refs.ManageAdmin.initData();
                    });
                    break;
                case 'FOUR':
                    this.$nextTick(() => {
                        this.$refs.ScoreLogs.initData();
                    });
                    break;
                case 'FIVE':
                    this.$nextTick(() => {
                        this.$refs.LoginLogs.initData();
                    });
                    break;
                case 'SIX':
                    this.$nextTick(() => {
                        this.$refs.ManageQuestions.initData();
                    });
                    break;
                case 'SEVEN':
                    this.$nextTick(() => {
                        this.$refs.ManageDifficulty.initData();
                    });
                    break;
                case 'EIGHT':
                    this.$nextTick(() => {
                        this.$refs.UserDashboard.initData();
                    });
                    break;
                case 'NINE':
                    this.$nextTick(() => {
                        this.$refs.ManageProfile.initData();
                    });
                    break;
                default:
                    break;
            }
        },
        initData() {
            this.fetchCurrentUser();
        },
    },
    mounted() {
        this.initData();
    },
};
</script>
<style scoped>
.blur {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10.4px);
    -webkit-backdrop-filter: blur(10.4px);
}


.gradient-card {
    background: linear-gradient(to bottom, #000000, #00203c) !important;
}

.nav-text {
    font-weight: .4rem !important;
}

.content {
    background-color: rgb(230, 230, 230);
}

.small {
    font-size: 12px !important;
    font-weight: bolder !important;
}
</style>