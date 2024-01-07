<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3'
import InputError from "@/Components/InputError.vue";
import {BookOpenIcon} from "@heroicons/vue/24/solid/index.js";

const props = defineProps({
    moduleStatusCases: {
        type: Array,
    },
    module: {
        type: Object
    }
});

const form = useForm({
    name: props.module.name,
    status: props.module.status,
    description: props.module.description,
    start_semester: props.module.startSemester,
    end_semester: props.module.endSemester,
})
</script>

<template>
    <Head title="Modul bearbeiten"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <book-open-icon class="mr-2 h-6 w-6 text-black"/>
                <h2 class="font-semibold text-xl text-black text-black-200 leading-tight">Modul bearbeiten</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
                <div class="p-2 sm:p-4 bg-white dark:bg-gray-800 text-black overflow-hidden shadow-md sm:rounded-md mr-4">
                    <div class="overflow-x-auto">
                        <div class="flex-1">
                            <!-- Form -->
                            <div class="p-8">
                                <form @submit.prevent="form.put(route('modules.update', {module:module.id}))">
                                    <div class="space-y-4">
                                        <label for="name" class="daisy block mb-1 text-lg bg-white">Modulname:</label>
                                        <input id="name" v-model="form.name"
                                               class="input w-full input-bordered bg-white shadow-md"/>
                                        <InputError class="mt-2" :message="form.errors.name"/>

                                        <label for="description" class="daisy block mb-1 text-lg">Beschreibung:</label>
                                        <textarea v-model="form.description" id="description"
                                                  class="textarea textarea-bordered textarea-lg w-full bg-white shadow-md"
                                                  placeholder="Beschreibung der Aufgabe"></textarea>
                                        <InputError class="mt-2" :message="form.errors.description"/>

                                        <label for="module" class="daisy block mb-1 text-lg">Status:</label>
                                        <select id="module" v-model="form.status"
                                                class="select select-bordered w-full bg-white shadow-md text-lg">
                                            <option class="text-black text-lg" :value="moduleStatusCase.value" v-for="moduleStatusCase in moduleStatusCases">
                                                {{ moduleStatusCase.name }}
                                            </option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.status"/>
                                        <label for="credit_points" class="daisy block mb-1 text-lg ">Startsemester:</label>
                                        <input id="credit_points" v-model="form.start_semester" type="number" min="0"
                                               max="30"
                                               class="input w-full input-bordered bg-white shadow-md"/>
                                        <InputError class="mt-2" :message="form.errors.start_semester"/>
                                        <label for="credit_points" class="daisy block mb-1 text-lg ">Endsemester:</label>
                                        <input id="credit_points" v-model="form.end_semester" type="number" min="0"
                                               max="30"
                                               class="input w-full input-bordered bg-white shadow-md"/>
                                        <InputError class="mt-2" :message="form.errors.end_semester"/>
                                    </div>
                                    <br>
                                    <button type="submit"
                                            class="btn btn-accent btn-outline bg-green py-2 px-4 rounded-md">
                                        Modul bearbeiten
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
