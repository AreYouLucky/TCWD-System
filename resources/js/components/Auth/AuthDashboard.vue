<template>
    <v-app class="content bg-transparent">
        <v-responsive>
            <v-app-bar :order="order" height="80" class="rounded bg-transparent"  elevation="0">
                <v-btn density="compact" icon="mdi-fullscreen" @click="toggleFullScreen" color="white" class="ml-5  "></v-btn>
                <v-container class="d-flex align-center justify-start">
                    <v-img :src="`/storage/logos/Starbooks-Quiz-Bee.png`" height="80" contain class="animate__animated animate__wobble"></v-img>
                    <v-img :src="`/storage/logos/Starbooks_Logo.png`" height="35" contain class="animate__animated animate__wobble"></v-img>
                    <v-spacer></v-spacer>
                    <v-btn variant="flat" color="light-blue" class=" animate__animated animate__rubberBand border border-b-md" rounded="xl" elevation="5" prepend-icon="mdi-account" 
                            @click="setTab('FOUR')" v-if="tab === 'ONE'"> Register</v-btn>
                    <v-btn variant="flat" color="light-blue" class=" animate__animated animate__rubberBand border border-b-md" rounded="xl" elevation="5" prepend-icon="mdi-account" 
                            @click=" setTab('ONE')" v-else> LOGIN</v-btn>
                </v-container>
            </v-app-bar>
            <v-main>
                <v-window v-model="tab">
                    <v-window-item value="ONE">
                        <v-sheet color="transparent" class="d-flex justify-center align-center animate__animated animate__tada pa-2" min-height="85vh">
                            <login-fields @setToTen="tab = 'FOUR'"></login-fields>
                        </v-sheet>
                    </v-window-item>

                    <v-window-item value="TWO">
                        <v-card color="transparent" class="d-flex justify-center animate__animated animate__pulse pa-2" min-height="83vh">
                            <about-starbooks></about-starbooks>
                        </v-card>
                    </v-window-item>
                    <v-window-item value="THREE">
                        <v-card color="transparent" class="d-flex justify-center animate__animated animate__pulse pa-2" min-height="90vh">
                            <about-whizbee></about-whizbee>
                        </v-card>
                    </v-window-item>
                    <v-window-item value="FOUR">
                        <v-card color="transparent" class=" d-flex justify-center align-center" min-height="85vh">
                            <register-fields></register-fields>
                        </v-card>
                    </v-window-item>
                </v-window>
                <div class="speed-dial">
                    <v-speed-dial location="bottom center" transition="fade-transition" >
                        <template v-slot:activator="{ props: activatorProps }">
                            <v-fab v-bind="activatorProps" size="x-large" icon="mdi-help-circle-outline" color="light-blue"></v-fab>
                        </template>
                        <v-btn key="1" class="ml-12" icon="$success" @click="tab = 'TWO'"></v-btn>
                        <v-btn key="2" class="ml-12 mb-10" icon="$info" @click="tab = 'THREE'"></v-btn>
                    </v-speed-dial>
                </div>
            </v-main>
            <audio :src="`/storage/bgm/login.mp3`" autoplay></audio>
        </v-responsive>
    </v-app>
</template>
<script>
export default {
    data() {
        return {
            order: -1,
            tab: null,
            user: {},
            logout: false,
        };
    },
    methods: {
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
        async playSound() {
            const audio =  new Audio('/storage/bgm/click_button.mp3');
            await audio.play()
        },
        setTab(value){
            this.playSound()
            this.tab=value

        },
        initData() {
        },
    },
    mounted() {
        this.initData();
    },
};
</script>
<style scoped>
.gradient-card {
    background: linear-gradient(to top, #003e7c, #0E68B8, #157eda) !important;
}
.blur{
    background: rgba(12, 51, 84, 10) !important;
    backdrop-filter: blur(2.6px);
    -webkit-backdrop-filter: blur(2.6px);
}
.app-bar{
    box-shadow: 0 4px 30px rgba(255, 255, 255, 0.4)!important;
}
.speed-dial {
    position: fixed !important;
    z-index: 20;
    right: 80px;
    bottom: 40px;
}
.overflow{
    overflow: visible;
}
@media (max-width: 1050px) {
    .navigations {
        background-color: black !important;
    }
}
</style>