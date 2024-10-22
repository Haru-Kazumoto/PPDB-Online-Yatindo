<template>

    <Head title="Signup" />
    <div class="d-flex flex-column vh-100 justify-content-center align-items-center my-5">
        <span class="fs-3 fw-semibold">Daftarkan informasi anda</span>
        <div  class="w-50 d-flex flex-column gap-4 mt-5">
            <d-flex class="flex-column gap-1">
                <Label label="Nomor Whatsapp (AKTIF)" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.phone" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Nama Lengkap" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.fullname" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Alamat" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.address" type="textarea" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Jenis Kelamin" required sizeForm="large" />
                <n-select :options="genderOptions" placeholder="" size="large" v-model:value="form.gender" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Asal Sekolah" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.school_origin" />
            </d-flex>
            <d-flex class="flex-column gap-1">
                <Label label="Password" required sizeForm="large" />
                <n-input placeholder="" size="large" v-model:value="form.password" type="password"/>
            </d-flex>

            <n-button type="info" color="#161D6F" size="large" attr-type="submit" @click="handleRegister">Daftar SMK</n-button>

        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import GuestLayout from '../../Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Label from '../../Components/Label.vue';
import Swal from 'sweetalert2';
import { genderOptions } from '../../Utils/menus';

export default defineComponent({
    components: {
        Head,
        Label,
    },
    setup() {
        const form = useForm({
            phone: '',
            fullname: '',
            address: '',
            gender: '',
            school_origin: '',
            password: '',
            grade: "SMP",
        });

        function handleRegister(){
            form.post(route('register'), {
                onSuccess: (page) => {
                    const message = page.props.flash as any;

                    Swal.fire(message.success, '', 'success');
                },
                onError: () => {
                    Swal.fire('Cek kembali form nya', '', 'error');
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
