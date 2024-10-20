<template>
    <div class="d-flex flex-column gap-2">
        <div class="my-2">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 my-2" style="background-color:#002365">
                <div class="card-body d-flex align-items-center">
                    <span class="fs-3 fw-semibold text-white">Tambah Alur Pendaftaran</span>
                </div>
            </div>

            <!-- Back Button -->
            <Back :route="route('registration-step.index')" />

            <!-- Form Card -->
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body w-50">
                    <form @submit.prevent="submitForm">
                        <div class="d-flex flex-column gap-4">
                            <!-- Nama Jalur -->
                            <div class="d-flex flex-column">
                                <Label label="Nama jalur" required />
                                <n-input size="large" v-model:value="form.title" placeholder="Masukkan nama jalur" @input="(value) => form.title = value.toUpperCase()" />
                            </div>

                            <!-- Jenjang -->
                            <div class="d-flex flex-column">
                                <Label label="Jenjang" required />
                                <n-select size="large" v-model:value="form.grade" placeholder="Pilih jenjang"
                                    :options="jenjangOptions" />
                            </div>

                            <!-- Deskripsi Jalur (Quill Editor) -->
                            <div class="d-flex flex-column">
                                <Label label="Deskripsi jalur" required />
                                <div ref="editorContainer" class="quill-editor"></div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex">
                                <n-button type="info" @click="submitForm">Buat alur</n-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="js">
import { defineComponent, ref, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Back from '../../../Components/Back.vue';
import Label from '../../../Components/Label.vue';
import Swal from 'sweetalert2';
import {jenjangOptions} from "../../../Utils/menus.ts";

export default defineComponent({
    components: {
        Back,
        Label
    },
    setup() {
        const page = usePage();
        const form = useForm({
            title: '',       // Nama Jalur
            grade: '',      // Jenjang
            description: '', // Deskripsi dari Quill
        });

        // Quill editor reference
        const editorContainer = ref(null);
        let quillEditor = null;

        onMounted(() => {
            // Initialize Quill editor from CDN
            quillEditor = new Quill(editorContainer.value, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link', 'image'],
                        ['clean'],
                    ],
                },
            });

            // Sync Quill content with form
            quillEditor.on('text-change', () => {
                form.description = quillEditor.root.innerHTML;
            });
        });

        // Submit form
        const submitForm = () => {
            form.post(route('registration-step.store'), {
                onSuccess: () => {
                    form.reset();
                    quillEditor.setContents(''); // Clear the Quill editor after successful submit

                    Swal.fire(page.props.flash.success, '', 'success');
                },
                onError: () => {
                    Swal.fire(page.props.flash.error, '', 'error');
                }
            });
        };

        return {
            form,
            editorContainer,
            submitForm,
            jenjangOptions
        };
    }
});
</script>

<style scoped>
.quill-editor {
    min-height: 200px;
}
</style>