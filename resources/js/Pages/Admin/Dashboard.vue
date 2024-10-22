<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-4">
            <div class="card shadow-sm border-0" style="background-color: #002365">
                <div class="card-body text-white d-flex align-items-center">
                    <n-image src="/images/admin-work.png" width="300" />
                    <div class="d-flex flex-column">
                        <span class="fs-2 fw-semibold">Halo {{ $page.props.auth.user.fullname }}, Senang melihat mu
                            kembali!</span>
                        <span class="fs-4">Mari kita mulai hari ini dengan semangat baru!</span>
                    </div>
                </div>
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
import { CheckmarkCircle24Regular, PeopleCommunity16Regular, Timer48Regular } from '@vicons/fluent';
import { defineComponent } from 'vue'

export default defineComponent({
    setup() {


        return {
            PeopleCommunity16Regular,
            Timer48Regular,
            CheckmarkCircle24Regular
        }
    },
    components: {
    }
})
</script>

<style scoped></style>