<template>
    <div class="d-flex flex-column gap-3">
        <div class="d-flex flex-column mt-3 container">
            <span class="fs-2 fw-semibold">Pembelian</span>
            <div style="border: 1px solid grey; display: flex;" />
        </div>
        <div class="d-flex mx-4">
            <n-space vertical>
                <n-steps :current="current" :status="currentStatus" :theme-overrides="stepTheme">
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
                    <Purchasing :data />
                </div>
                <div v-else-if="current === 2">
                    <Pay :data />
                </div>
                <div v-else-if="current === 3 && isSMK">
                    <Major :data />
                </div>
                <div v-else>
                    <Print :data />
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import Purchasing from './Purchasing.vue';
import Pay from './Pay.vue';
import Major from './Major.vue';
import Print from './Print.vue';

const props = defineProps({
    data: Object,
    current: Number
})

const page = usePage();

const stepTheme = reactive({
    indicatorTextColorFinish: "#63e2b7",
    indicatorBorderColorProcess: "#F08E0EFF",
    indicatorColorProcess: "#FF9204FF",
    indicatorBorderColorFinish: "#5DAC92FF",
    indicatorTextColorProcess: "#FFFEFEFF",
    stepHeaderFontSizeMedium: "20px",
    indicatorSizeMedium: "30px"
})

const currentStatus = ref('process');
const isSMK = page.props.auth.user.student.grade == 'SMK' ? true : false;
</script>