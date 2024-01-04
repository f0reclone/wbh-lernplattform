<script setup xmlns="http://www.w3.org/1999/html">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {computed, ref} from "vue";
import {
    BookOpenIcon,
    PencilIcon,
    ClipboardDocumentListIcon,
    PencilSquareIcon,
    TrashIcon
} from "@heroicons/vue/24/solid/index.js";
import dayJS from 'dayjs';
import {Link} from '@inertiajs/vue3'

const props = defineProps({
    moduleStatusCases: {
        type: Array,
    },
    tasks: {
        type: Array,
    },
    exams: {
        type: Array,
    },
    module: {
        type: Object
    }
});

const currentRoute = computed(() => {
    return route('modules.show', {module: props.module.id}, false);
})


</script>

<template>
    <Head title="Modul anzeigen"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <book-open-icon class="h-6 w-6"/>
                <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">Modulinformationen</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="relative ">
                    <div class="flex w-full text-black">
                        <!-- Module Information as Card -->
                        <div
                            class="p-4 sm:p-8 card w-full bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                            <div class="flex items-center">
                                <book-open-icon class="h-6 w-6"/>
                            </div>

                            <label class="daisy block mb-1 text-lg ">
                                <span class="border-b-2 border-solid border-gray pb-0">Modulname:</span>
                            </label>
                            <span>{{ module.name }}</span>

                            <label class="daisy block mb-1 text-lg">
                                <span class="border-b-2 border-solid border-gray pb-0">Beschreibung:</span>
                            </label>
                            <p>{{ module.description }}</p>

                            <label class="daisy block mb-1 text-lg">
                                <span class="border-b-2 border-solid border-gray pb-0">Status:</span>
                            </label>
                            <span>{{ moduleStatusCases.find(status => status.value === module.status)?.name }}</span>

                            <label class="daisy block mb-1 text-lg">
                                <span class="border-b-2 border-solid border-gray pb-0">Start Semester:</span>
                            </label>
                            <span>{{ module.startSemester }}</span>

                            <label class="daisy block mb-1 text-lg">
                                <span class="border-b-2 border-solid border-gray pb-0">End Semester:</span>
                            </label>
                            <span>{{ module.endSemester }}</span>
                        </div>

                        <div
                            class="p-4 sm:p-8 card w-full bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg ml-4">
                            <div class="flex items-center mb-4">
                                <pencil-icon class="h-4 w-4"/>
                                <h3 class="ml-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                    Prüfungen für dieses Modul</h3>
                                <Link class="ml-auto btn-sm btn btn-outline btn-success"
                                      :href="route('exams.create', {moduleId: module.id, redirectTo: currentRoute})">
                                    Prüfung erstellen
                                </Link>
                            </div>


                            <table class="table" v-if="exams.length > 0">
                                <!-- head -->
                                <thead>
                                <tr>
                                    <th class="text-black">Kürzel</th>
                                    <th class="text-black">ECTS-Punkte</th>
                                    <th class="text-black">Note</th>
                                    <th class="text-black">Prüfungstermin</th>
                                    <th class="text-black">Aktionen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="exam in exams">
                                    <td v-text="exam.code"></td>
                                    <td v-text="exam.creditPoints"></td>
                                    <td v-text="exam.grade"></td>
                                    <td v-text="exam.examDate !== null ? dayJS(exam.examDate).format('DD.MM.YYYY') : ''"></td>
                                    <td class="space-x-2 min-w-128">
                                        <Link :href="route('exams.edit', {exam: exam.id, redirectTo: currentRoute})"
                                              as="button" type="button"
                                              class="btn btn-sm btn-info btn-circle text-white">
                                            <PencilSquareIcon class="h-4 w-4"></PencilSquareIcon>
                                        </Link>
                                        <Link :href="route('exams.destroy', {exam: exam.id, redirectTo: currentRoute})"
                                              method="DELETE" as="button" type="button"
                                              class="btn btn-sm btn-error btn-circle text-white">
                                            <TrashIcon class="h-4 w-4"/>
                                        </Link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>

                    </div>

                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg text-black">
                    <div class="flex items-center mb-4">
                        <clipboard-document-list-icon class="h-4 w-4"/>
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Verknüpfte
                            Aufgaben</h3>
                        <Link class="ml-auto btn-sm btn btn-outline btn-success"
                              :href="route('tasks.create', {moduleId: module.id, redirectTo: currentRoute})">
                            Aufgabe erstellen
                        </Link>
                    </div>
                    <div class="overflow-x-auto ">
                        <table class="table table-fixed" v-if="tasks && tasks.length > 0">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th class="text-black w-1/4">Titel</th>
                                <th class="text-black w-1/3">Beschreibung</th>
                                <th class="text-black">Status</th>
                                <th class="text-black">Erstellt am</th>
                                <th class="text-black">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="task in tasks">
                                <td v-text="task.title"></td>
                                <td v-text="task.description"></td>
                                <td v-text="task.statusName"></td>
                                <td v-text="dayJS(task.createdAt).format('DD.MM.YYYY HH:MM')"></td>
                                <td class="space-x-2 min-w-128">
                                    <Link :href="route('tasks.edit', {task: task.id, redirectTo: currentRoute})"
                                          as="button" type="button" class="btn btn-sm btn-info btn-circle text-white">
                                        <PencilSquareIcon class="h-4 w-4"/>
                                    </Link>
                                    <Link :href="route('tasks.destroy', {task: task.id, redirectTo: currentRoute})"
                                          method="DELETE" as="button" type="button"
                                          class="btn btn-sm btn-error btn-circle text-white">
                                        <TrashIcon class="h-4 w-4"/>
                                    </Link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p class="text-center flex" v-else>
                            <information-circle-icon class="w-6 h-6 mr-2"></information-circle-icon>
                            Es sind keine Aufgaben verfügbar. Erstelle doch welche!
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
        deleteTask(taskId) {
            router.delete(route('tasks.destroy', {task: taskId}))
        },
        editTask(taskId) {
            router.edit(route('tasks.destroyTaskFromModuleShow', {task: taskId}))
        }
    }
}
</script>
