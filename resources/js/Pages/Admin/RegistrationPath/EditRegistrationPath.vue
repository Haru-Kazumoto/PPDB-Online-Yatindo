<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-2">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 my-2" style="background-color:#002365">
                <div class="card-body d-flex align-items-center">
                    <span class="fs-3 fw-semibold text-white">Tambah Alur Pendaftaran</span>
                </div>
            </div>

            <!-- Back Button -->
            <Back :route="route('registration-path.index')" />

            <!-- Form Card -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body d-flex flex-column gap-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Nama Jalur" required />
                            <n-input placeholder="" size="large" v-model:value="form.name" @input="(value) => form.name = value.toUpperCase()" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Waktu Dibuka" required />
                            <n-date-picker value-format="yyyy-MM-dd HH:mm:ss" type="datetime" placeholder=""
                                size="large" v-model:formatted-value="form.start_date" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Tipe Jalur" required />
                            <n-select placeholder="" size="large" :options="tipeJalurOptions"
                                v-model:value="form.type" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Waktu Ditutup" required />
                            <n-date-picker value-format="yyyy-MM-dd HH:mm:ss" type="datetime" placeholder=""
                                size="large" v-model:formatted-value="form.end_date" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Jenjang" required />
                            <n-select placeholder="" size="large" :options="jenjangOptions"
                                v-model:value="form.grade" />
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <Label label="Biaya Pendaftaran" required />
                            <n-input placeholder="" size="large" v-model:value="form.registration_price">
                                <template #prefix>
                                    Rp
                                </template>
                            </n-input>
                        </div>
                    </div>

                    <n-button size="medium" type="info" style="width: 10rem;" color="#002365" @click="submitForm">Perbarui</n-button>
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
import { jenjangOptions, subTipeJalurOptions, tipeJalurOptions } from "../../../Utils/menus.ts";

export default defineComponent({
    components: {
        Back,
        Label
    },
    setup() {
        const page = usePage();
        const path = page.props.registrationPath;

        const form = useForm({
            name: path.name,
            type: path.type,
            start_date: path.start_date,
            end_date: path.end_date,
            registration_price: path.registration_price,
            grade: path.grade,
        });

        // Submit form
        const submitForm = () => {
            form.post(route('registration-path.store'), {
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
            tipeJalurOptions,
        };
    }
});
</script>

<style scoped>
.quill-editor {
    min-height: 200px;
}
</style>