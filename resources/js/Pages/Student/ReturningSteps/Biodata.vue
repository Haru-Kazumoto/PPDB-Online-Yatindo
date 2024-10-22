<template>
    <div v-if="!visible">
        <div class="d-flex flex-column align-items-center">
            <n-image preview-disabled src="/images/waiting.png" width="300" />
            <span class="fw-semibold">Pembayaran harus di verifikasi oleh admin, silahkan menunggu di verifikasi</span>
        </div>
    </div>
    <div v-else>
        <div class="p-2">
            <div class="d-flex flex-column">
                <button class="btn btn-md w-25 text-white" style="background-color: #002365;" @click="showModal">Upload
                    pas
                    foto 3x4 disini. (DIBUTUHKAN)</button>
                <n-image v-if="imagePreview" :src="imagePreview" class="img-fluid" width="200" />
            </div>
            <div class="row g-3 my-3">
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="NISN" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.nisn"
                        @input="(value) => bioForm.nisn = value.replace(/\D/g, '')" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Nomor Whatsapp" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.phone"
                        @input="(value) => bioForm.phone = value.replace(/\D/g, '')" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Nama Lengkap" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.fullname" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Nama Panggilan" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.surname" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Gender" required />
                    <n-select placeholder="" size="large" v-model:value="bioForm.gender" :options="genderOptions" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Agama" required />
                    <n-select placeholder="" size="large" v-model:value="bioForm.religion" :options="agamaOptions"
                        @input="(value) => bioForm.religion = value.replace('_', ' ')" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Tempat Lahir" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.birth_place" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Tanggal Lahir" required />
                    <n-date-picker value-format="yyyy-MM-dd HH:mm:ss" type="datetime" placeholder="" id="field5"
                        size="large" v-model:formatted-value="bioForm.birth_date" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Alamat" required />
                    <n-input type="textarea" placeholder="" size="large" v-model:value="bioForm.address" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Provinsi" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.province" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Kota/Kabupaten" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.city" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Kecamatan" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.district" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Kelurahan" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.sub_district" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Kode POS" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.postal_code"
                        @input="(value) => bioForm.postal_code = value.replace(/\D/g, '')" />
                </div>
                <div class="col-6 d-flex flex-column gap-1">
                    <Label label="Asal Sekolah" required />
                    <n-input placeholder="" size="large" v-model:value="bioForm.school_origin" />
                </div>
            </div>
        </div>

        <span class="fs-3 fw-semibold">Informasi Orang Tua</span>
        <div class="row g-3 my-3">
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Nama Ayah" required />
                <n-input placeholder="" size="large" v-model:value="bioForm.father_name" />
            </div>
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Nama Ibu" required />
                <n-input placeholder="" size="large" v-model:value="bioForm.mother_name" />
            </div>
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Pekerjaan Ayah" required />
                <n-input placeholder="" size="large" v-model:value="bioForm.father_jobs" />
            </div>
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Pekerjaan Ibu" required />
                <n-input placeholder="" size="large" v-model:value="bioForm.mother_jobs" />
            </div>
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Nomor Telepon Ayah" required />
                <n-input placeholder="" size="large" v-model:value="bioForm.father_phone" />
            </div>
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Nomor Telepon Ibu" required />
                <n-input placeholder="" size="large" v-model:value="bioForm.mother_phone" />
            </div>
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Alamat Ayah" required />
                <n-input type="textarea" placeholder="" size="large" v-model:value="bioForm.father_address" />
            </div>
            <div class="col-6 d-flex flex-column gap-1">
                <Label label="Alamat IBu" required />
                <n-input type="textarea" placeholder="" size="large" v-model:value="bioForm.mother_address" />
            </div>
            <div class="d-flex gap-3">
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-md  text-white" style="background-color: #002365;"
                        @click="showModalFamilyCard">
                        Upload Kartu Keluarga disini. (DIBUTUHKAN)</button>
                    <n-image v-if="imageFamilyCardPreview" :src="imageFamilyCardPreview" class="img-fluid"
                        width="200" />
                </div>
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-md text-white" style="background-color: #002365;"
                        @click="showModalBirthCard">
                        Upload Akte Kelahiran disini. (DIBUTUHKAN)</button>
                    <n-image v-if="imageBirthCardPreview" :src="imageBirthCardPreview" class="img-fluid" width="200" />
                </div>
            </div>
        </div>

        <div class="d-flex my-3 w-100">
            <n-button type="info" class=" mt-5 w-100" color="#f36b1d" size="large" @click="handleSubmitBiodata">SUBMIT
                BIODATA</n-button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true"
        data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentModalLabel">Upload pas foto 3x4</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2 mt-3">
                        <Label label="Pas foto 3x4" required />
                        <input placeholder="" @change="event => onImagePreview(event, 'profile')" accept="image/*"
                            type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="form-group mb-2 d-flex align-items-center justify-content-center" v-if="imagePreview">
                        <n-image :src="imagePreview" class="img-fluid" width="350" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="form.processing"
                        data-bs-dismiss="modal">Close</button>
                    <button @click="addProfile" :disabled="form.processing" type="button" class="btn btn-primary">
                        Upload pas foto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="familyCardModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true"
        data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentModalLabel">Upload foto kartu keluarga</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2 mt-3">
                        <Label label="Kartu keluarga" required />
                        <input placeholder="" @change="event => onImagePreview(event, 'familyCard')" accept="image/*"
                            type="file" class="form-control" id="family_card_image" name="family_card_image" required>
                    </div>
                    <div class="form-group mb-2 d-flex align-items-center justify-content-center"
                        v-if="imageFamilyCardPreview">
                        <n-image :src="imageFamilyCardPreview" class="img-fluid" width="350" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="form.processing"
                        data-bs-dismiss="modal">Close</button>
                    <button @click="addFamilyCard" :disabled="form.processing" type="button"
                        class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="birthCardModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true"
        data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentModalLabel">Upload akte kelahiran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2 mt-3">
                        <Label label="Pas foto 3x4" required />
                        <input placeholder="" @change="event => onImagePreview(event, 'birthCard')" accept="image/*"
                            type="file" class="form-control" id="image" name="birth_certificate_image" required>
                    </div>
                    <div class="form-group mb-2 d-flex align-items-center justify-content-center"
                        v-if="imageBirthCardPreview">
                        <n-image :src="imageBirthCardPreview" class="img-fluid" width="350" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="form.processing"
                        data-bs-dismiss="modal">Close</button>
                    <button @click="addBirthCard" :disabled="form.processing" type="button"
                        class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3';
import Label from '../../../Components/Label.vue';
import Swal from 'sweetalert2';
import { agamaOptions, genderOptions } from '../../../Utils/menus';

const props = defineProps({
    data: Object
});

const page = usePage();

const visible = computed(() => {
    const status = props.data.payment.status;
    console.log('Computed Visible:', status !== "PENDING");
    return status !== "PENDING";
});

const form = useForm({
    profile_image: null,
    family_card_image: null,
    birth_certificate_image: null,
});

const bioForm = useForm({
    nisn: '',
    phone: '',
    fullname: '',
    surname: '',
    gender: '',
    religion: '',
    birth_place: '',
    birth_date: null,
    address: '',
    province: '',
    city: '',
    district: '',
    sub_district: '',
    postal_code: '',
    school_origin: '',
    // Tambahan field untuk informasi orang tua
    father_name: '',
    mother_name: '',
    father_jobs: '',
    mother_jobs: '',
    father_phone: '',
    mother_phone: '',
    father_address: '',
    mother_address: '',
});

const handleSubmitBiodata = () => {
    Swal.fire({
        title: "Biodata sudah benar?",
        text: "Anda bisa mengecek nya kembali sebelum submit.",
        icon: "warning",
    }).then((result) => {
        if (result.isConfirmed) {
            bioForm.post(route('returning.returning-update'), {
                onSuccess: (page) => {
                    const message = page.props.flash;
                    if (message.success) {
                        router.reload({
                            preserveScroll: true,
                            only: ['data'],
                        });
                        console.log(message.success);
                    }
                },
                onError: () => {
                    Swal.fire({
                        title: "Field ada yang kosong!",
                        html: 'Isi field dengan tanda <span class="text-danger fw-semibold">*</span>',
                        icon: "error",
                    });
                }
            });
        }
    });
}

const imagePreview = ref(null); // Menyimpan URL gambar untuk preview foto profil
const imageFamilyCardPreview = ref(null);
const imageBirthCardPreview = ref(null);

const showModal = () => {
    $('#profileModal').modal('show');
    form.profile_image = null;
    imagePreview.value = null;
}

const showModalFamilyCard = () => {
    $('#familyCardModal').modal('show');
    form.family_card_image = null;
    imageFamilyCardPreview.value = null;
}

const showModalBirthCard = () => {
    $('#birthCardModal').modal('show');
    form.birth_certificate_image = null;
    imageBirthCardPreview.value = null;
}

const onImagePreview = (event, type) => {
    const file = event.target.files[0];
    if (type === 'profile') {
        form.profile_image = file;
        if (file) {
            imagePreview.value = URL.createObjectURL(file);
        }
    } else if (type === 'familyCard') {
        form.family_card_image = file;
        if (file) {
            imageFamilyCardPreview.value = URL.createObjectURL(file);
        }
    } else if (type === 'birthCard') {
        form.birth_certificate_image = file;
        if (file) {
            imageBirthCardPreview.value = URL.createObjectURL(file);
        }
    }
};

const addFamilyCard = () => {
    form.post(
        route('returning.family-card-add'),
        {
            preserveScroll: true,
            onSuccess: (page) => {
                const message = page.props.flash;
                if (message.success) {
                    router.reload({
                        preserveScroll: true,
                        only: ['data'],
                    });
                    console.log(message.success);
                }
                if (message.failed) {
                    console.error(message.failed)
                }

                $('#familyCardModal').modal('hide');

            },
        }
    );
}

const addProfile = () => {
    form.post(
        route('returning.profile-add'),
        {
            preserveScroll: true,
            onSuccess: (page) => {
                const message = page.props.flash;
                if (message.success) {
                    router.reload({
                        preserveScroll: true,
                        only: ['data'],
                    });
                    console.log(message.success);
                }
                if (message.failed) {
                    console.error(message.failed)
                }

                $('#profileModal').modal('hide');

            },
        }
    );
}

const addBirthCard = () => {
    form.post(
        route('returning.birth-card-add'),
        {
            preserveScroll: true,
            onSuccess: (page) => {
                const message = page.props.flash;
                if (message.success) {
                    router.reload({
                        preserveScroll: true,
                        only: ['data'],
                    });
                    console.log(message.success);
                }
                if (message.failed) {
                    console.error(message.failed)
                }

                $('#birthCardModal').modal('hide');

            },
        }
    );
}

const handleAssign = (batch_id, batch_type) => {
    router.post(route('returning.purchase-update'), {
        preserveScroll: true,
        onSuccess: (page) => {
            const message = page.props.flash;
            if (message.success) {
                router.reload({
                    preserveScroll: true,
                    only: ['data'],
                });
                console.log(message.success);
            }
            if (message.failed) {
                console.error(message.failed)
            }
        },
    });
}
</script>