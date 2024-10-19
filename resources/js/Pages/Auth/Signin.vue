<template>

    <Head title="Signup" />
    <div class="d-flex flex-column vh-100 justify-content-center align-items-center">
        <span class="fs-3 fw-semibold mb-5">Hai, Selamat datang!</span>
        <form @submit.prevent="" class="w-50 d-flex flex-column gap-4">

            <div class="d-flex flex-column gap-1">
                <Label label="Username" required sizeForm="large" />
                <n-input placeholder="" size="large" />
            </div>
            <div class="d-flex flex-column gap-1">
                <Label label="Password" required sizeForm="large" />
                <n-input placeholder="" size="large" />
            </div>

            <n-button type="info" color="#161D6F" size="large">Masuk</n-button>

            <div class="d-flex align-items-center">
                <Link @click.prevent="showRegisterChoice">Daftar disini!</Link>
                <Link class="ms-auto">Lapor lupa akun</Link>
            </div>

        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import GuestLayout from '../../Layouts/GuestLayout.vue';
import Label from '../../Components/Label.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default defineComponent({
    setup() {
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
            showRegisterChoice
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