<template>
    <div v-if="data.batches.length === 0">
        <div class="d-flex flex-column gap-2 align-items-center">
            <n-image src="/images/empty-2.png" width="300" preview-disabled />
            <span class="fw-semibold fs-5">Gelombang masih kosong, silahkan tunggu</span>
        </div>
    </div>
    <div v-for="(batch, index) in data.batches" :key="index">
        <div class="d-flex flex-column gap-3">
            <div :class="['card', 'float-card', 'mb-3', isStillOpen(batch.end_date) ? 'open-card' : 'closed-card']"
                :style="{ cursor: isStillOpen(batch.end_date) ? 'pointer' : 'not-allowed' }"
                @click="isStillOpen(batch.end_date) ? handleAssign(batch.id, batch.type, batch.batch_code, batch.name) : null">
                <div class="card-body d-flex gap-3 align-items-center ">
                    <!-- <n-icon :component="DocumentBulletList20Filled" size="40" class="d-flex d-sm-none"/> -->
                    <div class="d-flex flex-column w-100">
                        <span class="fs-5 fw-semibold">{{ batch.name }}</span>
                        <div class="d-flex flex-column flex-sm-row align-items-sm-center">
                            <span>{{ formatDate(batch.start_date) }} - {{ formatDate(batch.end_date) }}</span>
                            <n-tag :bordered="true" :type="isStillOpen(batch.end_date) ? 'success' : 'error'"
                                size="large" round class="ms-auto mt-sm-0 mt-2">
                                {{ isStillOpen(batch.end_date) ? 'Dibuka' : 'Ditutup' }}
                            </n-tag>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.float-card {
    transition: transform 0.3s ease-in-out, border 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.open-card {
    background-color: #8af9842f;
    border-color: #38e82e;
    border: 2px solid #b4f1b1;
}

.open-card:hover {
    border: 2px solid #3bc834;
}

.closed-card {
    background-color: #f9848a2f;
    border-color: #e82e2e;
    border: 2px solid #f1b1b4;
}

.closed-card:hover {
    border: 2px solid #c8343b;
}
</style>
<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { DocumentBulletList20Filled } from '@vicons/fluent';
import { useNotification } from 'naive-ui';
import Swal from 'sweetalert2';
import { isStillOpen, formatDate } from '../../../Utils/menus';

const props = defineProps({
    data: Object
});


const handleAssign = (batch_id, batch_type, batch_code, batch_name) => {
    const nofitication = useNotification();
    const form = useForm({
        batch_id: batch_id,
        type: batch_type,
        batch_code: batch_code,
    });

    Swal.fire({
        icon: "question",
        title: `Daftar gelombang ${batch_name} ?`,
        showCancelButton: true,
        text: "Anda tidak akan bisa memilih yang lain lagi jika sudah konfirmasi."
    }).then((result) => {
        if (result.isConfirmed) {
            form.post(route('purchasing.purchase-update'), {
                preserveScroll: true,
                onSuccess: (page) => {
                    const message = page.props.flash;
                    if (message.success) {
                        router.reload({
                            preserveScroll: true,
                            only: ['data'],
                        });
                    }
                    if (message.failed) {
                        Swal.fire(message.failed, '', 'error');
                    }
                },
                onError: () => {
                    Swal.fire('Gagal mengupdate data', '', 'error');
                }
            });
        }
    })
}
</script>
