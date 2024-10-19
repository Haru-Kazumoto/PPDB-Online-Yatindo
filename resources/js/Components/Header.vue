<template>
    <div class="d-flex" style="background-color: #00a54f; height: 4rem;">
        
    </div>
</template>

<script lang="ts">
import { defineComponent, inject, h } from 'vue';
// import { Person, ReorderFourSharp as Hamburger, LogOutOutline as LogoutIcon, PersonCircleOutline as UserIcon } from "@vicons/ionicons5";
import { NIcon, useNotification } from 'naive-ui';
import Swal from 'sweetalert2';
import { useForm } from '@inertiajs/vue3';

function renderIcon(icon) {
    return () => h(NIcon, null, { default: () => h(icon) });
}

export default defineComponent({
    name: "Header",
    setup() {
        const form = useForm({});
        const notification = useNotification();
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

        function handleLogout() {
            // form.post(route('logout'), {
            //     onSuccess: () => {
            //         notification.success({
            //             title: "Sukses logout",
            //         });
            //     },
            //     onError: (err) => {
            //         Swal.fire({
            //             icon: 'error',
            //             title: err.message
            //         });
            //     }
            // });
        }

        return {
            // Person,
            // Hamburger,
            handleSelectKey,
            toggleCollapse,
            // options: [
            //     {
            //         label: 'Profile',
            //         key: 'profile',
            //         icon: renderIcon(UserIcon)
            //     },
            //     {
            //         label: 'Logout',
            //         key: 'logout',
            //         icon: renderIcon(LogoutIcon)
            //     }
            // ]
        };
    }
});
</script>
