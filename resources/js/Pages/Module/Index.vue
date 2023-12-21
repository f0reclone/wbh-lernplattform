<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    modules: {
        type: Array,
    },
});
</script>

<template>
    <Head title="Module"/>

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Module</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="relative flex min-h-screen">

                    <div class="bg-slate-500 text-cyan-100 w-48 ">
                        <a href="" class="flex itemns-center mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 ">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                            <span class="text-2xl font-extrabold mx-2">Modulfilter</span>
                        </a>
                        <br><br><br>
                        <InputLabel><span class="mx-2 text-lg font-extrabold">Semester</span></InputLabel>
                        <div class="left mx-2 lg:px-3 space-y-1">
                            <!-- Repeat the checkbox for each semester -->
                            <div class="flex items-center ">
                                <input type="checkbox" class="checkbox checkbox-primary" id="semester1"
                                       name="semester1">
                                <label for="semester1" class="ml-2">1</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="checkbox checkbox-primary" id="semester1"
                                       name="semester1">
                                <label for="semester1" class="ml-2">2</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="checkbox checkbox-primary" id="semester1"
                                       name="semester1">
                                <label for="semester1" class="ml-2">3</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="checkbox checkbox-primary" id="semester1"
                                       name="semester1">
                                <label for="semester1" class="ml-2">4</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="checkbox checkbox-primary" id="semester1"
                                       name="semester1">
                                <label for="semester1" class="ml-2">5</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="checkbox checkbox-primary" id="semester1"
                                       name="semester1">
                                <label for="semester1" class="ml-2">6</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="checkbox checkbox-primary" id="semester1"
                                       name="semester1">
                                <label for="semester1" class="ml-2">7</label>
                            </div>
                        </div>
                        <br>
                        <InputLabel><span class="text-lg ml-2 font-extrabold space-y-5">Sortieren nach</span>
                        </InputLabel>
                        <div class="left mx-2 lg:px-3 space-y-0.5">
                            <div>
                                <input type="radio" class="radio radio-primary" id="sortBySemester" name="sortOption"
                                       value="semester">
                                <label for="sortBySemester" class="mx-2">Semester</label>
                            </div>
                            <div>
                                <input type="radio" class="radio radio-primary" id="sortBySemester" name="sortOption"
                                       value="semester">
                                <label for="sortBySemester" class="mx-2">Module</label>
                            </div>
                            <div>
                                <input type="radio" class="radio radio-primary" id="sortBySemester" name="sortOption"
                                       value="semester">
                                <label for="sortBySemester" class="mx-2">Status</label>
                            </div>
                        </div>
                        <br>
                        <div class="space-y-2">
                            <InputLabel><span
                                class="text-sm ml-2 font-extrabold space-y-5">Erledigte Tasks anzeigen</span>
                            </InputLabel>
                            <div class="left mx-2 lg:px-3 space-y-0.5">
                                <div>
                                    <input type="radio" class="radio radio-primary" id="showCompletedYes"
                                           name="showCompleted" value="yes">
                                    <label for="showCompletedYes">Ja</label>
                                </div>
                                <div>
                                    <input type="radio" class="radio radio-primary" id="showCompletedNo"
                                           name="showCompleted" value="no">
                                    <label for="showCompletedNo">Nein</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Main content -->
                    <div class="flex-1">
                        <!-- Header -->
                        <div class="px-4 py-4 space-x-4">
                            <TextInput v-model="d" placeholder="Search Module..." class="w-60"/>
                            <Link href="/modules/create" class="btn btn-accent btn-outline bg-green " method="get"
                                  as="button">Module hinzufügen
                            </Link>
                        </div>
                        <div class="px-4 py-4 space-x-4">
                            <!-- Content -->
                            <div class="card w-96 bg-base-100 shadow-xl" v-for="module in filteredModules">
                                <div class="card-body">
                                    <h2 class="card-title">{{ module.name }}</h2>
                                    <p>Start Semester {{ module.start_semester }}</p>
                                    <p>Ende Semester {{ module.end_semester }}</p>
                                    <div class="card-actions justify-end">
                                        <a class="btn btn-primary" :href="route('modules.edit', {'module': module.id})">Bearbeiten</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script>

export default {
    computed: {
        filteredModules() {
            let modules = this.modules;
            // TODO: check for search

            // TODO: check for filters

            // TODO: Sort

            return modules;
        }
    }
}

</script>
