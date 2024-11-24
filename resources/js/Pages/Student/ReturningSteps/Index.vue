<template>
    <div class="d-flex flex-column gap-3">
        <div class="d-flex flex-column mt-3 container">
            <span class="fs-2 fw-semibold">Pengembalian</span>
            <div style="border: 1px solid grey; display: flex;" />
        </div>

        <div v-if="!page.props.auth.user.student.student_info.purchase_step_status">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <n-image src="/images/not-allowed.png" width="400" />
                <span class="fs-5 fw-semibold">Dimohon untuk menyelesaikan rangkaian pembelian formulir terlebih
                    dahulu!</span>
            </div>
        </div>
        <div v-else>
            <div id="horizontal-scroll">
                <n-space vertical>
                    <n-steps :current="current" :status="currentStatus" :theme-overrides="stepTheme">
                        <n-step title="Pilih Gelombang " description="Pilih gelombang pengembalian untuk ditempuh" />
                        <n-step title="Pembayaran"
                            description="Memberikan bukti pembayaran formulir untuk mendapatkan formulir" />
                        <n-step title="Isi Biodata"
                            description="Mengisi biodata pribadi untuk pendaftaran di instansi sekolah" />
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
                        <Returning :data />
                    </div>
                    <div v-else-if="current === 2">
                        <Pay :data />
                    </div>
                    <div v-else-if="current === 3">
                        <Biodata :data />
                    </div>
                    <div v-else-if="current === 4 && isSMK">
                        <Major :data />
                    </div>
                    <div v-else>
                        <Print :data />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
#horizontal-scroll {
    overflow-x: auto;
    /* Enable horizontal scrolling */
    scroll-snap-type: x mandatory;
    padding: 10px;
    /* Enable scroll snapping */
    -webkit-overflow-scrolling: touch;
    /* Smooth scrolling for touch devices */
}

#horizontal-scroll .col-12 {
    min-width: 250px;
    /* Minimum width for each step/card to allow horizontal scroll */
    /* scroll-snap-align: start; */
    /* Ensure steps snap into position when scrolling */
}

/* Hide scrollbar for Chrome, Safari, and Edge */
#horizontal-scroll::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge, and Firefox */
#horizontal-scroll {
    -ms-overflow-style: none;
    /* IE and Edge */
    scrollbar-width: none;
    /* Firefox */
}

@media (max-width: 576px) {
    #horizontal-scroll {
        display: flex;
        /* Make it a flexbox container */
        flex-wrap: nowrap;
        /* Prevent wrapping so steps scroll horizontally */
    }

    .col-12 {
        flex: 0 0 auto;
        /* Ensure steps don't shrink or grow */
    }
}
</style>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { onMounted, reactive, ref } from 'vue';
import Returning from './Returning.vue';
import Major from './Major.vue';
import Pay from './Pay.vue';
import Print from './Print.vue';
import Biodata from './Biodata.vue';


const props = defineProps({
    data: Object,
    current: Number
});

const page = usePage();

const stepTheme = reactive({
    indicatorTextColorFinish: "#63e2b7",
    indicatorBorderColorProcess: "#F08E0EFF",
    indicatorColorProcess: "#FF9204FF",
    indicatorBorderColorFinish: "#5DAC92FF",
    indicatorTextColorProcess: "#FFFEFEFF",
    stepHeaderFontSizeMedium: "16px",
    indicatorSizeMedium: "20px"
})

const currentStatus = ref('process');
const isSMK = page.props.auth.user.student.grade == 'SMK' ? true : false;
</script>