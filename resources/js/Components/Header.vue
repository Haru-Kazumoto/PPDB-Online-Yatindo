<template>
    <div class="d-flex" :style="{ backgroundColor: backgroundColor, height: '4rem' }">
        <div class="mx-4 align-items-center d-flex w-100">
            <n-image width="50" src="/images/logo-yatindo-hd.png" preview-disabled />
            <div style="height: 50px; width: 2px; background-color: white; margin: 0px 15px;" />
            <div class="d-flex flex-column text-white">
                <span class="fw-semibold">PPDB Yatindo</span>
                <span>Yayasan Tinta Emas Indonesia</span>
            </div>
            <!-- user options -->
            <n-dropdown :options="options" @select="handleSelectKey" trigger="click">
                <div class="d-flex flex-row ms-auto align-items-center  p-2 text-white gap-2" style="cursor: pointer;">
                    <div class="d-flex bg-white p-2 rounded-circle">
                        <n-icon :component="Person32Filled" color="black"/>
                    </div>
                    <span class="d-none d-md-flex">{{ $page.props.auth.user.username }}</span>
                    <n-icon :component="ChevronDown12Regular"/>
                </div>
            </n-dropdown>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, inject, h, computed } from 'vue';
// import { Person, ReorderFourSharp as Hamburger, LogOutOutline as LogoutIcon, PersonCircleOutline as UserIcon } from "@vicons/ionicons5";
import { NIcon, useNotification } from 'naive-ui';
import Swal from 'sweetalert2';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { ArrowCircleRight32Filled, Person32Filled, ChevronDown12Regular } from '@vicons/fluent';

function renderIcon(icon) {
    return () => h(NIcon, null, { default: () => h(icon) });
}

export default defineComponent({
    name: "Header",
    setup() {
        const page = usePage();
        const toggleCollapse = inject('toggleCollapse'); // Inject toggle function

        function handleSelectKey(key) {
            if (key === 'logout') {
                Swal.fire({
                    icon: 'question',
                    title: 'Keluar dari aplikasi?',
                    showCancelButton: true,
                    confirmButtonText: 'Logout',
                }).then((result) => {
                    if (result.isConfirmed) {
                        handleLogout();
                    }
                });
            }
        }

        // Computed property untuk menentukan warna background
        const backgroundColor = computed(() => {
            if (page.props.auth.user.is_admin) {
                return '#002365'; // Warna jika admin
            } else {
                if (page.props.auth.user.student !== null) {
                    // Jika bukan admin, cek grade
                    if (page.props.auth.user.student.grade === "SMK") {
                        return '#f36b1d'; // Warna untuk SMK
                    } else if (page.props.auth.user.student.grade === "SMP") {
                        return '#002365'; // Warna untuk SMP
                    }
                }
            }
        });

        function handleLogout() {
            router.post(route('logout'));
        }

        return {
            // Person,
            // Hamburger,
            handleSelectKey,
            toggleCollapse,
            backgroundColor,
            options: [
                {
                    label: 'Profile',
                    key: 'profile',
                    icon: renderIcon(Person32Filled)
                },
                {
                    label: 'Logout',
                    key: 'logout',
                    icon: renderIcon(ArrowCircleRight32Filled)
                }
            ],
            Person32Filled,
            ChevronDown12Regular
        };
    }
});
</script>
