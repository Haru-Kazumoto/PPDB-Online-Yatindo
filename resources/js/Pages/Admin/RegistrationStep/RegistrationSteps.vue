<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-2">
            <div class="card shadow-sm border-0 my-2" style="background-color:#002365 ">
                <div class="card-body d-flex align-items-center">
                    <span class="fs-3 fw-semibold text-white">Alur Pendaftaran</span>
                </div>
            </div>
            <div class="d-flex">
                <n-button class="ms-auto text-white" type="info" size="large" round
                    @click="router.visit(route('registration-step.create'))">
                    <template #icon>
                        <n-icon :component="Add16Filled" />
                    </template>
                    Tambah alur pendaftaran
                </n-button>
            </div>
            <n-tabs type="line" animated size="large">
                <n-tab-pane name="smk" tab="SMK">
                    <!-- Periksa jika array steps kosong -->
                    <div v-if="steps_smk.length === 0"
                        class="d-flex justify-content-center align-items-center flex-column">
                        <!-- Gambar kecil -->
                        <img src="/images/empty.png" alt="Alur pendaftaran kosong" width="300" />
                        <!-- Teks -->
                        <span class="fs-5 text-muted">Alur pendaftaran masih kosong</span>
                    </div>

                    <!-- Jika steps ada datanya, tampilkan list step -->
                    <div v-else>
                        <div class="mb-3 card shadow-sm border border-primary" v-for="(step, index) in steps_smk"
                            :key="index">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <!-- Title dengan font tebal -->
                                    <span class="fs-4 fw-semibold">{{ step.title }}</span>
                                    <!-- Tombol di ujung kanan -->
                                    <div class="ms-auto d-flex gap-3">
                                        <n-button @click="handleRedirectUpdate(step.id)" type="info" size="medium"
                                            round>
                                            <template #icon>
                                                <n-icon :component="Edit20Filled" />
                                            </template>
                                        </n-button>
                                        <n-button @click="handleDelete(step.id)" type="error" size="medium" round>
                                            <template #icon>
                                                <n-icon :component="Delete20Filled" />
                                            </template>
                                        </n-button>
                                    </div>
                                </div>
                                <!-- Collapse hanya berpengaruh pada konten, tidak pada tombol -->
                                <n-collapse v-model:value="activeSections">
                                    <n-collapse-item :name="index">
                                        <div v-html="step.description"></div>
                                    </n-collapse-item>
                                </n-collapse>
                            </div>
                        </div>
                    </div>
                </n-tab-pane>

                <n-tab-pane name="smp" tab="SMP">
                    <!-- Periksa jika array steps kosong -->
                    <div v-if="steps_smp.length === 0"
                        class="d-flex justify-content-center align-items-center flex-column">
                        <!-- Gambar kecil -->
                        <img src="/images/empty.png" alt="Alur pendaftaran kosong" width="300" />
                        <!-- Teks -->
                        <span class="fs-5 text-muted">Alur pendaftaran masih kosong</span>
                    </div>

                    <!-- Jika steps ada datanya, tampilkan list step -->
                    <div v-else>
                        <div class="mb-3 card shadow-sm border border-primary" v-for="(step, index) in steps_smp"
                            :key="index">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <!-- Title dengan font tebal -->
                                    <span class="fs-4 fw-semibold">{{ step.title }}</span>
                                    <!-- Tombol di ujung kanan -->
                                    <div class="ms-auto d-flex gap-3">
                                        <n-button @click="handleRedirectUpdate(step.id)" type="info" size="medium"
                                            round>
                                            <template #icon>
                                                <n-icon :component="Edit20Filled" />
                                            </template>
                                        </n-button>
                                        <n-button @click="handleDelete(step.id)" type="error" size="medium" round>
                                            <template #icon>
                                                <n-icon :component="Delete20Filled" />
                                            </template>
                                        </n-button>
                                    </div>
                                </div>
                                <!-- Collapse hanya berpengaruh pada konten, tidak pada tombol -->
                                <n-collapse v-model:value="activeSections">
                                    <n-collapse-item :name="index">
                                        <div v-html="step.description"></div>
                                    </n-collapse-item>
                                </n-collapse>
                            </div>
                        </div>
                    </div>
                </n-tab-pane>
            </n-tabs>
        </div>
    </div>
</template>

<script lang="ts">
import { Delete20Filled, Edit20Filled, Add16Filled } from '@vicons/fluent';
import { defineComponent, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default defineComponent({
    setup() {
        const page = usePage();
        const steps_smk = ref(page.props.steps_smk as any[]);
        const steps_smp = ref(page.props.steps_smp as any[]);

        const activeSections = ref<number[]>([]); // Menyimpan state item yang aktif

        function handleRedirectUpdate(step_id: number) {
            router.get(route('registration-step.edit', step_id));
        }

        function handleDelete(step_id: number) {
            Swal.fire({
                icon: "question",
                title: "Hapus alur ini?",
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('registration-step.delete', step_id), {
                        onSuccess: () => {
                            // Mengupdate state setelah data berhasil dihapus
                            steps_smk.value = steps_smk.value.filter(step => step.id !== step_id);
                            steps_smp.value = steps_smp.value.filter(step => step.id !== step_id);

                            Swal.fire(page.props.flash.success, '', 'success');
                        }
                    });
                }
            })
        }

        return {
            activeSections,
            handleRedirectUpdate,
            handleDelete,
            router,
            steps_smk,
            steps_smp,
            Edit20Filled,
            Add16Filled,
            Delete20Filled,
        };
    },
})
</script>