<template>
    <div class="d-flex flex-column my-2">
        <div class="card shadow-sm border-0 my-2" style="background-color:#002365 ">
            <div class="card-body d-flex align-items-center">
                <span class="fs-3 fw-semibold text-white">Jalur Pendaftaran</span>
            </div>
        </div>
        <div class="d-flex mt-5 align-items-center">
            <n-button class="ms-auto text-white" type="info" size="large" round
                @click="router.visit(route('registration-path.create'))">
                <template #icon>
                    <n-icon :component="Add16Filled" />
                </template>
                Tambah jalur pendaftaran
            </n-button>
        </div>
        <div class="d-flex justify-content-center mt-3 w-100">
            <n-tabs type="segment" animated :theme-overrides="menuTheme">
                <n-tab-pane name="smk" tab="SMK">
                    <!-- Periksa jika array steps kosong -->
                    <div v-if="filterRegistrationPathWhereGrade('SMK').length === 0"
                        class="d-flex justify-content-center align-items-center flex-column">
                        <!-- Gambar kecil -->
                        <img src="/images/empty.png" alt="Alur pendaftaran kosong" width="300" />
                        <!-- Teks -->
                        <span class="fs-5 text-muted">Jalur pendaftaran masih kosong</span>
                    </div>
                    <div v-else>
                        <div class="d-flex" v-for="(path, index) in filterRegistrationPathWhereGrade('SMK')"
                            :key="index">
                            <div class="card shadow  flex-grow-1 m-3 float-card"
                                @click="router.visit(route('registration-path.detail', path.id))">
                                <div class="card-body align-items-center d-flex" style="cursor: pointer;">
                                    <div class="card-title d-flex align-items-center gap-3">
                                        <div class="d-flex p-3 rounded-circle" style="background-color: #002365;">
                                            <n-icon :component="DocumentBulletListMultiple24Filled" size="30"
                                                color="white" />
                                        </div>
                                        <div class="d-flex flex-column gap-2">
                                            <span class="fs-5 fw-semibold">{{ path.name }}</span>
                                            <div class="d-flex gap-3">
                                                <span>{{ path.start_date }}</span>
                                                -
                                                <span>{{ path.end_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 ms-auto">
                                        <n-button color="red" circle size="large" @click.stop="handleDelete(path.id)">
                                            <template #icon>
                                                <n-icon :component="Delete20Filled" />
                                            </template>
                                        </n-button>
                                        <n-button color="#002365" circle size="large"
                                            @click.stop="handleUpdate(path.id)">
                                            <template #icon>
                                                <n-icon :component="Edit32Filled" />
                                            </template>
                                        </n-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </n-tab-pane>
                <n-tab-pane name="smp" tab="SMP">
                    <!-- Periksa jika array steps kosong -->
                    <div v-if="filterRegistrationPathWhereGrade('SMP').length === 0"
                        class="d-flex justify-content-center align-items-center flex-column">
                        <!-- Gambar kecil -->
                        <img src="/images/empty.png" alt="Alur pendaftaran kosong" width="300" />
                        <!-- Teks -->
                        <span class="fs-5 text-muted">Jalur pendaftaran masih kosong</span>
                    </div>
                    <div v-else>
                        <div class="d-flex" v-for="(path, index) in filterRegistrationPathWhereGrade('SMP')"
                            :key="index">
                            <div class="card shadow  flex-grow-1 m-3 float-card"
                                @click="router.visit(route('registration-path.detail', path.id))">
                                <div class="card-body align-items-center d-flex" style="cursor: pointer;">
                                    <div class="card-title d-flex align-items-center gap-3">
                                        <div class="d-flex p-2 rounded-circle" style="background-color: #002365;">
                                            <n-icon :component="DocumentBulletListMultiple24Filled" size="30"
                                                color="white" />
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fs-5 fw-semibold">{{ path.name }}</span>
                                            <div class="d-flex gap-3">
                                                <span>{{ path.start_date }}</span>
                                                -
                                                <span>{{ path.end_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 ms-auto">
                                        <n-button color="red" circle size="large" @click.stop="handleDelete(path.id)">
                                            <template #icon>
                                                <n-icon :component="Delete20Filled" />
                                            </template>
                                        </n-button>
                                        <n-button color="#002365" circle size="large"
                                            @click.stop="handleUpdate(path.id)">
                                            <template #icon>
                                                <n-icon :component="Edit32Filled" />
                                            </template>
                                        </n-button>
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
import { Add16Filled, DocumentBulletListMultiple24Filled, Delete20Filled, Edit32Filled } from '@vicons/fluent';
import { TabsProps } from 'naive-ui';
import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

type TabThemeOverrides = NonNullable<TabsProps['themeOverrides']>;

export default defineComponent({
    setup() {
        const page = usePage();
        const registration_paths = page.props.registrationPaths as any[];

        function filterRegistrationPathWhereGrade(grade: string) {
            return registration_paths.filter(registration_path => registration_path.grade === grade);
        }

        function handleDelete(id: number) {
            Swal.fire({
                title: "Hapus jalur ini?",
                icon: "question",
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(route('registration-path.delete', id), {
                        onSuccess: () => {
                            router.get(route('registration-path.index'));
                            Swal.fire('Berhasil menghapus!', '', 'success');
                        }
                    });
                }
            })
        }

        function handleUpdate(id) {
            router.visit(route('registration-path.edit', id));
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
            menuTheme,
            registration_paths,
            router,
            filterRegistrationPathWhereGrade,
            handleDelete,
            handleUpdate
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