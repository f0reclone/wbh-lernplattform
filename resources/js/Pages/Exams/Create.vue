<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3'
import InputError from "@/Components/InputError.vue";
import {PencilIcon} from "@heroicons/vue/24/solid/index.js";

const props = defineProps({
    modules: {
        type: Array,
    },
});

const form = useForm({
    code: null,
    module_id: null,
    semester: null,
    credit_points: null,
})
</script>

<template>
    <Head title="Prüfung erstellen"/>

    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <pencil-icon class="h-6 w-6"/>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-2">Prüfung
                    hinzufügen</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <div class="flex-1">
                            <!-- Form -->
                            <div class="p-8">
                                <form @submit.prevent="form.post(route('exams.store'))">
                                    <div class="space-y-4">
                                        <label for="semester" class="daisy block mb-1 text-lg ">Prüfungskürzel:</label>
                                        <input id="code" v-model="form.code" type="text"
                                               class="input w-full input-bordered"/>
                                        <InputError class="mt-2" :message="form.errors.code"/>
                                        <label for="module" class="daisy block mb-1 text-lg">Modul:</label>
                                        <select id="module" v-model="form.module_id"
                                                class="select select-bordered w-full">
                                            <option class="text-black" :value="module.id" v-for="module in modules">
                                                {{ module.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.module"/>

                                        <label for="semester" class="daisy block mb-1 text-lg ">Semester:</label>
                                        <input id="semester" v-model="form.semester" type="number" min="1" max="10"
                                               class="input w-full input-bordered"/>
                                        <InputError class="mt-2" :message="form.errors.semester"/>

                                        <label for="credit_points" class="daisy block mb-1 text-lg">ECTS-Punkte:</label>
                                        <input id="credit_points" v-model="form.credit_points" type="number" min="0"
                                               max="30"
                                               class="input w-full input-bordered"/>
                                        <InputError class="mt-2" :message="form.errors.credit_points"/>


                                    </div>
                                    <br>
                                    <button type="submit"
                                            class="btn btn-accent btn-outline bg-green py-2 px-4 rounded-md ml-auto">
                                        Prüfung speichern
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
