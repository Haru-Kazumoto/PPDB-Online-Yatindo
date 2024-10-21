<template>
    <div class="d-flex flex-column my-2">
        <div class="card shadow-sm border-0 my-2" style="background-color:#002365 ">
            <div class="card-body d-flex align-items-center">
                <span class="fs-3 fw-semibold text-white">Pendaftar per gelombang</span>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 w-100">
            <n-tabs type="segment" animated :theme-overrides="menuTheme">
                <n-tab-pane name="pembelian" tab="PEMBELIAN">
                    <!-- Periksa jika array steps kosong -->
                    <div v-if="filterRegistrationbatchWhereType('PEMBELIAN').length === 0"
                        class="d-flex justify-content-center align-items-center flex-column">
                        <!-- Gambar kecil -->
                        <img src="/images/empty.png" alt="Alur pendaftaran kosong" width="300" />
                        <!-- Teks -->
                        <span class="fs-5 text-muted">Tidak ada gelombang yang dibuat</span>
                    </div>
                    <div v-else>
                        <div class="d-flex" v-for="(batch, index) in filterRegistrationbatchWhereType('PEMBELIAN')"
                            :key="index">
                            <div class="card shadow  flex-grow-1 m-3 float-card" @click="handleRedirect(batch.id)"
                                style="cursor: pointer;">
                                <div class="card-body align-items-center d-flex">
                                    <div class="card-title d-flex align-items-center gap-3">
                                        <div class="d-flex p-3 rounded-circle" style="background-color: #002365;">
                                            <n-icon :component="DocumentBulletListMultiple24Filled" size="30"
                                                color="white" />
                                        </div>
                                        <div class="d-flex flex-column gap-2">
                                            <span class="fs-5 fw-semibold">{{ batch.name }}</span>
                                            <div class="d-flex gap-3 align-items-center">
                                                <n-icon :component="PeopleTeam20Filled" size="25" />
                                                Pendaftar : {{ batch.students_count }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </n-tab-pane>
                <n-tab-pane name="pengembalian" tab="PENGEMBALIAN">
                    <!-- Periksa jika array steps kosong -->
                    <div v-if="filterRegistrationbatchWhereType('PENGEMBALIAN').length === 0"
                        class="d-flex justify-content-center align-items-center flex-column">
                        <!-- Gambar kecil -->
                        <img src="/images/empty.png" alt="Alur pendaftaran kosong" width="300" />
                        <!-- Teks -->
                        <span class="fs-5 text-muted">Tidak ada gelombang yang dibuat</span>
                    </div>
                    <div v-else>
                        <div class="d-flex" v-for="(batch, index) in filterRegistrationbatchWhereType('PENGEMBALIAN')"
                            :key="index">
                            <div class="card shadow  flex-grow-1 m-3 float-card" @click="handleRedirect(batch.id)"
                                style="cursor: pointer;">
                                <div class="card-body align-items-center d-flex">
                                    <div class="card-title d-flex align-items-center gap-3">
                                        <div class="d-flex p-3 rounded-circle" style="background-color: #002365;">
                                            <n-icon :component="DocumentBulletListMultiple24Filled" size="30"
                                                color="white" />
                                        </div>
                                        <div class="d-flex flex-column gap-2">
                                            <span class="fs-5 fw-semibold">{{ batch.name }}</span>
                                            <div class="d-flex gap-3 align-items-center">
                                                <n-icon :component="PeopleTeam20Filled" size="25" />
                                                Pendaftar : {{ batch.students_count }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </n-tab-pane>
            </n-tabs>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import { Add16Filled, DocumentBulletListMultiple24Filled, Delete20Filled, Edit32Filled, PeopleTeam20Filled } from '@vicons/fluent';
import { TabsProps } from 'naive-ui';
import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

type TabThemeOverrides = NonNullable<TabsProps['themeOverrides']>;

export default defineComponent({
    setup() {
        const page = usePage();
        const batches = page.props.batches as any[];

        function filterRegistrationbatchWhereType(type: string) {
            return batches.filter(registration_batch => registration_batch.type === type);
        }

        function handleDelete(id: number) {
            Swal.fire({
                title: "Hapus gelombang ini?",
                icon: "question",
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('registration-batch.delete', id), {
                        onSuccess: () => {
                            Swal.fire('Berhasil menghapus!', '', 'success');
                        }
                    });
                }
            })
        }

        function handleUpdate(id) {
            router.visit(route('registration-batch.edit', id));
        }

        function handleRedirect(batch_id: number) {
            router.visit(route('participant.list', batch_id));
        }

        const menuTheme: TabThemeOverrides = {
            tabTextColorSegment: "white",
            tabTextColorHoverSegment: 'white',
            tabTextColorActiveSegment: "white",
            tabColorSegment: "#f36b1d",
            colorSegment: '#002365',
        }

        return {
            Add16Filled,
            DocumentBulletListMultiple24Filled,
            Edit32Filled,
            Delete20Filled,
            PeopleTeam20Filled,
            menuTheme,
            router,
            batches,
            handleDelete,
            handleUpdate,
            filterRegistrationbatchWhereType,
            handleRedirect
        }
    }
})
</script>

<style scoped>
.float-card {
    border-color: white;
    border: 2px solid white;
    transition: transform 0.3s ease-in-out, border 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.float-card:hover {
    border: 2px solid #002365;
}
</style>