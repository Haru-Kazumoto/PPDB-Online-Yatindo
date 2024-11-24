<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-4">
            <!-- Card Section -->
            <div class="card shadow-sm border-0" :style="{ backgroundColor: backgroundColor }">
                <div class="card-body text-white d-flex flex-column flex-md-row align-items-center gap-3">
                    <!-- Image Section -->
                    <n-image src="/images/student.png" class="img-fluid" width="300" preview-disabled />

                    <!-- Text Section -->
                    <div class="d-flex flex-column text-center text-md-start">
                        <span class="fs-3 fs-md-2 fw-semibold">Halo {{ $page.props.auth.user.student.fullname }},
                            Selamat bergabung!</span>
                        <span class="fs-6 fs-md-4">Selamat datang di PPDB Yatindo!</span>
                    </div>
                </div>
            </div>

            <!-- Alert Section -->
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <strong>Selamat datang</strong>, Anda telah terdaftar di sistem kami, mohon selesaikan pengisian
                formulir.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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