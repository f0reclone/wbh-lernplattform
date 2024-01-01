<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    moduleStatusCases: {
        type: Array,
    },
    modules: {
        type: Array,
    },
});

</script>
<style scoped>
.flex.flex-wrap > .card:not(:last-child) {
    margin-right: 1rem; /* Adjust as needed for the desired spacing */
}

/* Counteract the margin on the last card in each row */
.flex.flex-wrap > .card:last-child {
    margin-right: 0;
}
</style>
<template>
    <Head title="Module"/>

    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Module</h2>
        </template>
        <div class="py-12 max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="relative flex min-h-screen">
                <!-- Left sidebar for filters -->
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
                        <div class="flex items-center " v-for="semester in semesters">
                            <input type="checkbox" class="checkbox checkbox-primary" :id="'semester-' + semester"
                                   v-model="selectedSemesters" :value="semester"
                                   name="semester1">
                            <label for="'semester-' + semester" class="ml-2">{{ semester }}</label>
                        </div>

                    </div>
                    <br>

                    <InputLabel><span class="text-lg mt-2 ml-2 font-extrabold space-y-5">Status</span></InputLabel>
                    <div class="left mx-2 lg:px-3 space-y-1">
                        <!-- Repeat the checkbox for each semester -->
                        <div class="flex items-center" v-for="moduleStatusCase in moduleStatusCases">
                            <label class="flex items-center">
                                <input type="checkbox" class="checkbox checkbox-primary" v-model="selectedStatuses"
                                       :id="moduleStatusCase.value"
                                       :value="moduleStatusCase.value">
                                <span class="ml-2">{{ moduleStatusCase.name }}</span>
                            </label>
                        </div>
                    </div>


                    <InputLabel><span class="text-lg ml-2 font-extrabold space-y-5">Sortieren nach</span>
                    </InputLabel>
                    <div class="left mx-2 lg:px-3 space-y-0.5">
                        <div>
                            <input type="radio" class="radio radio-primary" id="sortBySemester" v-model="sortOption"
                                   name="sortOption"
                                   value="semester">
                            <label for="sortBySemester" class="mx-2">Semester</label>
                        </div>
                        <div>
                            <input type="radio" class="radio radio-primary " id="sortByModule" v-model="sortOption"
                                   name="sortOption"
                                   value="module">
                            <label for="sortBySemester" class="mx-2">Module</label>
                        </div>
                    </div>
                </div>
                <!-- Main content -->
                <div class="flex-1">
                    <div class="px-4 py-4 space-x-4">
                        <TextInput v-model="searchQuery" placeholder="Search Module..." class="w-60"/>
                        <Link :href="route('modules.create')" class="btn btn-accent btn-outline bg-green" method="get"
                              as="button">Module hinzufügen
                        </Link>
                    </div>
                    <div class="px-4 py-4 flex flex-wrap">
                        <!-- Content -->
                        <div class="card w-96 bg-base-100 shadow-xl mb-4" v-for="(module, index) in filteredModules"
                             :key="module.id">
                            <div class="card-body">
                                <h2 class="card-title">{{ module.name }}</h2>
                                <p>Status: {{ module.statusName }}</p>
                                <p>Beschreibung: {{module.description}}</p>
                                <p>Start: Semester {{ module.startSemester }}</p>
                                <p>Ende: Semester {{ module.endSemester }}</p>
                                <div class="flex justify-between">
                                <div class="card-actions">
                                    <a class="btn btn-warning" :href="route('modules.show', {'module': module.id})">Anzeigen</a>
                                </div>
                                <div class="card-actions">
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
    data() {
        return {
            selectedSemesters: [],
            sortOption: '',
            selectedStatuses: [],
            showCompleted: 'yes',
            searchQuery: ''
        };


    },
    computed: {
        filteredModules() {
            let modules = this.filterModules(this.modules);
            modules = this.searchModules(modules);
            modules = this.selectedStatusesFilter(modules);
            console.log('Filtered modules:', modules);
            return this.sortModules(modules);
        },
        semesters() {
            return [...(new Array(7)).keys()].map((index) => index + 1);
        }
    },
    methods: {
        filterModules(modules) {
            if (this.selectedSemesters.length > 0) {
                modules = modules.filter(module => module.semesters.some((semester) => this.selectedSemesters.includes(semester.toString())));
            }
            console.log('Filtered modules:', modules);
            return modules;
        },
        searchModules(modules) {
            if (this.searchQuery.trim() !== '') {
                return modules.filter(module => module.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
            }
            return modules;
        },
        selectedStatusesFilter: function (modules) {
            if (this.selectedStatuses.length === 0) {
                return modules;
            }
            const selectedStatusesArray = Array.isArray(this.selectedStatuses)
                ? this.selectedStatuses.map(status => status.toLowerCase())
                : [this.selectedStatuses.toLowerCase()];

            console.log(selectedStatusesArray);

            // Filter modules based on selected statuses
            const filteredModules = modules.filter(module =>
                selectedStatusesArray.some(status => module.status.toLowerCase().includes(status))
            );

            console.log(filteredModules);

            return filteredModules;
        },
        sortModules(modules) {
            switch (this.sortOption) {
                case 'semester':
                    return modules.sort((a, b) => a.startSemester - b.startSemester);
                case 'module':
                    return modules.sort((a, b) => a.name.localeCompare(b.name));
                default:
                    return modules;
            }
        }
    }
}
</script>
