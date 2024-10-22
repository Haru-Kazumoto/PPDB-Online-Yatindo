<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-2">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 my-2" style="background-color:#002365">
                <div class="card-body d-flex align-items-center">
                    <span class="fs-3 fw-semibold text-white">Tambah Gelombang PPDB</span>
                </div>
            </div>

            <!-- Back Button -->
            <Back :route="route('registration-path.index')" />

            <!-- Form Card -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body d-flex flex-column gap-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Nama" required />
                            <n-input placeholder="" size="large" v-model:value="form.name"
                                @input="(value) => form.name = value.toUpperCase()" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Jumlah Penerimaan" required />
                            <n-input placeholder="" size="large" v-model:value="form.max_quota"
                                @input="(value) => form.max_quota = value.replace(/\D/g, '')" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <Label label="Sub tipe gelombang" required />
                            <n-select placeholder="" size="large" v-model:value="form.sub_type" :options="subTipeJalurOptions"/>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <Label label="Waktu Dibuka" required />
                            <n-date-picker value-format="yyyy-MM-dd HH:mm:ss" type="datetime" placeholder=""
                                size="large" v-model:formatted-value="form.start_date" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <Label label="Waktu Ditutup" required />
                            <n-date-picker value-format="yyyy-MM-dd HH:mm:ss" type="datetime" placeholder=""
                                size="large" v-model:formatted-value="form.end_date" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <Label label="Nama Bank" required />
                            <n-select placeholder="" size="large" :options="bankOptions"
                                v-model:value="form.bank_name" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <Label label="Nomor Rekening" required />
                            <n-input placeholder="" size="large" v-model:value="form.bank_number_account" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <Label label="Pemilik Rekening" required />
                            <n-input placeholder="" size="large" v-model:value="form.bank_username" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Biaya Pendaftaran" required />
                            <n-input placeholder="" size="large" v-model:value="form.registration_price">
                                <template #prefix>
                                    Rp
                                </template>
                            </n-input>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Kode Gelombang" required />
                            <n-input placeholder="" size="large" v-model:value="form.batch_code" />
                        </div>
                    </div>

                    <n-button size="medium" type="info" style="width: 10rem;" color="#002365"
                        @click="submitForm">Tambah</n-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
import { defineComponent, ref, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Back from '../../../Components/Back.vue';
import Label from '../../../Components/Label.vue';
import Swal from 'sweetalert2';
import { jenjangOptions, subTipeJalurOptions, bankOptions } from "../../../Utils/menus.ts";

export default defineComponent({
    components: {
        Back,
        Label
    },
    setup() {
        const page = usePage();
        const path = page.props.registrationPath;

        const form = useForm({
            name: '',
            max_quota: null,
            start_date: path.start_date,
            end_date: path.end_date,
            bank_name: '',
            bank_username: "",
            bank_number_account: '',
            registration_price: null,
            batch_code: '',
            registration_path_id: path.id,
            sub_type: '',
            grade: path.grade,
            type: path.type,
        });

        // Submit form
        const submitForm = () => {
            form.post(route('registration-batch.store', path.id), {
                onSuccess: () => {
                    form.reset();

                    Swal.fire(page.props.flash.success, '', 'success');
                },
                onError: () => {
                    Swal.fire(page.props.flash.error, '', 'error');
                }
            });
        };

        return {
            form,
            submitForm,
            jenjangOptions,
            subTipeJalurOptions,
            bankOptions,
        };
    }
});
</script>

<style scoped>
.quill-editor {
    min-height: 200px;
}
</style>