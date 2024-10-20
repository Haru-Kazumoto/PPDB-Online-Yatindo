<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-4">
            <div class="card shadow-sm border-0" :style="{ backgroundColor: backgroundColor }">
                <div class="card-body text-white d-flex align-items-center">
                    <n-image src="/images/student.png" width="300" />
                    <div class="d-flex flex-column">
                        <span class="fs-2 fw-semibold">Halo {{ $page.props.auth.user.username }}, Selamat
                            bergabung!</span>
                        <span class="fs-4">Selamat datang di PPDB Yatindo!</span>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <strong>Selamat datang</strong>, You should check in on some of those fields below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center gap-3">
                                <div class="d-flex p-3 rounded-circle" style="background-color: #4CC9FE;">
                                    <n-icon :component="PeopleCommunity16Regular" size="30" color="white" />
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-5 fw-semibold">Siswa Terdaftar</span>
                                    <span class="fs-3 fw-bold">10</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center gap-3">
                                <div class="d-flex p-3 rounded-circle" style="background-color: #F95454;">
                                    <n-icon :component="Timer48Regular" size="30" color="white" />
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-5 fw-semibold">Menunggu Pembayaran</span>
                                    <span class="fs-3 fw-bold">10</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center gap-3">
                                <div class="d-flex p-3 rounded-circle" style="background-color: #72BF78;">
                                    <n-icon :component="CheckmarkCircle24Regular" size="30" color="white" />
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-5 fw-semibold">Pembayaran Terkonfirmasi</span>
                                    <span class="fs-3 fw-bold">10</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { usePage } from '@inertiajs/vue3';
import { CheckmarkCircle24Regular, PeopleCommunity16Regular, Timer48Regular } from '@vicons/fluent';
import { defineComponent, ref, computed } from 'vue'

export default defineComponent({
    setup() {
        const page = usePage();

        const backgroundColor = computed(() => {
            if ((page.props.auth as any).user.student !== null) {
                // Jika bukan admin, cek grade
                if ((page.props.auth as any).user.student.grade === "SMK") {
                    return '#f36b1d'; // Warna untuk SMK
                } else if ((page.props.auth as any).user.student.grade === "SMP") {
                    return '#002365'; // Warna untuk SMP
                }
            }
        });

        return {
            PeopleCommunity16Regular,
            Timer48Regular,
            CheckmarkCircle24Regular,
            backgroundColor
        }
    },
    components: {
    }
})
</script>

<style scoped></style>