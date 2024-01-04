<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3'
import InputError from "@/Components/InputError.vue";
import { DocumentCheckIcon } from '@heroicons/vue/24/solid'
const props = defineProps({
    modules: {
        type: Array,
    },
});

const redirectTo =  usePage().props.ziggy.query?.redirectTo ?? null;

const form = useForm({
    title: null,
    description: null,
    moduleId: usePage().props.ziggy.query?.moduleId ?? null,
})
</script>

<template>
    <Head title="Aufgabe erstellen"/>

    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
                <DocumentCheckIcon class="h-6 w-6" />
                <h2 class="font-semibold text-xl text-black bg-white leading-tight ml-2">Aufgabe
                    hinzufügen</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 text-black bg-white shadow-lg rounded-box">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <div class="flex-1">
                            <!-- Form -->
                            <div class="p-8">
                                <form @submit.prevent="form.post(route('tasks.store', {redirectTo}))">
                                    <div class="space-y-4">
                                        <label for="name" class="daisy block mb-1 text-lg bg-white">Titel:</label>
                                        <input id="name" v-model="form.title"
                                               class="input w-full input-bordered bg-white shadow-lg"/>
                                        <InputError class="mt-2" :message="form.errors.title"/>

                                        <label for="description" class="daisy block mb-1 text-lg">Beschreibung:</label>
                                        <textarea v-model="form.description" id="description"
                                                  class="textarea textarea-bordered textarea-lg w-full bg-white shadow-lg"
                                                  placeholder="Beschreibung der Aufgabe"></textarea>
                                        <InputError class="mt-2" :message="form.errors.description"/>

                                        <label for="module" class="daisy block mb-1 text-lg">Modul:</label>
                                        <select id="module" v-model="form.moduleId"
                                                class="select select-bordered w-full bg-white shadow-lg">
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
