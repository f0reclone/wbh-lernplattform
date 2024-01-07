<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {InformationCircleIcon, PencilIcon, PencilSquareIcon, TrashIcon} from "@heroicons/vue/24/solid/index.js";
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
                <pencil-icon class="mr-2 h-6 w-6 text-black"/>
                <h2 class="font-semibold text-xl text-black leading-tight">Hier findest du alle deine Prüfungen.</h2>
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2 text-black ">
                <!-- Full Width row -->

                <div class="mr-4 lg:flex lg:items-center lg:justify-between ">
                    <!-- Filters and Button on the Left Side -->
                    <div class="flex items-center ">
                        <div class="ml-auto ">
                            <select id="module" v-model="selectedModule"
                                    class="mb-3 select select-bordered bg-white shadow-md text-black">
                                <option class="text-black" :value="null">
                                    Modul auswählen
                                </option>
                                <option class="text-black" :value="module.id" v-for="module in modules">
                                    {{ module.name }}
                                </option>
                            </select>
                        </div>
                        <button class="mb-3 ml-3 bg-white btn btn-outline btn-success shadow-md" @click="$inertia.visit(route('exams.create'))">
                            Prüfung erstellen
                        </button>
                    </div>
                </div>
                <div class="mr-4 p-4 sm:p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg ">
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
                                    <Link :href="route('exams.edit', {'exam': exam.id})"
                                          as="button" type="button" class="btn btn-sm btn-info btn-circle text-white">
                                        <PencilSquareIcon class="h-4 w-4"/>
                                    </Link>
                                    <Link :href="route('exams.destroy', {'exam': exam.id})"
                                          method="DELETE" as="button" type="button"
                                          class="ml-4 btn btn-sm btn-error btn-circle text-white">
                                        <TrashIcon class="h-4 w-4"/>
                                    </Link>
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
