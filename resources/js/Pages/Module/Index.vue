<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {BookOpenIcon, AdjustmentsVerticalIcon,InformationCircleIcon} from "@heroicons/vue/24/solid/index.js";

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
            <book-open-icon class="h-6 w-6"/>
            <h2 class="font-semibold text-xl text-black text-black-200 leading-tight">Module</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white rounded-box shadow-lg">
                <!-- Filters Container -->
                <div class="flex auto space-x-4 mb-4 space-y-2">
                    <div class="px-4 space-x-4 space-y-3 ">
                        <TextInput v-model="searchQuery" placeholder="Suche Modul ..." class="w-60"/>
                        <Link :href="route('modules.create')" class="btn btn-accent btn-outline bg-green shadow-lg" method="get"
                              as="button" style="background-color: white; color: rgb(55, 65, 81);">Module hinzufügen
                        </Link>
                    </div>
                    <!-- Semester Filter -->
                    <div class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="btn m-1 bg-gray-200 hover:bg-gray-200 text-black hover:text-black shadow-lg">
                            <adjustments-vertical-icon class="h-6 w-6"/>
                            Semester
                        </div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-lg bg-gray-200 rounded-box w-52 hover:bg-gray-200 text-black shadow-lg">
                            <li v-for="semester in semesters" :key="semester">
                                <a @click="toggleSemester(semester)">
                                    <input type="checkbox" :checked="selectedSemesters.includes(semester)" class="checkbox checkbox-xs">
                                    Semester {{ semester }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Status Filter -->
                    <div class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="btn m-1 bg-gray-200 hover:bg-gray-200 text-black hover:text-black shadow-lg">
                            <adjustments-vertical-icon class="h-6 w-6"/>
                            Status
                        </div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-lg bg-gray-200 rounded-box w-52 hover:bg-gray-200 text-black shadow-lg">
                            <li v-for="moduleStatusCase in moduleStatusCases" :key="moduleStatusCase.value">
                                <a @click="toggleStatus(moduleStatusCase.value)">
                                    <input type="checkbox" :checked="selectedStatuses.includes(moduleStatusCase.value)" class="checkbox checkbox-xs">
                                    {{ moduleStatusCase.name }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Sort By Filter -->
                    <div class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="btn m-1 bg-gray-200 hover:bg-gray-200 text-black hover:text-black inline-flex items-center shadow-lg">
                            <adjustments-vertical-icon class="h-6 w-6"/>
                            Sortieren nach
                        </div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-lg bg-gray-200 rounded-box w-52 hover:bg-gray-200 text-black shadow-lg">
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

                </div>

                <!-- Main content -->
                <div class="flex-1">

                    <div class="px-4 py-4 flex flex-wrap">
                        <!-- Content -->
                        <div class="card w-96 bg-white text-black shadow-xl mb-4" v-for="(module, index) in filteredModules"
                             :key="module.id">
                            <div class="card-body">
                                <h2 class="card-title">{{ module.name }}</h2>
                                <p>Status: {{ module.statusName }}</p>
                                <p>Beschreibung: {{module.description}}</p>
                                <p>Start: Semester {{ module.startSemester }}</p>
                                <p>Ende: Semester {{ module.endSemester }}</p>
                                <div class="flex justify-between">
                                <div class="card-actions">
                                    <a class="btn btn-outline btn-info" :href="route('modules.show', {'module': module.id})">Anzeigen</a>
                                </div>
                                <div class="card-actions">
                                    <a class="btn btn-outline btn-success" :href="route('modules.edit', {'module': module.id})">Bearbeiten</a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg " v-if="modules.length <= 0">
                        <p class="text-center flex text-black" >
                            <information-circle-icon class="w-6 h-6 mr-2"></information-circle-icon>
                            Es sind keine Module verfügbar. Erstelle doch welche!
                        </p>
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
