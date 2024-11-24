<template>

    <Head title="Signup" />
    <header class="d-flex d-md-none align-items-center p-3 w-100 text-white" style="background-color: #f36b1d;">
        <n-image src="/images/logo-yatindo-hd.png" width="50" class="img-fluid mr-3" />
        <div class="d-flex flex-column">
            <span class="fw-semibold">PPDB YATINDO</span>
            <span>2025 - 2026</span>
        </div>
    </header>
    <div class="d-flex flex-column vh-100 justify-content-center align-items-center my-5 mx-lg-5">
        <span class="fs-3 fw-semibold">Daftarkan informasi anda</span>
        <div class="w-75 d-flex flex-column gap-4 mt-5">
            <div class="flex-column gap-1">
                <Label label="Nomor Whatsapp (AKTIF)" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.phone" />
            </div>
            <div class="flex-column gap-1">
                <Label label="Nama Lengkap" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.fullname" />
            </div>
            <div class="flex-column gap-1">
                <Label label="Alamat" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.address" type="textarea" />
            </div>
            <div class="flex-column gap-1">
                <Label label="Jenis Kelamin" required sizeForm="large" />
                <n-select :options="genderOptions" placeholder="" size="large" v-model:value="form.gender" />
            </div>
            <div class="flex-column gap-1">
                <Label label="Asal Sekolah" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.school_origin" />
            </div>
            <div class="flex-column gap-1">
                <Label label="Password" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.password" type="password" />
            </div>

            <div class="d-flex flex-column gap-2">
                <n-button type="info" color="#f36b1d" size="large" attr-type="submit" @click="handleRegister">Daftar
                    SMK</n-button>
                <Link :href="route('login')" class="d-flex justify-content-center">Masuk dengan akun disini</Link>
            </div>

        </div>
    </div>
</template>

<style scoped>
/* Tambahan styling jika diperlukan */
header {
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 10;
}
</style>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import GuestLayout from '../../Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Label from '../../Components/Label.vue';
import Swal from 'sweetalert2';
import { genderOptions } from '../../Utils/menus';

export default defineComponent({
    components: {
        Head,
        Label,
        Link
    },
    setup() {
        const form = useForm({
            phone: '',
            fullname: '',
            address: '',
            gender: '',
            school_origin: '',
            password: '',
            grade: "SMK",
        });

        function handleRegister() {
            form.post(route('register'), {
                onSuccess: (page) => {
                    const message = page.props.flash as any;

                    Swal.fire(message.success, '', 'success');
                },
                onError: () => {
                    Swal.fire('Form kosong', 'Dimohon mengisi form dengan tanda <span class="fw-semibold text-danger">*</span>', 'warning');
                }
            });
        }

        return {
            handleRegister,
            form,
            genderOptions,
        };
    },
    layout: GuestLayout,
});
</script>
