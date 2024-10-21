<template>
    <div class="p-2">
        <h3 class="h3 fw-semibold">Pilih Jurusan</h3>
        <div class="form-group mt-3">
            <label for="jurusan_utama">
                {{ $page.props.data.jalur.type === 'PEMBELIAN' ? 'Jurusan Utama' : 'Jurusan Pilihan' }}
                <span class="text-danger">*</span></label>
            <select id="jurusan_utama" class="form-control" v-model="form.major_fix">
                <option value="" selected>Pilihan Utama</option>
                <option value="TJKT">Teknik Jaringan Komputer dan Telekomunikasi</option>
                <option value="TE">Teknik Elektro</option>
                <option value="TO">Teknik Otomotif</option>
                <option value="AK">Akuntansi dan Keuangan</option>
            </select>
        </div>
        <div class="form-group mt-2" v-if="$page.props.data.jalur.type === 'PEMBELIAN'">
            <label for="opsi_jurusan">Opsi Lain</label>
            <select id="opsi_jurusan" class="form-control" v-model="form.major_estimation">
                <option value="" selected>Pilihan Alternatif</option>
                <option value="TJKT">Teknik Jaringan Komputer dan Telekomunikasi</option>
                <option value="TE">Teknik Elektro</option>
                <option value="TO">Teknik Otomotif</option>
                <option value="AK">Akuntansi dan Keuangan</option>
            </select>
        </div>
        <n-button size="large" class="mt-3" color="#002365" @click="handleAssign">Submit</n-button>
    </div>
</template>
<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    data: Object
});

const page = usePage();

console.log(page.props.data.jalur.type);

const form = useForm({
    z: null,
    major_fix: "",
    major_estimation: ""
});

onMounted(() => {
    form.batch_id = props.data.batches.id
})

const handleAssign = () => {
    form.post(route('returning.returning-update'), {
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