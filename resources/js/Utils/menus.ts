import { NIcon } from "naive-ui";
import {h} from 'vue';

export function renderIcon(icon) {
    return () => h(NIcon, null, { default: () => h(icon) });
}

export const jenjangOptions = [
    {label: "SMK", value: "SMK"},
    {label: "SMP", value: "SMP"}
];

export const tipeJalurOptions = [
    {label: "PEMBELIAN", value: "PEMBELIAN"},
    {label: "PENGEMBALIAN", value: "PENGEMBALIAN"}
]

export const subTipeJalurOptions = [
    {label: "REGULER", value: "REGULER"},
    {label: "DISKON", value: "DISKON"},
    {label: "PRESTASI", value: "PRESTASI"}
];

export const bankOptions = [
    {label: "CIMB", value: "CIMB"},
    {label: "BCA", value: "BCA"},
    {label: "BNI", value: "BNI"},
    {label: "BRI", value: "BRI"},
    {label: "MANDIRI", value: "MANDIRI"},
];

export const genderOptions = [
    {label: "LAKI LAKI", value: "LAKI_LAKI"},
    {label: "PEREMPUAN", value: "PEREMPUAN"},
];

export const agamaOptions = [
    {label: "ISLAM", value: "ISLAM"},
    {label: "KRISTEN", value: "KRISTEN"},
    {label: "KATOLIK", value: "KATOLIK"},
    {label: "HINDU", value: "HINDU"},
    {label: "BUDDHA", value: "BUDDHA"},
];

export const majorOptions = [
    {label: "TJKT (Teknik Jaringan Komputer dan Telekomunikasi)", value: "TJKT"},
    {label: "TE (Teknik Elekro)", value: "TE"},
    {label: "TO (Teknik Otomotif)", value: "TO"},
    {label: "AK (Akuntansi Keuangan", value: "AK"},
]