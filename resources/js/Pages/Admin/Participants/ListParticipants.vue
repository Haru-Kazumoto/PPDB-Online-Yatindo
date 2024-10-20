<template>
    <div class="d-flex flex-column my-2">
        <div class="card shadow-sm border-0 my-2" style="background-color:#002365 ">
            <div class="card-body d-flex align-items-center">
                <span class="fs-3 fw-semibold text-white">Seleksi Gelombang</span>
            </div>
        </div>
        <!-- Back Button -->
        <Back :route="route('participant.index-batch')" />

        <div class="card shadow-sm border-0" style="background-color: #002365">
            <div class="card-body">
                <span class="fs-4 fw-semibold text-white">{{ batch.name }}</span>

                <!-- Inner card -->
                <div class="card border-0">
                    <div class="card-body fw-semibold">
                        <div class="d-flex gap-3">
                            <div class="d-flex flex-column align-items-center">
                                <span>Jumlah Pendaftar</span>
                                <span>10 Siswa</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <span>Jumlah Pendaftar</span>
                                <span>10 Siswa</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <span>Jumlah Pendaftar</span>
                                <span>10 Siswa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-3">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <span class="fw-semibold">Data Pendaftar</span>

                    <n-button size="medium" class="ms-auto" color="#002365">Export Excel</n-button>
                </div>
                <div class="d-flex flex-column">
                    <n-input placeholder="Cari nama siswa" class="w-25">
                        <template #prefix>
                            <n-icon :component="Search16Filled" />
                        </template>
                    </n-input>

                    <n-data-table :bordered="false" :columns="columns" size="small"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, h } from 'vue'
import Back from '../../../Components/Back.vue';
import { usePage } from '@inertiajs/vue3';
import { Search16Filled } from "@vicons/fluent";
import { DataTableColumns, NButton } from 'naive-ui';

interface RowData {
    name: string;
    phone: string;
    registered_date: string;
    status: string;
}

function createColumns(): DataTableColumns<RowData> {
    return [
        {
            title: "#",
            key: 'index',
            width: 50,
            render(row, index) {
                return index + 1;
            }
        },
        {
            title: "Nama",
            key: 'name',
            width: 200,
        },
        {
            title: "Phone",
            key: 'phone',
            width: 150,
        },
        {
            title: "Tanggal Mendaftar",
            key: 'registered_date',
            width: 200,
        },
        {
            title: "Status",
            key: 'status',
            width: 200,
        },
        {
            title: "Aksi",
            key: 'action',
            width: 100,
            render(row) {
                return h('div', {class: 'd-flex gap-2'}, [
                    h(NButton,
                        {
                            type: 'info',
                            size: 'small'
                        },
                        { default: () => "Detail"}
                    ),
                    h(NButton,
                        {
                            type: 'error',
                            size: 'small'
                        },
                        { default: () => "Hapus"}
                    )
                ]);
            }
        }
    ]
}

export default defineComponent({
    setup() {
        const page = usePage();
        const batch = page.props.registrationBatch as any;

        return {
            batch,
            columns: createColumns(),
            Search16Filled
        }
    },
    components: {
        Back
    }
})
</script>

<style scoped></style>