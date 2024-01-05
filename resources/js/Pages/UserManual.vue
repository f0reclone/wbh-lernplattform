<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {QuestionMarkCircleIcon} from "@heroicons/vue/24/solid/index.js";

</script>

<template>
    <Head title="Hilfe" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <QuestionMarkCircleIcon class="mr-2 h-6 w-6 text-black fill-none strokeWidth-5 stroke-black strokeLinecap-round strokeLinejoin-round"/>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Hilfe</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-md mr-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Hier findest du eine kurze Tour durch alle wichtigen Features dieser Web-App:</h1><br>
                        <video controls class="w-full aspect-video rounded-md">
                            <source src="/rickroll.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
