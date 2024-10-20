<template>
    <div class="d-flex m-2">
        <n-button text color="black" class="fw-bold" @click="handleBack">
            <template #icon>
                <n-icon :component="ArrowLeft12Regular" class="me-2" />
            </template>
            Kembali
        </n-button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { ArrowLeft12Regular } from '@vicons/fluent';
import { router } from '@inertiajs/vue3';

export default defineComponent({
    props: {
        route: {
            type: String,
            required: true,
        }
    },
    setup(props) {

        function handleBack() {
            router.visit(props.route);
        }

        return {
            ArrowLeft12Regular,
            router,
            handleBack
        }
    }
})
</script>