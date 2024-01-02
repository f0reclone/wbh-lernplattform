<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3'
import InputError from "@/Components/InputError.vue";
import Book from "@/Components/icons/Book.vue";
import {DocumentCheckIcon} from "@heroicons/vue/24/solid/index.js";

const props = defineProps({
    task: {
        type: Object,
    },
    modules: {
        type: Array,
    },
    taskStatusValues: {
        type: Array,
    },
});

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    status: props.task.status,
    module_id: props.task.moduleId,
})
</script>

<template>
    <Head title="Aufgabe bearbeiten"/>

    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <DocumentCheckIcon class="h-6 w-6" />
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-2">Aufgabe
                    bearbeiten</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <div class="flex-1">
                            <!-- Form -->
                            <div class="p-8">
                                <form @submit.prevent="form.put(route('tasks.update', {'task': task.id}))">
                                    <div class="space-y-4">

                                        <label for="name" class="daisy block mb-1 text-lg ">Titel:</label>
                                        <input id="name" v-model="form.title"
                                               class="input w-full input-bordered"/>
                                        <InputError class="mt-2" :message="form.errors.title"/>

                                        <label for="description" class="daisy block mb-1 text-lg">Beschreibung:</label>
                                        <textarea v-model="form.description" id="description"
                                                  class="textarea textarea-bordered textarea-lg w-full"
                                                  placeholder="Beschreibung der Aufgabe"></textarea>
                                        <InputError class="mt-2" :message="form.errors.description"/>

                                        <label for="module" class="daisy block mb-1 text-lg">Modul:</label>
                                        <select id="module" v-model="form.module_id"
                                                class="select select-bordered w-full">
                                            <option class="text-black" :value="module.id" v-for="module in modules">
                                                {{ module.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.module"/>
                                        <label for="status" class="daisy block mb-1 text-lg">Status:</label>
                                        <select id="status" v-model="form.status"
                                                class="select select-bordered w-full">
                                            <option class="text-black" :value="taskStatusValue.value"
                                                    v-for="taskStatusValue in taskStatusValues">
                                                {{ taskStatusValue.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.status"/>
                                    </div>
                                    <br>
                                    <button type="submit"
                                            class="btn btn-accent btn-outline bg-green py-2 px-4 rounded-md">
                                        Aufgabe speichern
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
