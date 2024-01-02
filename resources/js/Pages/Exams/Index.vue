<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {PencilIcon} from "@heroicons/vue/24/solid/index.js";

const props = defineProps({
    exams: {
        type: Array,
    },
});

</script>

<template>
    <Head title="Module"/>
    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <pencil-icon class="h-6 w-6"/>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-2">Prüfungen</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="flex">
                    <PrimaryButton class=" ml-auto" :link="route('exams.create')">
                        Prüfung erstellen
                    </PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>Kürzel</th>
                                <th>Modul</th>
                                <th>ECTS-Punkte</th>
                                <th>Note</th>
                                <th>Erstellt am</th>
                                <th>Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="exam in exams">
                                <td v-text="exam.code"></td>
                                <td v-text="exam.module.name"></td>
                                <td v-text="exam.creditPoints"></td>
                                <td v-text="exam.grade"></td>
                                <td v-text="dayJS(exam.createdAt).format('DD.MM.YYYY HH:MM')"></td>
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
