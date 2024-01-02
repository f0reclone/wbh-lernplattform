<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Book from "@/Components/icons/Book.vue";
import {DocumentCheckIcon} from "@heroicons/vue/24/solid/index.js";

const props = defineProps({
    tasks: {
        type: Array,
    },
});

</script>

<template>
    <Head title="Module"/>
    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <DocumentCheckIcon class="h-6 w-6" />
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-2">Aufgaben</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="flex">
                    <PrimaryButton class=" ml-auto" :link="route('tasks.create')">
                        Aufgabe erstellen
                    </PrimaryButton>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th>Titel</th>
                                <th>Beschreibung</th>
                                <th>Status</th>
                                <th>Modul</th>
                                <th>Erstellt am</th>
                                <th>Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="task in tasks">
                                <td v-text="task.title"></td>
                                <td v-text="task.description"></td>
                                <td v-text="task.statusName"></td>
                                <td v-text="task.module.name"></td>
                                <td v-text="dayJS(task.createdAt).format('DD.MM.YYYY HH:MM')"></td>
                                <td>
                                    <PrimaryButton class="ml-4" :link="route('tasks.edit', {'task': task.id})">
                                        Bearbeiten
                                    </PrimaryButton>
                                    <DangerButton class="ml-4" @click="deleteTask(task.id)">
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
        deleteTask(taskId) {
            router.delete(route('tasks.destroy', {task: taskId}))
        }
    }
}
</script>
