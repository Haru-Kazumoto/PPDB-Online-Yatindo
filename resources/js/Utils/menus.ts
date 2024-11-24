import { NIcon } from "naive-ui";
import { h } from 'vue';
import dayjs from 'dayjs';
import 'dayjs/locale/id'; // Import locale Indonesia

dayjs.locale('id'); // Set locale to Indonesian

export function renderIcon(icon) {
    return () => h(NIcon, null, { default: () => h(icon) });
}

export function formatDate(date) {
    return dayjs(date).format('DD MMMM YYYY HH:mm');
}

export function formatRupiah(amount) {
    if (!amount) return 'Rp 0'; // Jika tidak ada nominal, tampilkan Rp 0

    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, // Set ke 0 jika tidak ingin menampilkan desimal
    });

    return formatter.format(amount); // Format angka menjadi Rupiah
}

export function isStillOpen(endDate) {
    const today = new Date();
    const batchEndDate = new Date(endDate);
    return today <= batchEndDate;
}

export const jenjangOptions = [
    { label: "SMK", value: "SMK" },
    { label: "SMP", value: "SMP" }
];

export const tipeJalurOptions = [
    { label: "PEMBELIAN", value: "PEMBELIAN" },
    { label: "PENGEMBALIAN", value: "PENGEMBALIAN" }
];

export const subTipeJalurOptions = [
    { label: "REGULER", value: "REGULER" },
    { label: "DISKON", value: "DISKON" },
    { label: "PRESTASI", value: "PRESTASI" }
];

export const bankOptions = [
    { label: "CIMB", value: "CIMB" },
    { label: "BCA", value: "BCA" },
    { label: "BNI", value: "BNI" },
    { label: "BRI", value: "BRI" },
    { label: "MANDIRI", value: "MANDIRI" },
];

export const genderOptions = [
    { label: "LAKI LAKI", value: "LAKI_LAKI" },
    { label: "PEREMPUAN", value: "PEREMPUAN" },
];

export const agamaOptions = [
    { label: "ISLAM", value: "ISLAM" },
    { label: "KRISTEN", value: "KRISTEN" },
    { label: "KATOLIK", value: "KATOLIK" },
    { label: "HINDU", value: "HINDU" },
    { label: "BUDDHA", value: "BUDDHA" },
];

export const majorOptions = [
    { label: "TJKT (Teknik Jaringan Komputer dan Telekomunikasi)", value: "TJKT" },
    { label: "TE (Teknik Elekro)", value: "TE" },
    { label: "TO (Teknik Otomotif)", value: "TO" },
    { label: "AK (Akuntansi Keuangan", value: "AK" },
];