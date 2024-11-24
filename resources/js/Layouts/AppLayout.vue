<template>
    <n-config-provider>
        <n-notification-provider>
            <n-message-provider>
                <n-modal-provider>
                    <n-layout style="height: 100vh">
                        <n-layout-header bordered style="height: 64px;">
                            <Header />
                        </n-layout-header>
                        <n-layout has-sider position="absolute" style="top: 64px;">
                            <n-layout-sider :native-scrollbar="false" bordered collapse-mode="width" :width="300"
                                :collapsed="collapsed" @collapse="collapsed = true" @expand="collapsed = false"
                                :collapsed-width="0" style="background-color: #002365;" show-trigger >
                                <n-menu :collapsed="collapsed" :collapsed-width="64" :collapsed-icon-size="22"
                                    :options="selectedMenuOptions" :render-label="renderMenuLabel"
                                    default-value="dashboard" :theme-overrides="menuTheme" />
                            </n-layout-sider>
                            <n-layout :native-scrollbar="false">
                                <div class="container-fluid flex-grow-1 min-vh-100 z-n1"
                                    style="background-color: #EEF8F5;">
                                    <slot />
                                </div>
                            </n-layout>
                        </n-layout>
                    </n-layout>
                </n-modal-provider>
            </n-message-provider>
        </n-notification-provider>
    </n-config-provider>
</template>

<script lang="ts">
import { defineComponent, ref, provide, h, computed, onMounted, onUnmounted } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { MenuProps } from 'naive-ui';
import { Home16Filled, BranchCompare24Filled, DocumentBriefcase24Filled, ArrowForwardDownPerson24Filled, BorderAll24Regular, Branch24Filled, ChevronDown12Regular, PeopleCommunity20Filled } from "@vicons/fluent";
import Header from "../Components/Header.vue";
import { renderIcon } from "../Utils/menus.ts";

const menuOptions = {
    admin: [
        {
            label: 'Dashboard',
            key: 'dashboard',
            href: '/dashboard/admin',
            icon: renderIcon(BorderAll24Regular)
        },
        {
            label: "Alur Pendaftaran",
            key: 'registration-step',
            href: '/registration-step',
            icon: renderIcon(ArrowForwardDownPerson24Filled)
        },
        {
            label: "Jalur Pendaftaran",
            key: 'registration-path',
            href: '/registration-path',
            icon: renderIcon(Branch24Filled),
        },
        {
            label: "Pendaftar",
            key: "participants",
            href: "/participants",
            icon: renderIcon(PeopleCommunity20Filled),
        }
    ],
    siswa: [
        {
            label: "Dashboard",
            key: 'dashboard',
            href: "/dashboard/student",
            icon: renderIcon(Home16Filled)
        },
        {
            label: "Pembelian",
            key: 'purchasing',
            href: "/purchasing",
            icon: renderIcon(DocumentBriefcase24Filled)
        },
        {
            label: "Pengembalian",
            key: 'returning',
            href: "/returning",
            icon: renderIcon(BranchCompare24Filled)
        },
    ]
}

type MenuThemeOverrides = NonNullable<MenuProps['themeOverrides']>;

const menuTheme: MenuThemeOverrides = {
    arrowColor: "white",
    arrowColorChildActiveHover: "black",
    arrowColorChildActive: "white",
    itemColorActive: "white",
    itemColorActiveHover: "white",
    itemColorActiveInverted: "white",
    itemColorActiveHoverInverted: "black",
    itemIconColor: "white",
    itemIconColorActive: "black",
    itemIconColorActiveHover: "black",
    itemIconColorChildActive: "white",
    itemIconColorActiveInverted: "black",
    itemIconColorChildActiveHover: "black",
    itemIconColorActiveHoverInverted: "black",
    itemTextColor: "white",
    itemTextColorHover: "black",
    itemTextColorActive: "black",
    itemTextColorActiveHover: "black",
    itemTextColorActiveInverted: "black",
    itemTextColorActiveHoverInverted: "black",
    itemTextColorChildActive: "white",
    itemTextColorChildActiveHover: "black"
};

export default defineComponent({
    setup() {
        const collapsed = ref(false);
        const page = usePage();
        const user = (page.props.auth as any).user;

        function toggleCollapse() {
            collapsed.value = !collapsed.value;
        }

        // Pilih menu berdasarkan user.is_admin
        const selectedMenuOptions = computed(() => {
            return user?.is_admin ? menuOptions.admin : menuOptions.siswa;
        });

        // Provide state and toggle function to child components
        provide('collapsed', collapsed);
        provide('toggleCollapse', toggleCollapse);

        // Fungsi untuk mendeteksi ukuran layar
        function handleResize() {
            const isSmallScreen = window.matchMedia("(max-width: 768px)").matches;
            if (isSmallScreen) {
                collapsed.value = true; // Sider tertutup di layar kecil
            }
        }

        // Pasang listener saat komponen dimuat
        onMounted(() => {
            handleResize(); // Set initial state
            window.addEventListener("resize", handleResize);

            router.on("navigate", handleResize);
        });

        // Hapus listener saat komponen dilepas
        onUnmounted(() => {
            window.removeEventListener("resize", handleResize);
        });

        return {
            toggleCollapse,
            collapsed,
            menuTheme,
            menuOptions,
            renderMenuLabel(option) {
                // Pastikan href tidak undefined
                if (!option.href) {
                    return option.label; // Atau alternatif lain jika href tidak ada
                }

                return h(Link, { href: option.href }, { default: () => option.label });
            },
            selectedMenuOptions
        }
    },
    components: {
        Header
    }
})
</script>