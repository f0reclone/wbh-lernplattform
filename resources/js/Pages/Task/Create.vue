<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3'
import InputError from "@/Components/InputError.vue";
import { DocumentCheckIcon } from '@heroicons/vue/24/solid'
const props = defineProps({
    modules: {
        type: Array,
    },
});

const form = useForm({
    title: null,
    description: null,
    moduleId: null,
})
</script>

<template>
    <Head title="Aufgabe erstellen"/>

    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <DocumentCheckIcon class="h-6 w-6" />
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ml-2">Aufgabe
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
                                <form @submit.prevent="form.post('/tasks')">
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
                                        <select id="module" v-model="form.moduleId"
                                                class="select select-bordered w-full">
                                            <option class="text-black" :value="module.id" v-for="module in modules">
                                                {{ module.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.module"/>
                                    </div>
                                    <br>
                                    <button type="submit"
                                            class="btn btn-accent btn-outline bg-green py-2 px-4 rounded-md ml-auto">
                                        Aufgabe erstellen
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
