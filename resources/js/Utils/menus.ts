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
]