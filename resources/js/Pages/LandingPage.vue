    <template>
    <div class="d-flex flex-column text-white background-image">
        <div class="content">

            <!-- Header -->
            <header class="d-flex  " style="height: 5rem; background-color: #161D6F;">
                <div class="d-flex align-items-center container text-white">
                    <n-image width="60" src="/images/logo-yatindo-hd.png" />
                    <span class="ms-4 fw-bold fs-5">PPDB YATINDO</span>

                    <n-button type="info" size="large" class="ms-auto" color="#4B70F5">Masuk</n-button>
                </div>
            </header>

            <!-- content -->
            <main class="d-flex flex-column container">
                <!-- content ini berada dalam 1 viewport utuh -->
                <div class="d-flex container-fluid justify-content-center align-items-center"
                    style="min-height: 100vh;">
                    <div class="row g-2 w-100">
                        <div class="col-12 col-lg-6 gap-3 d-flex flex-column">
                            <div class="d-flex gap-3 align-items-center">
                                <n-image width="70" src="/images/logo-yatindo-hd.png" />
                                <div style="height: 70px; width: 2px; background-color: white;" />
                                <span class="fs-4 fw-bold">PPDB YATINDO</span>
                            </div>
                            <div class="d-flex gap-1 flex-column">
                                <span class="fs-2 fw-bold">Yayasan Tinta Emas Indonesia</span>
                                <span>Yayasan Tinta Emas Indonesia, Jl. Asem Jaya No.1, RT.004/RW.005, Mustika Jaya,
                                    Kec.
                                    Mustika Jaya, Kota Bks, Jawa Barat 17158</span>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="d-flex align-items-center bg-primary p-2"
                                    style="border-radius: 5px; cursor: pointer;">
                                    <img src="/images/whatsapp.svg" alt="svgs" height="30">
                                </div>
                                <div class="d-flex align-items-center bg-primary p-2"
                                    style="border-radius: 5px; cursor: pointer;">
                                    <img src="/images/instagram.svg" alt="svgs" height="30" >
                                </div>
                                <div class="d-flex align-items-center bg-primary p-2"
                                    style="border-radius: 5px; cursor: pointer;">
                                    <img src="/images/youtube.svg" alt="svgs" height="30">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
                            <n-image width="500" src="/images/smk-1.jpg" class="rounded-4   shadow" />
                        </div>
                    </div>
                </div>

                <!-- Konten lainnya yang bisa di-scroll -->
                <!-- <div class="d-flex flex-column">
                    <youtube-vue3 :videoid="video_id" :loop="loop" :autoplay="autoplay" />
                </div> -->

                <!-- <div class="row g-4 mb-3">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card border-0">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-semibold">Daftar PPDB SMK</span>
                                </div>
                                <n-image width="300" style="width: 100%; height: auto; object-fit: cover;"
                                    src="/images/smk.jpg" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card border-0">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-center">
                                    <span class="fw-semibold">Daftar PPDB SMP</span>
                                </div>
                                <n-image width="300" style="width: 100%; height: auto; object-fit: cover;"
                                    src="/images/smp.jpg" />
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="d-flex justify-content-center gap-5">
                    <div class="card border-0">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-center">
                                <span class="fw-semibold">Daftar PPDB SMK</span>
                            </div>
                            <n-image width="300" style="width: 100%; height: auto; object-fit: cover;"
                                src="/images/smk.jpg" preview-disabled />
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-center">
                                <span class="fw-semibold">Daftar PPDB SMP</span>
                            </div>
                            <n-image width="300" style="width: 100%; height: auto; object-fit: cover;"
                                src="/images/smp.jpg" />
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

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
    backdrop-filter: blur(5px); /* Menambahkan efek blur */
    background-color: rgba(0, 0, 0, 0.4); /* Menambahkan overlay gelap */
    /* Efek brightness */
    filter: brightness(0.7); /* Kurangi kecerahan gambar */
    /* Ini mencegah overlay menghalangi interaksi */
}

.content {
    position: relative;
    /* Supaya konten tetap di atas blur */
    z-index: 2;
    /* Konten berada di atas overlay dan gambar latar belakang */
}
</style>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    setup() {


        return {
            video_id: '_kn0tdEeyJQ', // YouTube video ID
            loop: 0,
            autoplay: 1,
            onReady() {
                this.$refs.youtube.playVideo()
            },
        };
    },
    components: {
    }
});
</script>

<style scoped></style>