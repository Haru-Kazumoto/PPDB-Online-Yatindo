<template>
    <n-notification-provider>
        <div class="d-flex vh-100">
            <!-- <Header class="d-md-none" /> Header hanya muncul di mobile -->

            <div class="d-flex flex-row flex-grow-1">
                <!-- Kolom kiri untuk konten utama -->
                <div class="d-flex flex-column w-100">
                    <slot />
                </div>

                <!-- Kolom kanan untuk gambar (disembunyikan di mobile) -->
                <div class="d-none d-md-flex flex-column w-50 h-100 position-relative">
                    <div class="h-100 d-flex flex-row justify-content-end align-items-center">
                        <n-image width="500" src="/images/bg-auth.png" preview-disabled style="object-fit: cover;" />
                        <!-- Tambahkan elemen teks di atas gambar dan pusatkan -->
                        <div
                            class="position-absolute top-50 start-50 translate-middle text-white text-center d-flex flex-column align-items-center">
                            <n-image src="/images/logo-yatindo-hd.png" width="150" class="mb-2" />
                            <div class="d-flex flex-column align-items-center">
                                <h2 class="mb-3">SMK-SMP</h2>
                                <h3>TINTA EMAS INDONESIA</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </n-notification-provider>
</template>

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