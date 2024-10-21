<template>

    <Head title="Signup" />
    <div class="d-flex flex-column vh-100 justify-content-center align-items-center my-5">
        <span class="fs-3 fw-semibold">Daftarkan informasi anda</span>
        <form action="" class="w-50 d-flex flex-column gap-4 mt-5">
            <d-flex class="flex-column gap-1">
                <Label label="Nomor Whatsapp (AKTIF)" required sizeForm="large" />
                <n-input placeholder="" size="large" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Nama Lengkap" required sizeForm="large" />
                <n-input placeholder="" size="large" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Alamat" required sizeForm="large" />
                <n-input placeholder="" size="large" type="textarea" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Jenis Kelamin" required sizeForm="large" />
                <n-input placeholder="" size="large" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Asal Sekolah" required sizeForm="large" />
                <n-input placeholder="" size="large" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Password" required sizeForm="large" />
                <n-input placeholder="" size="large" type="password"/>
            </d-flex>

            <n-button type="info" color="#161D6F" size="large" attr-type="submit" >Daftar</n-button>

            <!-- <div class="d-flex align-items-center">
                <Link href="" >Daftar disini!</Link>
                <Link href="" class="ms-auto">Lapor lupa akun</Link>
            </div> -->
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import GuestLayout from '../../Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';
import Label from '../../Components/Label.vue';

export default defineComponent({
    components: {
        Head,
        Label
    },
    setup() {

        return {
        };
    },
    layout: GuestLayout,
});
</script>
