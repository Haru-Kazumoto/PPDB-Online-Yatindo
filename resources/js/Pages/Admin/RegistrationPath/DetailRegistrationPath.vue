<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-2">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 my-2" style="background-color:#002365">
                <div class="card-body d-flex align-items-center">
                    <span class="fs-3 fw-semibold text-white">Detail jalur pendaftaran</span>
                </div>
            </div>
            <!-- Back Button -->
            <Back :route="route('registration-path.index')" />

            <div class="card shadow-sm border-0 mt-5">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center gap-3">
                        <div class="card-title d-flex align-items-center gap-3">
                            <div class="d-flex p-3 rounded-circle" style="background-color: #002365;">
                                <n-icon :component="DocumentBulletListMultiple24Filled" size="30" color="white" />
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <span class="fs-4 fw-semibold">{{ path.name }}</span>
                            <div class="d-flex gap-1">
                                <span>{{ path.start_date }}</span>
                                -
                                <span>{{ path.end_date }}</span>
                                <div style="height: 1.5rem; width: 2px; background-color: black; margin: 0px 15px;" />
                                <span>Gelombang terdaftar : {{ path.registration_batches.length }}</span>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; border: 1px solid gray; margin: 1.5rem 0px;" />
                    <div class="d-flex mb-2">
                        <n-button color="#002365" size="large" @click="handleAddBatch">Buat Gelombang</n-button>
                    </div>
                    <div class="d-flex flex-column gap-3 mt-2">
                        <!-- Looping array path.registration_batches -->
                        <div v-for="(batch, index) in path.registration_batches" :key="index" class="card shadow"
                            style="border: 1px solid #002365">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center gap-3">
                                    <div class="d-flex p-2 rounded-circle" style="background-color: #002365;">
                                        <n-icon :component="DocumentEdit20Filled" size="30" color="white" />
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="fs-5 fw-semibold">{{ batch.name }}</span>
                                        <div class="d-flex gap-2">
                                            <n-icon :component="PeopleTeam32Filled" size="20" />
                                            {{ batch.applicants_count }} Pendaftar
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 ms-auto">
                                        <n-button color="red" circle size="large" @click="handleDeleteBatch(batch.id)">
                                            <template #icon>
                                                <n-icon :component="Delete20Filled" />
                                            </template>
                                        </n-button>
                                        <n-button color="#002365" circle size="large">
                                            <template #icon>
                                                <n-icon :component="Edit32Filled" />
                                            </template>
                                        </n-button>
                                    </div>
                                </div>
                                <div style="width: 100%; border: 0.5px solid rgb(199, 199, 199); margin: 1.5rem 0px;">
                                </div>
                                <div class="card border" style="background-color: #D2E0FB;">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="d-flex p-2 rounded-circle" style="background-color: #002365;">
                                            <n-icon :component="CalendarLtr16Filled" size="30" color="white" />
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fs-5 fw-semibold">Pendaftaran gelombang</span>
                                            <span>{{ batch.start_date }} - {{ batch.end_date }}</span>
                                        </div>
                                        <div class="px-4 py-1 ms-auto rounded"
                                            :style="getBatchStatusStyle(batch.status)">
                                            <span class="fw-semibold"
                                                :style="{ color: getStatusTextColor(batch.status) }">{{ batch.status
                                                }}</span>
                                        </div>
                                    </div>
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
import { defineComponent } from 'vue';
import Back from '../../../Components/Back.vue';
import {
    DocumentBulletListMultiple24Filled, DocumentEdit20Filled, PeopleTeam32Filled, CalendarLtr16Filled, Delete20Filled,
    Edit32Filled
} from "@vicons/fluent";
import { router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default defineComponent({
    setup() {
        const page = usePage();
        const path = page.props.registrationPath as any;

        function getBatchStatusStyle(status) {
            if (status === 'DIBUKA') {
                return {
                    border: '1px solid #88ff75',
                    backgroundColor: '#caffc2'
                };
            } else {
                return {
                    border: '1px solid #ff7575',
                    backgroundColor: '#ffc2c2'
                };
            }
        }

        function handleAddBatch() {
            router.visit(route('registration-batch.create', path.id));
        }

        function handleDeleteBatch(batch_id: number) {
            Swal.fire({
                icon: "question",
                title: "Hapus gelombang?",
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('registration-batch.delete', batch_id), {
                        onSuccess: () => {
                            Swal.fire('Berhasil dihapus!', '', 'success');
                        }
                    });
                }
            });
        }

        // Function to get text color based on status
        function getStatusTextColor(status) {
            return status === 'DIBUKA' ? '#349c24' : '#9c2424';
        }

        return {
            path,
            DocumentBulletListMultiple24Filled,
            DocumentEdit20Filled,
            PeopleTeam32Filled,
            CalendarLtr16Filled,
            Delete20Filled,
            Edit32Filled,
            getBatchStatusStyle,
            getStatusTextColor,
            handleAddBatch,
            handleDeleteBatch
        }
    },
    components: {
        Back
    }
})
</script>
