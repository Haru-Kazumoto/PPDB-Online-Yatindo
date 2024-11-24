<template>
    <div class="p-2 d-flex flex-column gap-2">
        <h3 class="h3 fw-semibold">Pilih Jurusan</h3>
        <div style="border: 1px solid black;" />
        <div v-if="visible">
            <div class="form-group mt-3">
                <label for="jurusan_utama">Jurusan Utama</label>
                <select id="jurusan_utama" class="form-control" v-model="form.major_fix">
                    <option value="" selected>--- Pilih Jurusan Utama ---</option>
                    <option value="TJKT">Teknik Komputer dan Jaringan</option>
                    <option value="TO">Teknik Otomotif</option>
                    <option value="TE">Teknik Elektro</option>
                    <option value="AK">Akuntansi dan Keuangan</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="opsi_jurusan">Jurusan alternatif</label>
                <select id="opsi_jurusan" class="form-control" v-model="form.major_estimation">
                    <option value="" selected>--- Pilih Jurusan Lain ---</option>
                    <option value="TJKT">Teknik Komputer dan Jaringan</option>
                    <option value="TO">Teknik Otomotif</option>
                    <option value="TE">Teknik Elektro</option>
                    <option value="AK">Akuntansi dan Keuangan</option>
                </select>
            </div>
            <button class="btn btn-primary mt-3" @click="handleAssign">Submit</button>
        </div>
        <div v-else class="d-flex flex-column align-items-center">
            <n-image preview-disabled src="/images/waiting.png" width="300" />
            <span class="fw-semibold">Pembayaran harus di verifikasi oleh admin, silahkan menunggu</span>
        </div>
    </div>
</template>
<script setup>
import { useForm, router, usePage } from '@inertiajs/vue3';
import { onMounted, watch } from 'vue';

const props = defineProps({
    data: Object,
});

const visible = computed(() => props.data.payments.status !== "PENDING");

const form = useForm({
    z: null,
    major_fix: "",
    major_estimation: ""
})

onMounted(() => {
    form.batch_id = props.data.batches.id
})

const handleAssign = () => {

    form.post(route('purchasing.purchase-update'), {
        preserveScroll: true,
        onSuccess: (page) => {
            const message = page.props.flash;
            if (message.success) {
                router.reload({
                    preserveScroll: true,
                    only: ['data'],
                });
                console.log(message.success);
            }
            if (message.failed) {
                console.error(message.failed)
            }
        },
    });
}

</script>