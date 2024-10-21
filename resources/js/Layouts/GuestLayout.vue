
<script lang="ts">
import { defineComponent } from 'vue';
import Header from '../Components/Header.vue';

export default defineComponent({
    components: {
        Header,
    },
    setup() {
        const path = window.location.pathname; // Contoh: "/register-smp"

        // Pisahkan path untuk mendapatkan bagian terakhir dari URL
        const registerType = path.split('/').pop(); // Akan menghasilkan 'r
        console.log(registerType)
        const isSMP = registerType === 'register-smp';
        const isSMK = registerType === 'register-smk';
        const schoolType = isSMP ? 'SMP' : 'SMK';

        const logoSMK = "/images/LOGO_SMK_YATINDO.png"
        const logoSMP = "/images/LOGO_SMP_YATINDO.png"

        const validLogo = isSMK ? logoSMK : logoSMP

        return {
            isSMP,
            isSMK,
            schoolType,
            validLogo
        }
    }
})
</script>

<style scoped></style>

<template>
    <n-notification-provider>
        <!-- Kolom kiri untuk konten utama -->
        <div class="w-full min-[700px]:w-[65%] ">
            <slot />
        </div>
        <div class="max-[700px]:hidden w-[28%] fixed top-0 right-0  bg-no-repeat bg-top	bg-cover		 text-white h-[100vh] flex flex-col justify-center items-center"
            style="background-image: url(/images/bg-auth.png);">
            <div class="px-4 py-2 bg-white font-bold text-black rounded-full ">PPDB YATINDO</div>
            <img :src="validLogo" width="150" class="my-10" />
            <h1 class="font-bold text-xl text-center">{{ schoolType }} <br />TINTA EMAS INDONESIA</h1>
        </div>
    </n-notification-provider>
</template>

