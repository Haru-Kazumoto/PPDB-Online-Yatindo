<template>
    <div class="d-flex flex-column gap-1">
        <div class="d-flex">
            {{ label }}
            <label for="label" v-if="required" class="text-danger ms-1 fw-semibold">*</label>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        label: {
            required: true,
            type: String,
            default: 'Input here'
        },
        required: {
            required: false,
            type: Boolean,
            default: false
        },
    }
});
</script>