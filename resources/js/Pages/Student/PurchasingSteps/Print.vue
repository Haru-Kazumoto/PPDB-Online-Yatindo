<template>
    <div class="p-2 text-center">
        <div style="width:50%" class="mx-auto">
            <p>Selamat anda telah terdaftar disistem kami, silahkan download pdf kartu formulir anda, lalu klik selesai
                untuk kehalaman Jalur Pengembalian</p>
            <button class="btn btn-primary my-4" @click="download">Download</button>
            <div id="download-kartu">
                <div class="p-3 mx-auto" style="border: 8px solid orange; border-radius: 20px">
                    <table width="80%" class="mx-auto my-3" border="1px">
                        <tr style="border-bottom: 5px solid orange;">
                            <td align="center" valign="middle" width="40%"><img src="/images/logo-yatindo-hd.png"
                                    width="50%"></td>
                            <td align="center">
                                <b>
                                    Kartu Pendaftaran Siswa<br />
                                    SMK TINTA EMAS INDONESIA<br />
                                    Tahun Ajaran 2024/2025
                                </b>
                            </td>
                        </tr>
                        <br />
                        <tr align="left">
                            <td>Nomor Peserta</td>
                            <td>: {{ $page.props.auth.user.student.student_info.form_number }}</td>
                        </tr>
                        <tr align="left">
                            <td>Nama Peserta</td>
                            <td>: {{ $page.props.auth.user.student.fullname }}</td>
                        </tr>
                        <tr align="left">
                            <td>Nomor Telepon</td>
                            <td>: {{ $page.props.auth.user.student.phone }}</td>
                        </tr>
                        <tr align="left">
                            <td>Alamat</td>
                            <td>: {{ $page.props.auth.user.student.student_address ?
                                $page.props.auth.user.student.student_address.address : '' }}</td>
                        </tr>
                        <tr align="left">
                            <td>Asal Sekolah</td>
                            <td>: {{ $page.props.auth.user.student.student_info ?
                                $page.props.auth.user.student.student_info.school_origin : '' }}</td>
                        </tr>

                        <br />
                        <tr align="left" style="border-top: 5px solid orange;">
                            <td>Jalur</td>
                            <td>: {{ data.jalur ? data.jalur.name : '' }}</td>
                        </tr>
                        <div v-if="$page.props.auth.user.student.grade === 'SMK'">
                            <tr align="left">
                                <td>Pilihan Jurusan 1</td>
                                <td>: {{ data.jurusan ? data.jurusan.major_fix : '' }}</td>
                            </tr>
                            <tr align="left">
                                <td>Pilihan Jurusan 2</td>
                                <td>: {{ data.jurusan ? data.jurusan.major_estimation : '' }}</td>
                            </tr>
                        </div>

                    </table>
                </div>
            </div>

            <button class="btn btn-success mt-4"
                v-if="$page.props.auth.user.student.student_info.purchase_step_status == false"
                @click="handleDone">Selesai</button>
        </div>
    </div>
</template>
<script setup>
import { router, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { onMounted, ref } from 'vue';

const props = defineProps({
    data: Object
});

function handleDone() {
    router.post(route('purchasing.purchase-update'), null, {
        onSuccess: () => {
            Swal.fire('Anda telah menyelesaikan step pembelian formulir!', '', 'success');
        }
    });
}

const download = () => {
    console.log("terdownload");
    var element = $('#download-kartu')[0];
    html2pdf(element, {
        margin: 10,
        filename: 'Kartu_Pendaftaran.pdf',
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    });
}
</script>