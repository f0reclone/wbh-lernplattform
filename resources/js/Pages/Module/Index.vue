<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    modules: {
        type: Array,
    },
});

//dirty
const statusTranslations = {
    'open': 'Unbearbeitet',
    'in_progress': 'In Arbeit',
    'waiting_for_result': 'Erledigt (warte auf Ergebnis)',
    'done_without_grade': 'Erledigt (unbewertet)',
    'done_with_grade': 'Erledigt (bewertet)'
};

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
                        <div class="flex items-center ">
                            <input type="checkbox" class="checkbox checkbox-primary" id="semester1" v-model="selectedSemesters" value="1"
                                   name="semester1">
                            <label for="semester1" class="ml-2">1</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="checkbox checkbox-primary" id="semester2" v-model="selectedSemesters" value="2"
                                   name="semester1">
                            <label for="semester1" class="ml-2">2</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="checkbox checkbox-primary" id="semester3" v-model="selectedSemesters" value="3"
                                   name="semester1">
                            <label for="semester1" class="ml-2">3</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="checkbox checkbox-primary" id="semester4" v-model="selectedSemesters" value="4"
                                   name="semester1">
                            <label for="semester1" class="ml-2">4</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="checkbox checkbox-primary" id="semester5" v-model="selectedSemesters" value="5"
                                   name="semester1">
                            <label for="semester1" class="ml-2">5</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="checkbox checkbox-primary" id="semester6" v-model="selectedSemesters" value="6"
                                   name="semester1">
                            <label for="semester1" class="ml-2">6</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="checkbox checkbox-primary" id="semester7" v-model="selectedSemesters" value="7"
                                   name="semester1">
                            <label for="semester1" class="ml-2">7</label>
                        </div>
                    </div>
                    <br>
                    <InputLabel><span class="text-lg ml-2 font-extrabold space-y-5">Sortieren nach</span>
                    </InputLabel>
                    <div class="left mx-2 lg:px-3 space-y-0.5">
                        <div>
                            <input type="radio" class="radio radio-primary" id="sortBySemester" v-model="sortOption" name="sortOption"
                                   value="semester">
                            <label for="sortBySemester" class="mx-2">Semester</label>
                        </div>
                        <div>
                            <input type="radio" class="radio radio-primary " id="sortByModule" v-model="sortOption" name="sortOption"
                                   value="module">
                            <label for="sortBySemester" class="mx-2">Module</label>
                        </div>
                        <div class="dropdown dropdown-hover">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                </svg>

                                <div tabindex="0" class="m-1 py-2 bg-base-100/0 mx-2">Status</div>
                            </div>
                            <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                                <li>
                                    <label class="flex items-center">
                                        <input type="checkbox" v-model="selectedStatuses" id="Open" value="Open">
                                        <span class="ml-2">Unbearbeitet</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center">
                                        <input type="checkbox" v-model="selectedStatuses" id="In_Progress" value="In_Progress">
                                        <span class="ml-2">In Arbeit</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center">
                                        <input type="checkbox" v-model="selectedStatuses" id="Waiting_For_Result" value="Waiting_For_Result">
                                        <span class="ml-2">Erledigt (warte auf Ergebnis)</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center">
                                        <input type="checkbox" v-model="selectedStatuses" id="Done_Without_Grade" value="Done_Without_Grade">
                                        <span class="ml-2">Erledigt (unbewertet)</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center">
                                        <input type="checkbox" v-model="selectedStatuses" id="Done_With_Grade" value="Done_With_Grade">
                                        <span class="ml-2">Erledigt (bewertet)</span>
                                    </label>
                                </li>
                            </ul>
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
                <!-- Main content -->
                <div class="flex-1">
                    <div class="px-4 py-4 space-x-4">
                        <TextInput v-model="searchQuery" placeholder="Search Module..." class="w-60"/>
                        <Link href="/modules/create" class="btn btn-accent btn-outline bg-green" method="get" as="button">Module hinzufügen</Link>
                    </div>
                    <div class="px-4 py-4 flex flex-wrap">
                        <!-- Content -->
                        <div class="card w-96 bg-base-100 shadow-xl mb-4" v-for="(module, index) in filteredModules" :key="module.id">
                            <div class="card-body">
                                <h2 class="card-title">{{ module.name }}</h2>
                                <p>Status: {{ statusTranslations[module.status] }}</p>
                                <p>Start: Semester {{ module.start_semester }}</p>
                                <p>Ende: Semester {{ module.end_semester }}</p>
                                <div class="card-actions justify-end">
                                    <a class="btn btn-primary" :href="route('modules.edit', {'module': module.id})">Bearbeiten</a>
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
            selectedStatuses:[],
            showCompleted: 'yes',
            searchQuery: ''
        };


    },
    computed: {
        filteredModules() {
            let modules = this.filterModules(this.modules);
            modules = this.searchModules(modules);
            modules = this.selectedStatusesFilter(modules);
            return this.sortModules(modules);
        }
    },
    methods: {
        filterModules(modules) {
            if (this.selectedSemesters.length > 0) {
                modules = modules.filter(module => this.selectedSemesters.includes(module.start_semester.toString()));
            }
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
                    return modules.sort((a, b) => a.start_semester - b.start_semester);
                case 'module':
                    return modules.sort((a, b) => a.name.localeCompare(b.name));
                default:
                    return modules;
            }
        }
    }
}
</script>
