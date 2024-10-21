<template>
    <div class="p-2">
        <h3 class="h3 fw-semibold">Bayar Pendaftaran</h3>
        <p class="fw-semibold">Silahkan melakukan transfer ke rekening dibawah ini jika anda memilih metode pembayaran
            transfer :</p>

        <table class="mt-4" style="width: 100%;">
            <tr>
                <td>Bank</td>
                <!-- <td><b>: {{ data.batches.bank_name }}</b></td> -->
            </tr>
            <tr>
                <td>Nominal yang harus dibayarkan</td>
                <!-- <td><b>: Rp. {{ data.batches.registration_price }}</b></td> -->
            </tr>
            <tr>
                <td>Nomor Rekening</td>
                <!-- <td><b>: {{ data.batches.bank_number_account }}</b></td> -->
            </tr>
            <tr>
                <td>Atas Nama</td>
                <!-- <td><b>: {{ data.batches.bank_username }}</b></td> -->
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td>:
                    <n-tag v-if="data.payments.length == 0" :bordered="true" size="large" class="ms-auto">
                        Belum Dibayar
                    </n-tag>
                    <n-tag v-else :bordered="true" size="large" type="success" class="ms-auto">
                        Pembayaran Terkonfirmasi
                    </n-tag>
                </td>
            </tr>
        </table>

        <button class="btn btn-sm btn-primary mt-4" @click="showModal">Bayar</button>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>File</th>
                    <th>Metode Pembayaran</th>
                    <th>Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(payment, index) in data.payments" :key="index">
                    <td align="center"><n-image width="100" :src="`/storage/${payment.payment_image}`" /></td>
                    <td>{{ payment.payment_method }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-content-center" v-if="data.payments.length != 0">
            <button @click="handleAssign()" class="btn btn-primary">Lanjutkan</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true"
        data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="paymentModalLabel">Kirim Bukti Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="payment_method">Metode Pembayaran</label>
                        <input type="text" id="payment_method" class="form-control" v-model="form.payment_method"
                            readonly required>
                    </div>
                    <div class="form-group mb-2 mt-3">
                        <label for="image">Bukti Pembayaran</label>
                        <input @change="onImagePreview" accept="image/*" type="file" class="form-control" id="image"
                            name="image" required>
                    </div>
                    <div class="form-group mb-2" v-if="imagePreview">
                        <label for="imagePreview">Image Preview</label> <br>
                        <img :src="imagePreview" class="img-fluid" style="width: 170px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" :disabled="form.processing"
                        data-bs-dismiss="modal">Close</button>
                    <button @click="addPayment" :disabled="form.processing" type="button" class="btn btn-primary">Add
                        Payment</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    data: Object
})

const form = useForm({
    payment_method: "Transfer Bank",
    payment_image: null,
})
const imagePreview = ref(null); // Menyimpan URL gambar untuk preview

const showModal = () => {
    $('#paymentModal').modal('show');
    form.payment_image = null;
    imagePreview.value = null;
}

const onImagePreview = (event) => {
    const file = event.target.files[0];
    form.payment_image = file;
    if (file) {
        imagePreview.value = URL.createObjectURL(file);
    }
};

const addPayment = () => {
    form.post(
        route('purchasing.payment-add'),
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

                $('#paymentModal').modal('hide');

            },
        }
    );
}

const handleAssign = (batch_id, batch_type) => {
    router.post(route('purchasing.purchase-update'), {
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