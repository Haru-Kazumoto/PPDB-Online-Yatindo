<script lang="ts">
import { defineComponent, ref } from 'vue';
import GuestLayout from '../../Layouts/GuestLayout.vue';

export default defineComponent({
    setup() {
        const current = ref(0);
        const currentStatus = ref('process');

        const next = () => {
            if (current.value < 1) {
                current.value++;
            }
        };

        const prev = () => {
            if (current.value > 0) {
                current.value--;
            }
        };

        return {
            current,
            currentStatus,
            next,
            prev,
        };
    },
    layout: GuestLayout
});
</script>

<template>
    <div class="flex flex-col items-center justify-center ">
        <div class="form-wrapper w-[30rem] my-24 flex flex-col gap-2">

            <h1 class="font-semibold text-3xl text-center">Daftar SMK</h1>
            <n-input type="text" aria-label="asdasd" placeholder="Nomor Whatsapp" />

            <n-input type="text" placeholder="Nama Lengkap" />
            <n-input type="text" placeholder="Alamat" />
            <n-input type="text" placeholder="Jenis Kelamin" />
            <n-input type="text" placeholder="Asal Sekolah" />
            <n-divider />
            <n-input type="text" placeholder="Password" />
            <n-button type="info" >
                Kirim
            </n-button>
        </div>
    </div>
</template>