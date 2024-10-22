<template>
    <div class="d-flex flex-column">
        <div class="card my-3 text-white shadow-sm border-0" style="background-color: #002365;">
            <div class="card-body">
                <span class="fs-3 fw-semibold">Detail siswa</span>
            </div>
        </div>

        <Back :route="route('participant.index-batch')" />

        <div class="card shadow-sm border-0 text-white" style="background-color: #002365;">
            <div class="card-body d-flex gap-5 align-items-center">
                <div v-if="$page.props.profilePictureUrl === null">
                    <div v-if="student.gender === 'LAKI_LAKI'">
                        <n-image src="/images/user-male.jpg" width="200" height="200"
                            style="object-fit: cover; border-radius: 50%;" />
                    </div>
                    <div v-else>
                        <n-image src="/images/user-female.png" width="200" height="200"
                            style="object-fit: cover; border-radius: 50%;" />
                    </div>
                </div>
                <div v-else>
                    <n-image :src="$page.props.profilePictureUrl" width="200" height="200"
                        style="object-fit: cover; border-radius: 50%;" />
                </div>
                <div class="d-flex flex-column gap-2 ">
                    <span class="fs-1 fw-semibold">{{ student.fullname }}</span>
                    <span class="fs-5">{{ student.phone ? student.phone : 'Belum mendaftarkan nomor' }}</span>

                    <div style="border: 1px solid white; width: 40rem;" class="my-2" />

                    <div class="d-flex gap-5">
                        <div class="d-flex flex-column">
                            <span class="fw-semibold">Status</span>
                            <span class="fs-5">{{ student.student_info.status === "NOT_REGISTERED" ? 'Belum Terdaftar' :
                                "Terdaftar" }}</span>
                        </div>

                        <div class="d-flex flex-column">
                            <span class="fw-semibold">Tanggal Mendaftar</span>
                            <span class="fs-5">{{ formatDate(student.student_info.purchase_registration_date) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <n-tabs type="line" animated class="my-3" size="large">
            <n-tab-pane name="pembayaran" tab="Pembayaran">
                <div class="container">
                    <div class="card shadow-sm border-0 mb-5">
                        <div class="card-body">
                            <div v-if="$page.props.payment === null">
                                <span class="fs-3 fw-semibold">Siswa belum melakukan pembayaran</span>
                            </div>
                            <div v-else>
                                <n-tag size="large" :type="payment.status === 'ACCEPTED' ? 'primary' : 'warning'">{{
                                    payment.status === "ACCEPTED" ? "DIKONFIRMASI" : "PENDING" }}</n-tag>
                                <table class="table table-bordered mt-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>File</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Nominal</th>
                                            <th>Bank</th>
                                            <th>No Rekening</th>
                                            <th>Atas Nama</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td align="center">
                                                <n-image width="100" :src="$page.props.payment_image" />
                                            </td>
                                            <td>{{ payment.payment_method }}</td>
                                            <td>{{ `Rp ${payment.nominal}` }}</td>
                                            <td>{{ payment.bank_name }}</td>
                                            <td>{{ payment.bank_number }}</td>
                                            <td>{{ payment.account_user_bank }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <n-button type="info" size="large" @click="handleConfirmPayment(payment.id)"
                                    :disabled="payment.status === 'ACCEPTED' ? true : false">KONFIRMASI
                                    PEMBAYARAN</n-button>
                            </div>
                        </div>
                    </div>
                </div>
            </n-tab-pane>
            <n-tab-pane name="biodata" tab="Biodata">
                <div class="container">
                    <div class="card shadow-sm border-0 mb-5">
                        <div class="card-body">
                            <table class="table table-bordered mt-3">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Pas foto 3x4</th>
                                        <th>Foto kartu keluarga</th>
                                        <th>Foto Akte Kelahiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <n-image width="200" :src="$page.props.profilePictureUrl" />
                                        </td>
                                        <td><n-image width="200" :src="$page.props.familyCardImage" /></td>
                                        <td><n-image width="200" :src="$page.props.birthCardImage" /></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row g-3 my-3">
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="NISN" />
                                    <n-input placeholder="" size="large" v-model:value="student.nisn" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Nomor Whatsapp" />
                                    <n-input placeholder="" size="large" v-model:value="student.phone" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Nama Lengkap" />
                                    <n-input placeholder="" size="large" v-model:value="student.fullname" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Nama Panggilan" />
                                    <n-input placeholder="" size="large" v-model:value="student.surname" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Gender" />
                                    <n-input placeholder="" size="large" v-model:value="student.gender" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Agama" />
                                    <n-input placeholder="" size="large" v-model:value="student.religion" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Tempat Lahir" />
                                    <n-input placeholder="" size="large" v-model:value="student.birth_place" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Tanggal Lahir" />
                                    <n-date-picker type="datetime" placeholder="" id="field5" size="large"
                                        v-model:value="student.birth_date" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Alamat" />
                                    <n-input type="textarea" placeholder="" size="large"
                                        v-model:value="student.student_address.address" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Provinsi" />
                                    <n-input placeholder="" size="large"
                                        v-model:value="student.student_address.province" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Kota/Kabupaten" />
                                    <n-input placeholder="" size="large" v-model:value="student.student_address.city" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Kecamatan" />
                                    <n-input placeholder="" size="large"
                                        v-model:value="student.student_address.district" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Kelurahan" />
                                    <n-input placeholder="" size="large"
                                        v-model:value="student.student_address.sub_district" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Kode POS" />
                                    <n-input placeholder="" size="large"
                                        v-model:value="student.student_address.postal_code" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Asal Sekolah" />
                                    <n-input placeholder="" size="large"
                                        v-model:value="student.student_info.school_origin" />
                                </div>
                            </div>

                            <span class="fs-3 fw-semibold">Informasi Orang Tua</span>
                            <div class="row g-3 my-3">
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Nama Ayah" />
                                    <n-input placeholder="" size="large" v-model:value="student.father_name" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Nama Ibu" />
                                    <n-input placeholder="" size="large" v-model:value="student.mother_name" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Pekerjaan Ayah" />
                                    <n-input placeholder="" size="large" v-model:value="student.father_jobs" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Pekerjaan Ibu" />
                                    <n-input placeholder="" size="large" v-model:value="student.mother_jobs" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Nomor Telepon Ayah" />
                                    <n-input placeholder="" size="large" v-model:value="student.father_phone" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Nomor Telepon Ibu" />
                                    <n-input placeholder="" size="large" v-model:value="student.mother_phone" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Alamat Ayah" />
                                    <n-input type="textarea" placeholder="" size="large"
                                        v-model:value="student.father_address" />
                                </div>
                                <div class="col-6 d-flex flex-column gap-1">
                                    <Label label="Alamat Ibu" />
                                    <n-input type="textarea" placeholder="" size="large"
                                        v-model:value="student.mother_address" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </n-tab-pane>
            <n-tab-pane name="ubah password" tab="Ubah Password">
                <div class="container">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex flex-column gap-2 w-50">
                                <div class="d-flex flex-column gap-1">
                                    <Label label="Nomor Telepon (username)" required />
                                    <n-input size="large" placeholder="" v-model:value="formCredential.username" />
                                    <span v-if="$page.props.errors['username']" class="text-danger fw-semibold">{{
                                        $page.props.errors['username'] }}</span>
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <Label label="Password baru" required />
                                    <n-input size="large" placeholder="" v-model:value="formCredential.password" />
                                    <span v-if="$page.props.errors['password']" class="text-danger fw-semibold">{{
                                        $page.props.errors['password'] }}</span>
                                </div>
                                <n-button type="error" class="my-3 w-50"
                                    @click="handleChangeCredential(student.user_id)">Ubah informasi akun</n-button>
                            </div>
                        </div>
                    </div>
                </div>
            </n-tab-pane>
        </n-tabs>
    </div>
</template>

<script lang="ts">
import { router, useForm, usePage } from '@inertiajs/vue3';
import { defineComponent } from 'vue';
import Back from '../../../Components/Back.vue';
import Label from '../../../Components/Label.vue';
import { formatDate } from '../../../Utils/menus';
import Swal from 'sweetalert2';

export default defineComponent({
    setup() {
        const page = usePage();
        const student = page.props.student as any;
        console.log(student);
        const payment = page.props.payment as any;

        const formCredential = useForm({
            username: '',
            password: "",
        });

        function handleConfirmPayment(payment_id: number) {
            Swal.fire({
                icon: "warning",
                title: "Konfirmasi pembayaran?",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    router.post(route('participant.confirm-payment', payment_id), {}, {
                        onSuccess: (page) => {
                            router.reload({
                                only: ['payment'],
                            });
                            Swal.fire((page.props.flash as any).success, '', 'success');
                        },
                        onError: () => {
                            Swal.fire('Gagal konfirmasi pembayaran', '', 'error');
                        }
                    });
                }
            })
        }

        function handleChangeCredential(user_id: number) {
            Swal.fire({
                icon: "warning",
                title: "Ubah informasi akun?",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    formCredential.patch(route('participant.change-credential', user_id), {
                        onSuccess: (page) => {
                            formCredential.reset();

                            Swal.fire((page.props.flash as any).success, '', 'success');
                        },
                        onError: () => {
                            Swal.fire('Gagal mengubah informasi akun', '', 'error');
                        }
                    });
                }
            });
        }

        return {
            student,
            payment,
            formCredential,
            formatDate,
            handleConfirmPayment,
            handleChangeCredential,
        }
    },
    components: {
        Back,
        Label
    }
})
</script>