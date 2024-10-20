<template>
    <div v-for="(batch, index) in batches" :key="index">
        <!-- @click="next" -->
        <div class="card float-card" style="cursor: pointer;" >
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

<script lang="ts">
import { DocumentBulletList20Filled } from '@vicons/fluent';
import { defineComponent } from 'vue';

export default defineComponent({
    props: {
        batches: {
            type: Array as any,
            required: true
        }
    },
    setup() {


        return { DocumentBulletList20Filled }
    }
})
</script>