<script lang="ts">
import { defineComponent } from 'vue';
import Header from '../Components/Header.vue';
import { GlobalThemeOverrides } from 'naive-ui'

export default defineComponent({
    components: {
        Header,
    },
    setup() {
        const path = window.location.pathname; // Contoh: "/register-smp"

        // Pisahkan path untuk mendapatkan bagian terakhir dari URL
        const registerType = path.split('/').pop(); // Akan menghasilkan 'r
        const isSMP = registerType === 'register-smp';
        const isSMK = registerType === 'register-smk';
        const schoolType = isSMP ? 'SMP' : 'SMK';

        const logoSMK = "/images/LOGO_SMK_YATINDO.png"
        const logoSMP = "/images/LOGO_SMP_YATINDO.png"

        const validLogo = isSMK ? logoSMK : logoSMP;

        const themeOverrides: GlobalThemeOverrides = {
            Input: {
                caretColor: "#1828A0FF",
                loadingColor: "#A0181AFF",
                textDecorationColor: "rgba(12, 131, 250, 1)",
                borderHover: "1px solid #161D6F",
                borderFocus: "1px solid #161D6F",
            }
        }

        return {
            isSMP,
            isSMK,
            schoolType,
            validLogo,
            themeOverrides
        }
    }
})
</script>

<style scoped></style>

<template>
    <n-config-provider :theme-overrides="themeOverrides">
        <n-notification-provider>
            <!-- Kolom kiri untuk konten utama -->
            <div class="w-full min-[700px]:w-[65%] ">
                <slot />
            </div>
            <div class="max-[700px]:hidden w-[28%] fixed top-0 right-0  bg-no-repeat bg-top	bg-cover	text-white h-[100vh] flex flex-col justify-center items-center"
                style="background-image: url(/images/bg-auth.png);">
                <div class="px-4 py-2 bg-white font-bold text-black rounded-full ">PPDB YATINDO 2025-2026</div>
                <img src="/images/logo-yatindo-hd.png" width="200" class="my-10" />
                <h1 class="font-bold text-xl text-center">YAYASAN<br />TINTA EMAS INDONESIA</h1>
            </div>
        </n-notification-provider>
    </n-config-provider>
</template>
