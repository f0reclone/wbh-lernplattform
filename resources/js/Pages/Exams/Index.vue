<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {InformationCircleIcon, PencilIcon} from "@heroicons/vue/24/solid/index.js";
import {computed, ref} from "vue";

const props = defineProps({
    exams: {
        type: Array,
    },
    modules: {
        type: Array,
    },
});

const selectedModule = ref(null);

const filteredExams = computed(() => {
    if(selectedModule.value === null) {
        return props.exams;
    }

    return props.exams.filter((exam) => (exam.moduleId === selectedModule.value))
})

</script>

<template>
    <Head title="Module"/>
    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <pencil-icon class="h-6 w-6"/>
                <h2 class="font-semibold text-xl text-black leading-tight ml-2">Prüfungen</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-black">
                <div class="flex">
                    <div class="ml-auto ">
                    <select id="module" v-model="selectedModule"
                            class="select select-bordered bg-gray-300 shadow-lg text-black">
                        <option class="text-black bg-gray-200 hover:bg-gray-200" :value="null">
                            Modul auswählen
                        </option>
                        <option class="text-black" :value="module.id" v-for="module in modules">
                            {{ module.name }}
                        </option>
                    </select>
                    </div>
                    <button class="ml-4 btn btn-outline btn-success" @click="$inertia.visit(route('exams.create'))">
                        Prüfung erstellen
                    </button>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg ">
                    <div class="overflow-x-auto">
                        <table class="table" v-if="exams.length > 0">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th class="text-black">Kürzel</th>
                                <th class="text-black">Modul</th>
                                <th class="text-black">ECTS-Punkte</th>
                                <th class="text-black">Note</th>
                                <th class="text-black">Prüfungstermin</th>
                                <th class="text-black">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="exam in filteredExams">
                                <td v-text="exam.code"></td>
                                <td v-text="exam.module.name"></td>
                                <td v-text="exam.creditPoints"></td>
                                <td v-text="exam.grade"></td>
                                <td v-text="exam.examDate !== null ? dayJS(exam.examDate).format('DD.MM.YYYY') : ''"></td>
                                <td>
                                    <PrimaryButton class="ml-4" :link="route('exams.edit', {'exam': exam.id})">
                                        Bearbeiten
                                    </PrimaryButton>
                                    <DangerButton class="ml-4" @click="deleteExam(exam.id)">
                                        Löschen
                                    </DangerButton>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p class="text-center flex" v-else>
                            <information-circle-icon class="w-6 h-6 mr-2"></information-circle-icon>
                            Es sind keine Prüfungen verfügbar. Erstelle doch welche!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script>

import {router} from "@inertiajs/vue3";

export default {
    inject: ['dayJS'],
    methods: {
        deleteExam(examId) {
            router.delete(route('exams.destroy', {exam: examId}))
        }
    }
}
</script>
