<template>
    <div class="d-flex flex-column justify-content-center align-items-center vh-100 container">
        <span class="fs-2 fw-bold mb-5">Daftar SMK</span>
        <!-- Container untuk n-steps -->
        <div class=" d-flex justify-content-center w-75">
            <n-steps :current="current as number" :status="currentStatus">
                <n-step title="IDENTITAS" description="Isi Identitas Diri" />
                <n-step title="INFORMASI AKUN" description="Isi password akun anda" />
            </n-steps>
        </div>

        <n-space class="mt-4">
            <n-button-group>
                <n-button @click="prev">
                    <template #icon>
                        <n-icon>
                            <MdArrowRoundBack />
                        </n-icon>
                    </template>
                </n-button>
                <n-button @click="next">
                    <template #icon>
                        <n-icon>
                            <MdArrowRoundForward />
                        </n-icon>
                    </template>
                </n-button>
            </n-button-group>
            <n-radio-group v-model:value="currentStatus" size="medium" name="size">
                <n-radio-button value="error">Error</n-radio-button>
                <n-radio-button value="process">Process</n-radio-button>
                <n-radio-button value="wait">Wait</n-radio-button>
                <n-radio-button value="finish">Finish</n-radio-button>
            </n-radio-group>
        </n-space>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import GuestLayout from '../../Layouts/GuestLayout.vue';

export default defineComponent({
    setup() {
        const current = ref(0);
        const currentStatus = ref('process');

        const next = () => {
            if (current.value < 1) {
                current.value++;
            }
        };

        const prev = () => {
            if (current.value > 0) {
                current.value--;
            }
        };

        return {
            current,
            currentStatus,
            next,
            prev,
        };
    },
    layout: GuestLayout
});
</script>
