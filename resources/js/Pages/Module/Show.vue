<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    module: {
        type: Object
    }
});
</script>

<template>
    <Head title="Modul anzeigen" />

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
                                    <!-- Add the appropriate SVG path here for showing the module icon or other visual representation -->
                                </svg>
                                <span class="text-2xl font-extrabold mx-2">Modul anzeigen</span>
                            </a>
                        </div>

                        <!-- Module Information as Card -->
                        <div class="p-8">
                            <div class="card w-96 bg-base-100 shadow-xl mb-4">
                                <div class="space-y-4 p-6">
                                    <label class="daisy block mb-1 text-lg">
                                        <span class="border-b-2 border-solid border-whitek pb-0">Modulname:</span>
                                    </label>
                                    <span>{{ module.name }}</span>

                                    <label class="daisy block mb-1 text-lg">
                                        <span class="border-b-2 border-solid border-whitek pb-0">Beschreibung:</span>
                                    </label>
                                    <p>{{ module.description }}</p>

                                    <label class="daisy block mb-1 text-lg">
                                        <span class="border-b-2 border-solid border-whitek pb-0">Status:</span>
                                    </label>
                                    <span>{{ module.status }}</span>

                                    <label class="daisy block mb-1 text-lg">
                                        <span class="border-b-2 border-solid border-whitek pb-0">Start Semester:</span>
                                    </label>
                                    <span>{{ module.startSemester }}</span>

                                    <label class="daisy block mb-1 text-lg">
                                        <span class="border-b-2 border-solid border-whitek pb-0">End Semester:</span>
                                    </label>
                                    <span>{{ module.endSemester }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


