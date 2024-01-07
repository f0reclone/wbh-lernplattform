<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {BookOpenIcon, AdjustmentsVerticalIcon} from "@heroicons/vue/24/solid/index.js";

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
    margin-right: 0.5rem;
}
.flex.flex-wrap > .card:last-child {
    margin-right: 0;
}

</style>
<template>
    <Head title="Module"/>

    <AuthenticatedLayout>

        <template #header>
            <div class="flex items-center">
            <book-open-icon class="mr-2 h-6 w-6 text-black"/>
            <h2 class="font-semibold text-xl text-black text-black-200 leading-tight">Hier findest du alle deine Module.</h2>
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-2 lg:px-8">
                <!-- Filters Container -->
                <div class="lg:flex lg:items-center lg:justify-between">
                    <!-- Filters and Button on the Left Side -->
                    <div class="flex items-center ">
                        <!-- Semester Filter -->
                        <div class="dropdown dropdown-hover items-center mb-3">
                            <div tabindex="0" role="button" class="btn bg-white hover:bg-white text-black hover:text-black shadow-md">
                                <adjustments-vertical-icon class="h-6 w-6"/>
                                Semester
                            </div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-md bg-white rounded-md w-52 hover:bg-white text-black shadow-md">
                                <li v-for="semester in semesters" :key="semester">
                                    <a @click="toggleSemester(semester)">
                                        <input type="checkbox" :checked="selectedSemesters.includes(semester)" class="checkbox checkbox-xs">
                                        Semester {{ semester }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Status Filter -->
                        <div class="dropdown dropdown-hover ml-3 mb-3">
                            <div tabindex="0" role="button" class="btn bg-white hover:bg-white text-black hover:text-black shadow-md">
                                <adjustments-vertical-icon class="h-6 w-6"/>
                                Status
                            </div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-md bg-white rounded-md w-52 hover:bg-white text-black shadow-md">
                                <li v-for="moduleStatusCase in moduleStatusCases" :key="moduleStatusCase.value">
                                    <a @click="toggleStatus(moduleStatusCase.value)">
                                        <input type="checkbox" :checked="selectedStatuses.includes(moduleStatusCase.value)" class="checkbox checkbox-xs">
                                        {{ moduleStatusCase.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Sort By Filter -->
                        <div class="dropdown dropdown-hover ml-3 mb-3">
                            <div tabindex="0" role="button" class="btn bg-white hover:bg-white text-black hover:text-black inline-flex items-center shadow-md">
                                <adjustments-vertical-icon class="h-6 w-6"/>
                                Sortieren nach
                            </div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-md bg-white rounded-md w-52 hover:bg-bg-white text-black shadow-md">
                                <li>
                                    <a @click="setSortOption('semester')">
                                        <input type="radio" :checked="sortOption === 'semester'" class="radio radio-xs">
                                        Semester
                                    </a>
                                </li>
                                <li>
                                    <a @click="setSortOption('module')">
                                        <input type="radio" :checked="sortOption === 'module'" class="radio radio-xs">
                                        Module
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <button class="mb-3 ml-3 bg-white btn btn-outline btn-success shadow-md" @click="$inertia.visit(route('modules.create'))">
                                Modul hinzufügen
                            </button>
                        </div>
                    </div>
                    <div class="ml-auto flex items-center space-x-4 mb-3">
                        <div class="px-4 space-x-4 space-y-3 ">
                            <TextInput v-model="searchQuery" placeholder="Suchen..." class="w-60"/>
                        </div>
                    </div>
                </div>

                <!-- Main content -->
                <div class="lg:flex lg:items-center lg:justify-between rounded-md bg-white mr-4 shadow-md">
                    <div class="px-4 py-4 flex flex-wrap">
                        <!-- Content -->
                        <div class="w-96 bg-gray-50 rounded-md mr-1 text-black shadow-md mb-4" v-for="(module, index) in filteredModules" :key="module.id">
                            <div class="card-body flex flex-col h-full justify-between">
                                <div>
                                    <h2 class="card-title mb-1">{{ module.name }}</h2>
                                    <p class="mb-1"> <u>Status:</u> {{ module.statusName }}</p>
                                    <p class="mb-1"> <u>Beschreibung:</u> {{ module.description }}</p>
                                    <p><u>Startsemester:</u> {{ module.startSemester }}</p>
                                    <p><u>Endsemester:</u> {{ module.endSemester }}</p>
                                </div>
                                <div class="card-actions flex justify-between mt-auto">
                                    <div class="card-actions">
                                        <a class="btn btn-outline btn-info" :href="route('modules.show', {'module': module.id})">Anzeigen</a>
                                    </div>
                                    <div class="card-actions">
                                        <a class="btn btn-outline btn-success" :href="route('modules.edit', {'module': module.id})">Bearbeiten</a>
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
            return [...(new Array(6)).keys()].map((index) => index + 1);
        }
    },
    methods: {
        setSortOption(option) {
            this.sortOption = option;
        },
        toggleSemester(semester) {
            if (this.selectedSemesters.includes(semester)) {
                this.selectedSemesters = this.selectedSemesters.filter(s => s !== semester);
            } else {
                this.selectedSemesters.push(semester);
            }
        },

        toggleStatus(status) {
            if (this.selectedStatuses.includes(status)) {
                this.selectedStatuses = this.selectedStatuses.filter(s => s !== status);
            } else {
                this.selectedStatuses.push(status);
            }
        },
        filterModules(modules) {
            if (this.selectedSemesters.length > 0) {
                modules = modules.filter(module => module.semesters.some((semester) => this.selectedSemesters.includes(semester)));
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
