<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {DocumentCheckIcon, InformationCircleIcon} from "@heroicons/vue/24/solid/index.js";
import {computed, ref} from "vue";

const props = defineProps({
    tasks: {
        type: Array,
    },
    modules: {
        type: Array,
    },
});

const selectedModule = ref(null);

const filteredTasks = computed(() => {
    if(selectedModule.value === null) {
        return props.tasks;
    }

    return props.tasks.filter((task) => (task.moduleId === selectedModule.value))
})

</script>

<template>
    <Head title="Module"/>
    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <DocumentCheckIcon class="h-6 w-6"/>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-2 ">Aufgaben</h2>
            </div>
        </template>
        <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-black ">
                <div class="flex">
                    <div class="ml-auto ">
                        <select id="module" v-model="selectedModule"
                                class="select select-bordered bg-gray-300 shadow-lg text-black">
                            <option class="text-black" :value="null">
                                Modul auswählen
                            </option>
                            <option class="text-black" :value="module.id" v-for="module in modules">
                                {{ module.name }}
                            </option>
                        </select>
                    </div>
                    <button class="ml-4 btn btn-outline btn-success" @click="$inertia.visit(route('tasks.create'))">
                        Aufgabe erstellen
                    </button>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table" v-if="tasks.length > 0">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th class="text-black">Titel</th>
                                <th class="text-black">Beschreibung</th>
                                <th class="text-black">Status</th>
                                <th class="text-black">Modul</th>
                                <th class="text-black">Erstellt am</th>
                                <th class="text-black">Aktionen</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="task in filteredTasks">
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
        }
    }
}
</script>
