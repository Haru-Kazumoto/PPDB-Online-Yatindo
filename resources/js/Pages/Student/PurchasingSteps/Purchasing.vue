<template>
    <div v-for="(batch, index) in data.batches" :key="index">
        <div class="card float-card" style="cursor: pointer;" @click="handleAssign(batch.id, batch.type, batch.batch_code)">
            <div class="card-body d-flex gap-3 align-items-center">
                <n-icon :component="DocumentBulletList20Filled" size="40" />
                <div class="d-flex flex-column">
                    <span class="fs-5 fw-semibold">{{ batch.name }}</span>
                    <span>{{ batch.start_date }}</span>
                </div>
                <n-tag :bordered="true" type="success" size="large" round class="ms-auto">
                    Dibuka
                </n-tag>
            </div>
        </div>
    </div>
</template>
<style scoped>
.float-card {
    background-color: #8af9842f;
    border-color: #38e82e;
    border: 2px solid #b4f1b1;
    transition: transform 0.3s ease-in-out, border 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.float-card:hover {
    /*  */
    border: 2px solid #3bc834;
}
</style>
<script setup>
import { router, useForm } from '@inertiajs/vue3';
import { DocumentBulletList20Filled } from '@vicons/fluent';

const props = defineProps({
    data: Object
})

const handleAssign = (batch_id, batch_type, batch_code) => {
    const form = useForm({
        batch_id: batch_id,
        type: batch_type,
        batch_code: batch_code,
    })

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
