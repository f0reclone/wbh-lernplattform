<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3'
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    moduleStatusCases: {
        type: Array,
    },
});

const form = useForm({
    name: null,
    status: props.moduleStatusCases[0].value,
    start_semester: null,
    end_semester: null,
})
</script>

<template>
    <Head title="Modul erstellen"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="relative flex min-h-screen">
                    <!-- Sidebar content here if any -->

                    <!-- Main content -->
                    <div class="flex-1">
                        <!-- Header -->
                        <div class="px-4 py-4 space-x-4">
                            <a href="" class="flex itemns-center mx-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                                <span class="text-2xl font-extrabold mx-2">Modul hinzufügen</span>
                            </a>
                        </div>

                        <!-- Form -->
                        <div class="p-8">
                            <form @submit.prevent="form.post('/modules')">
                                <div class="space-y-4">
                                    <label for="name" class="daisy block mb-1 text-lg ">Modulname:</label>
                                    <input id="name" v-model="form.name"
                                           class="border rounded-md p-2 w-2/3 md:w-1/2 focus:border-blue-500 focus:ring-green-500 bg-gray-200 text-black "/>
                                    <InputError class="mt-2" :message="form.errors.name" />

                                    <label for="status" class="daisy block mb-1 text-lg">Status:</label>
                                    <select id="status" v-model="form.status"
                                            class="border rounded-md p-2 w-2/3 md:w-1/2 focus:border-blue-500 text-black focus:ring-green-500 bg-gray-200">
                                        <option class="text-black" :value="moduleStatusCase.value" v-for="moduleStatusCase in moduleStatusCases">
                                            {{ moduleStatusCase.name }}</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.status" />

                                    <label for="start_semester" class="daisy block mb-1 text-lg  ">Start
                                        Semester:</label>
                                    <input type="number" id="start_semester" v-model="form.start_semester"
                                           class="text-black border rounded-md p-2 w-2/3 md:w-1/2 focus:border-blue-500 focus:ring-green-500 bg-gray-200"/>
                                    <InputError class="mt-2" :message="form.errors.start_semester" />

                                    <label for="end_semester" class="daisy block mb-1 text-lg">End Semester:</label>
                                    <input type="number" id="end_semester" v-model="form.end_semester"
                                           class="text-black border rounded-md p-2 w-2/3 md:w-1/2 focus:border-blue-500 focus:ring-green-500 bg-gray-200"/>
                                    <InputError class="mt-2" :message="form.errors.end_semester" />
                                </div>
                                <br>
                                <button type="submit" class="btn btn-accent btn-outline bg-green py-2 px-4 rounded-md">
                                    Modul erstellen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
