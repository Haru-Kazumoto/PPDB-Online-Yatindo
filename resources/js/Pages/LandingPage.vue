<template>
    <div class="d-flex flex-column text-white background-image">
        <div class="content">
            <!-- Header -->
            <header class="d-flex fixed top-0 left-0 w-full z-50" style="height: 5rem; background-color: #161D6F;">
                <div class="d-flex align-items-center  text-white justify-content-between w-full mx-10 min-sm:mx-24">
                    <div class="d-flex align-items-center">
                        <n-image width="60" src="/images/logo-yatindo-hd.png" />
                        <span class="ms-4 fw-bold fs-5">PPDB YATINDO</span>
                    </div>
                    <n-button @click="router.visit(route('login'))" type="info" size="large" class="font-bold"
                        color="#4B70F5">Masuk</n-button>
                </div>
            </header>

            <!-- content -->
            <main class="d-flex flex-column container">
                <!-- content ini berada dalam 1 viewport utuh -->
                <div class="d-flex mt-14 container-fluid justify-content-center align-items-center"
                    style="min-height: 100vh;">
                    <div class=" w-100  flex max-lg:flex-col max-lg:gap-16 items-center">
                        <div class="col-12 col-lg-6 gap-3 d-flex flex-column flex-1">
                            <div class="d-flex gap-3 align-items-center">
                                <n-image width="70" src="/images/logo-yatindo-hd.png" />
                                <div style="height: 70px; width: 2px; background-color: white;"></div>
                                <span class="fs-4 fw-bold">PPDB YATINDO</span>
                            </div>
                            <div class="d-flex gap-1 flex-column">
                                <span class="fs-2 fw-bold ">Yayasan Tinta Emas Indonesia</span>
                                <span>Yayasan Tinta Emas Indonesia, Jl. Asem Jaya No.1, RT.004/RW.005, Mustika Jaya,
                                    Kec.
                                    Mustika Jaya, Kota Bks, Jawa Barat 17158</span>
                            </div>
                            <div class="d-flex gap-3 ">
                                <div class="d-flex align-items-center bg-primary p-2"
                                    style="border-radius: 5px; cursor: pointer;">
                                    <img src="/images/whatsapp.svg" alt="svgs" class="size-8" height="10">
                                </div>
                                <div class="d-flex align-items-center bg-primary p-2"
                                    style="border-radius: 5px; cursor: pointer;">
                                    <img src="/images/instagram.svg" alt="svgs" class="size-8" height="10">
                                </div>
                                <div class="d-flex align-items-center bg-primary p-2"
                                    style="border-radius: 5px; cursor: pointer;">
                                    <img src="/images/youtube.svg" alt="svgs" class="size-8" height="10">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center ">
                            <n-image width="500" src="/images/smk-1.jpg"
                                class="rounded-4   shadow hover:brightness-50 transition-all	" />
                        </div>
                    </div>
                </div>

                <div class="flex max-md:flex-col items-center justify-content-center  gap-5 my-40">
                    <div class="group/card font-bold text-black bg-white rounded-md w-[90%] max-w-[30rem]">
                        <div class="py-2 text-center text-xl">DAFTAR PPDB SMP</div>
                        <div class="overflow-hidden">

                            <div style="background-image: url(/images/smp.jpg);"
                                class="h-[18rem] w-full bg-cover bg-no-repeat bg-center transition-all group-hover/card:scale-110 ">
                            </div>
                        </div>
                        <div class="p-2 ">
                            <n-button color="#2A166F" class="w-full  text-white font-bold">DAFTAR</n-button>
                        </div>
                    </div>
                    <div class="group/card font-bold text-black bg-white rounded-md w-[90%] max-w-[30rem]">
                        <div class="py-2 text-center text-xl">DAFTAR PPDB SMP</div>
                        <div class="overflow-hidden">
                            <div style="background-image: url(/images/smk.jpg);"
                                class="h-[18rem] w-full bg-cover bg-no-repeat bg-center transition-all group-hover/card:scale-110 ">
                            </div>
                        </div>
                        <div class="p-2 ">
                            <n-button color="#F76707" class="w-full  font-bold">DAFTAR</n-button>
                        </div>
                    </div>
                </div>

                <div class="mt-24 text-black w-fit mx-auto font-bold text-2xl max-md:mb-[150%] mb-[70%] ">
                    <div class="px-10 py-3 bg-white rounded-full text-center">
                        Alur Pendaftaran SMP
                    </div>
                    <div class="bg-white p-24 my-5 rounded-xl">
                        Alur Peendaftaran Kosong
                    </div>
                    <div class="px-10 py-3 bg-white rounded-full text-center">
                        Alur Pendaftaran SMP
                    </div>
                    <div class="bg-white p-24 my-5 rounded-xl">
                        Alur Peendaftaran Kosong
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>

                <footer
                    class="overflow-hidden bg-[#1C0D59] pt-16 px-4 h-auto w-full  absolute bottom-0 left-0 flex flex-col">
                    <h1 class="font-bold sm:text-4xl text-2xl text-center">TETAP TERHUBUNG DENGAN KAMI</h1>
                    <a class="text-center mt-2" href="https://smk-smptintaemas.sch.id/"
                        target="_blank">https://smk-smptintaemas.sch.id/</a>

                    <p class="text-center mb-3">
                        Telefon : +622182610808
                    </p>
                    <div class="mx-auto sm:hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1541.0929545420765!2d107.0228664532594!3d-6.297820112354298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699198f3bc4929%3A0x8f8b6c3cc53dc7cf!2sSMP%20-%20SMK%20Tinta%20Emas%20Indonesia%20(Yatindo)!5e0!3m2!1sid!2sid!4v1729492538103!5m2!1sid!2sid"
                            width="480" height="250" style="border:0;" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="mx-auto max-sm:hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1541.0929545420765!2d107.0228664532594!3d-6.297820112354298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699198f3bc4929%3A0x8f8b6c3cc53dc7cf!2sSMP%20-%20SMK%20Tinta%20Emas%20Indonesia%20(Yatindo)!5e0!3m2!1sid!2sid!4v1729492538103!5m2!1sid!2sid"
                            width="1080" height="450" style="border:0;" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="text-center my-5">Copyright ©2024 Yayasan Tinta Emas Indonesia <br /> All rights reserved.
                        <br />
                        <br />
                        Powered by Dcoder's.
                    </p>
                </footer>
            </main>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { router } from "@inertiajs/vue3";

export default defineComponent({
    setup() {
        return {
            video_id: '_kn0tdEeyJQ', // YouTube video ID
            loop: 0,
            autoplay: 1,
            router,
            onReady() {
                this.$refs.youtube.playVideo()
            },
        };
    },
    layout: null,
    methods: {
        handleClick() {
            this.$router.push('/login')
        },
        goToAbout() {
            this.$router.push('/about')
        },
    },
    data() {
        return {
            content: '<p>A Vue.js wrapper component for Tiptap to use <code>v-model</code>.</p>',
        }
    },

});
</script>

<style scoped>
.background-image {
    background-image: url('/images/yatindo.jpg');
    /* Ganti dengan path gambar Anda */
    background-size: cover;
    /* Mengisi elemen */
    background-position: center;
    /* Posisi gambar di tengah */
    background-repeat: no-repeat;
    /* Mencegah pengulangan gambar */
    background-attachment: fixed;
    /* Membuat latar belakang statis */
    min-height: 100vh;
    /* Pastikan elemen ini setidaknya setinggi viewport */
    position: relative;
    /* Agar anak elemen dapat diposisikan relatif terhadap ini */
}

/* Menambahkan lapisan overlay agar teks lebih terbaca */
.background-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
    /* Di atas gambar latar belakang */
    pointer-events: none;
    backdrop-filter: blur(5px);
    /* Menambahkan efek blur */
    background-color: rgba(0, 0, 0, 0.4);
    /* Menambahkan overlay gelap */
    /* Efek brightness */
    filter: brightness(0.7);
    /* Kurangi kecerahan gambar */
    /* Ini mencegah overlay menghalangi interaksi */
}

.content {
    position: relative;
    /* Supaya konten tetap di atas blur */
    z-index: 2;
    /* Konten berada di atas overlay dan gambar latar belakang */
}

.label {
    padding: 1rem 2rem;
    font-weight: bold;
    background-color: white;
    /* max-width: 5rem; */
    width: fit-content;
    margin-inline: auto;
    color: black;
    border-radius: 5rem;
}
</style>