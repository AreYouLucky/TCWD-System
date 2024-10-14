<template>
    <v-app class="bg-transparent">
        <v-main>
            <v-window v-model="tab">
                <v-window-item value="ONE">
                    <v-sheet color="transparent"
                        class="d-flex justify-center align-center animate__animated animate__tada pa-2"
                        min-height="85vh">
                        <login-fields></login-fields>
                    </v-sheet>
                </v-window-item>
            </v-window>
        </v-main>
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

        async playSound() {
            const audio = new Audio('/storage/bgm/click_button.mp3');
            await audio.play()
        },
        setTab(value) {
            this.playSound()
            this.tab = value

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

.blur {
    background: rgba(12, 51, 84, 10) !important;
    backdrop-filter: blur(2.6px);
    -webkit-backdrop-filter: blur(2.6px);
}

.app-bar {
    box-shadow: 0 4px 30px rgba(255, 255, 255, 0.4) !important;
}

.speed-dial {
    position: fixed !important;
    z-index: 20;
    right: 80px;
    bottom: 40px;
}

.overflow {
    overflow: visible;
}

@media (max-width: 1050px) {
    .navigations {
        background-color: black !important;
    }
}
</style>