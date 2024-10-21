<template>
    <div class="p-2">
        <h3 class="h3 fw-semibold">Pilih Jurusan</h3>
        <div class="form-group mt-3">
            <label for="jurusan_utama">Jurusan Utama</label>
            <select id="jurusan_utama" class="form-control" v-model="form.major_fix">
                <option value="" selected>--- Pilih Jurusan Utama ---</option>
                <option value="IPA">IPA</option>
                <option value="IPS">IPS</option>
                <option value="Bahasa">Bahasa</option>
                <option value="Seni">Seni</option>
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="opsi_jurusan">Opsi Lain</label>
            <select id="opsi_jurusan" class="form-control" v-model="form.major_estimation">
                <option value="" selected>--- Pilih Jurusan Lain ---</option>
                <option value="IPA">IPA</option>
                <option value="IPS">IPS</option>
                <option value="Bahasa">Bahasa</option>
                <option value="Seni">Seni</option>
            </select>
        </div>
        <button class="btn btn-primary mt-3" @click="handleAssign">Submit</button>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';


const props = defineProps({
    data: Object
})

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