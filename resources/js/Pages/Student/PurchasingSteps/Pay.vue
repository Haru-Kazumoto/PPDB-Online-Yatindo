<template>
    <div class="d-flex flex-column gap-3">
        <div class="d-flex flex-column mt-3 container">
            <span class="fs-2 fw-semibold">Pembelian</span>
            <div style="border: 1px solid grey; display: flex;" />
        </div>
        <div class="d-flex mx-4">
            <n-space vertical>
                <n-steps :current="current as number" :status="currentStatus" :theme-overrides="stepTheme">
                    <n-step title="Pilih Gelombang" description="Pilih gelombang untuk ditempuh" />
                    <n-step title="Pembayaran Formulir"
                        description="Memberikan bukti pembayaran formulir untuk mendapatkan formulir" />
                    <n-step v-if="isSMK" title="Pilih Jurusan"
                        description="Memilih pilihan jurusan untuk menjadi acuan memilih" />
                    <n-step title="Cetak kartu peserta" description="Cetak hasil kartu peserta" />
                </n-steps>
            </n-space>
        </div>



        <div class="card border-1 shadow-sm mt-4">
            <div class="card-body">
                <!-- Inner Card -->
                <!-- WIZARD BEGIN -->
                <div v-if="current === 1">
                    <div v-for="(batch, index) in batches" :key="index">
                        <div class="card float-card" style="cursor: pointer;" @click="next">
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
                </div>
                <div v-else-if="current === 2">
                    <span>beda lagi njir</span>
                </div>
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

<script lang="ts">
import { StepsProps } from 'naive-ui';
import { defineComponent, ref, computed } from 'vue';
import { DocumentBulletList20Filled } from "@vicons/fluent";
import { router, usePage } from '@inertiajs/vue3';

type StepThemeProps = NonNullable<StepsProps['themeOverrides']>;

export default defineComponent({
    setup() {
        const page = usePage();
        const currentRef = ref<number | null>(page.props.auth.user.student.student_info.current_step);
        const batches = page.props.batches as any[];

        const grade = computed(() => (page.props.auth as any).user.student.grade);
        const isSMK = computed(() => grade.value === 'SMK');

        function next() {
            if (currentRef.value === null)
                currentRef.value = 1
            else if (currentRef.value >= 4)
                currentRef.value = null
            else currentRef.value++
        }

        function prev() {
            if (currentRef.value === 0)
                currentRef.value = null
            else if (currentRef.value === null)
                currentRef.value = 4
            else currentRef.value--
        }

        function handleAssign(batch_id) {
            router.post(route('purchasing.assign-1', batch_id));
        }

        const stepTheme: StepThemeProps = {
            indicatorTextColorFinish: "#63e2b7",
            indicatorBorderColorProcess: "#F08E0EFF",
            indicatorColorProcess: "#FF9204FF",
            indicatorBorderColorFinish: "#5DAC92FF",
            indicatorTextColorProcess: "#FFFEFEFF",
            stepHeaderFontSizeMedium: "20px",
            indicatorSizeMedium: "30px"
        }

        return {
            currentStatus: ref<StepsProps['status']>('process'),
            current: currentRef,
            stepTheme,
            batches,
            isSMK,
            next,
            prev,
            handleTestClick,
            DocumentBulletList20Filled,
        }
    }
})
</script>