<template>

    <Head title="Signup" />

    <!-- Header -->
    <header class="d-flex d-md-none align-items-center p-3 w-100 text-white" style="background-color: #002365;">
        <n-image src="/images/logo-yatindo-hd.png" width="50" class="img-fluid mr-3"/>
        <div class="d-flex flex-column">
            <span class="fw-semibold">PPDB YATINDO</span>
            <span>2025 - 2026</span>
        </div>
    </header>
    
    <div class="d-flex flex-column vh-100 justify-content-center align-items-center mx-lg-5">
        <span class="fs-3 fw-semibold mb-4">Hai, Selamat datang!</span>
        <form @submit.prevent="handleLogin" class="w-75 d-flex flex-column gap-4">
            <div class="d-flex flex-column gap-1">
                <Label label="Username (No. Whatsapp)" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.username" />
            </div>
            <div class="d-flex flex-column gap-1">
                <Label label="Password" required sizeForm="large" />
                <n-input type="password" placeholder="" show-password-on="click" v-model:value="form.password" />
            </div>

            <n-button type="info" color="#161D6F" size="large" attr-type="submit">Masuk</n-button>

            <div class="d-flex align-items-center">
                <Link href="" @click.prevent="showRegisterChoice">Daftar disini!</Link>
                <Link href="" class="ms-auto">Lapor lupa akun</Link>
            </div>
        </form>
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
import { defineComponent } from 'vue'
import GuestLayout from '../../Layouts/GuestLayout.vue';
import Label from '../../Components/Label.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default defineComponent({
    setup() {
        const form = useForm({
            username: '',
            password: '',
        });

        function handleLogin() {
            form.post(route('login'), {
                onSuccess: () => {
                    Swal.fire('Sukses masuk!', 'Selamat datang.', 'success');
                },
                onError: () => {
                    Swal.fire('Gagal masuk!', 'Coba lagi.', 'error');
                }
            })
        }

        function showRegisterChoice() {
            Swal.fire({
                title: 'Pilih Jenjang',
                text: 'Silahkan pilih jenjang yang diinginkan:',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'SMK',
                cancelButtonText: 'SMP',
                confirmButtonColor: '#f36b1d',
                cancelButtonColor: '#002365',
            }).then((result) => {
                if (result.isConfirmed) {
                    router.get(route('register.smk'));
                } else {
                    router.get(route('register.smp'));
                }
            });
        }

        return {
            showRegisterChoice,
            handleLogin,
            form,
        }
    },
    layout: GuestLayout,
    components: {
        Label,
        Head,
        Link
    }
})
</script>