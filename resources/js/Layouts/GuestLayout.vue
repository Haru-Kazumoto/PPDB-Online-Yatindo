
<script lang="ts">
import { defineComponent } from 'vue';
import Header from '../Components/Header.vue';

export default defineComponent({
    components: {
        Header,
    },
    setup() {


        return {}
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
        <div
            class="max-[700px]:hidden w-[28%] fixed top-0 right-0  bg-no-repeat bg-top	bg-cover		 text-white h-[100vh] flex flex-col justify-center items-center" style="background-image: url(/images/bg-auth.png);">
            <div class="px-4 py-2 bg-white font-bold text-black rounded-full ">PPDB YATINDO</div>
            <img src="/images/LOGO_SMK_YATINDO.png" width="150" class="my-10" />
            <h1 class="font-bold text-xl text-center">SMK <br/>TINTA EMAS INDONESIA</h1>
        </div>
        <!-- Kolom kanan untuk gambar (disembunyikan di mobile) -->
        <!-- Tambahkan elemen teks di atas gambar dan pusatkan -->
        <!-- <div class="d-none d-md-flex flex-column w-50 h-100 position-relative">
                    <div class="h-100 d-flex flex-row justify-content-end align-items-center">
                        <n-image width="500" src="/images/bg-auth.png" preview-disabled style="object-fit: cover;" />
                        <div
                            class="position-absolute top-50 start-50 translate-middle text-white text-center d-flex flex-column align-items-center">
                            <n-image src="/images/logo-yatindo-hd.png" width="150" class="mb-2" />
                            <div class="d-flex flex-column align-items-center">
                                <h2 class="mb-3">SMK-SMP</h2>
                                <h3>TINTA EMAS INDONESIA</h3>
                            </div>
                        </div>
                    </div>
                </div> -->
    </n-notification-provider>
</template>

