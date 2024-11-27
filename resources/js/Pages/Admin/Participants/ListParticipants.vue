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
                                <span>{{ batch.students_count }} Siswa</span>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <span>Jumlah Penerimaan Siswa</span>
                                <span>{{ batch.max_quota }} Siswa</span>
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

                    <n-button size="medium" class="ms-auto" color="#002365" @click="handleExportExcel(batch.id)">Export
                        Excel</n-button>
                </div>
                <div class="d-flex flex-column">
                    <n-input placeholder="Cari nama siswa" class="w-25" @input="handleSearchQuery"
                        v-model:value="search_name">
                        <template #prefix>
                            <n-icon :component="Search16Filled" />
                        </template>
                    </n-input>

                    <n-data-table :bordered="false" :columns="columns" size="small" :data="$page.props.students.data" />
                    <div class="d-flex mt-3">
                        <n-pagination class="ms-auto" v-model:page="pagination.current_page"
                            :page-count="pagination.last_page" :page-size="pagination.per_page"
                            :item-count="pagination.total" @update:page="handlePageChange"
                            @update:page-count="pagination.last_page = ($page.props.students as any).last_page" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, h, reactive, ref } from 'vue'
import Back from '../../../Components/Back.vue';
import { usePage, router } from '@inertiajs/vue3';
import { Search16Filled } from "@vicons/fluent";
import { DataTableColumns, NButton } from 'naive-ui';
import { formatDate } from '../../../Utils/menus';
import Swal from 'sweetalert2';


export default defineComponent({
    setup() {
        const page = usePage();
        const batch = page.props.registrationBatch as any;
        const pagination = reactive({
            current_page: (page.props.students as any).current_page,
            per_page: (page.props.students as any).per_page,
            total: (page.props.students as any).total,
            last_page: (page.props.students as any).last_page,
        });

        function createColumns() {
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
                    key: 'fullname',
                    width: 200,
                    render(row) {
                        return row.student.fullname
                    }
                },
                {
                    title: "Phone",
                    key: 'phone',
                    width: 150,
                    render(row) {
                        return row.student.phone;
                    }
                },
                {
                    title: "Tanggal Mendaftar",
                    key: 'registered_date',
                    width: 200,
                    render(row) {
                        return formatDate(row.purchase_registration_date);
                    }
                },
                {
                    title: "Status",
                    key: 'step_name',
                    width: 200,
                },
                {
                    title: "Aksi",
                    key: 'action',
                    width: 100,
                    render(row) {
                        return h('div', { class: 'd-flex gap-2' }, [
                            h(NButton,
                                {
                                    type: 'info',
                                    size: 'small',
                                    onClick: () => {
                                        router.get(route('participant.detail-participant', row.student.id));
                                    }
                                },
                                { default: () => "Detail" }
                            ),
                            h(NButton,
                                {
                                    type: 'error',
                                    size: 'small',
                                    onClick: () => {
                                        Swal.fire({
                                            title: 'Hapus siswa ini dari gelombang?',
                                            text: 'Setelah siswa dihapus data tersebut tidak bisa dikembalikan lag',
                                            icon: 'warning',
                                            showCancelButton: true,
                                        })
                                            .then((result) => {
                                                if (result.isConfirmed) {
                                                    router.patch(route('participant.delete-student', { student: row.student.id, registrationBatch: batch.id }), {}, {
                                                        onSuccess: (page) => {
                                                            Swal.fire({
                                                                title: page.props.flash.success,
                                                                icon: 'success',
                                                            });
                                                        },
                                                        onError: (error) => {
                                                            Swal.fire({
                                                                title: "Error, silahkan lapor developer",
                                                                icon: 'error',
                                                            });
                                                        }
                                                    });

                                                }
                                            });
                                    }
                                },
                                { default: () => "Hapus" }
                            )
                        ]);
                    }
                }
            ]
        }

        const search_name = ref('');

        // Debounce function to limit API calls during typing
        let debounceTimer: NodeJS.Timeout;

        function handleSearchQuery() {
            if (debounceTimer) clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                router.get(route('participant.list', batch.id), {
                    page: pagination.current_page,
                    search_name: search_name.value,
                }, {
                    preserveState: true,
                    replace: true
                });
            }, 300); // Adjust debounce time as needed
        };

        function handlePageChange(page: number) {
            router.get(route('participant.list', batch.id), {
                page,
                search_name: search_name.value
            }, { preserveState: true }); // Request data for the selected page
        }

        function handleExportExcel(batch_id: number) {
            const url = route('participant.get-participants', batch_id);
            window.location.href = url;
            // router.post(route('participant.get-participants', batch_id), {}, {
            //     preserveState: true,
            //     preserveScroll: true,
            //     onProgress(data) {
            //         console.log(data);
            //     },
            //     onSuccess(page) {
            //         console.log(page)
            //     }
            // });
        }

        return {
            batch,
            columns: createColumns(),
            handleSearchQuery,
            handleExportExcel,
            handlePageChange,
            Search16Filled,
            router,
            pagination,
            search_name
        }
    },
    components: {
        Back
    }
})
</script>

<style scoped></style>