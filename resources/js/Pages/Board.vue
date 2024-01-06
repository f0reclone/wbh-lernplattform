<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import TaskItem from "@/Components/TaskItem.vue";
import DropdownMultiSelect from "@/Components/DropdownMultiSelect.vue";
import {computed, ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {AdjustmentsVerticalIcon, DocumentCheckIcon} from "@heroicons/vue/24/solid/index.js";
import TextInput from "@/Components/TextInput.vue";


const props = defineProps({
    task: Object,
    tasks: Array,
    module: Object,
    modules: Array,
    semesters: Array,
});

const allTasks = ref(null);
allTasks.value = props;

// Drag and Drop ////////////////////////////////////
const draggedTask = ref(null);
const dragOver = ref(null);

const handleDragEnd = (status) => {
    dragOver.value = null;
};const handleDragOver = (status) => {
    dragOver.value = status;
};
const handleDragStart = (event, task) => {
    draggedTask.value = task;
};

const handleDragEnter = (event, task) => {
    event.preventDefault();
    // Highlight the drop target, you can customize the background color
    // based on your design preferences
    event.target.classList.add('drag-enter');
};
const columnClasses = (status) => {
    if (status === dragOver.value) {
        return ['border-dashed', 'border-2', 'border-indigo-600'];
    }

    return ['border-2', 'border-transparent'];
};

const handleDragLeave = (event) => {
    // Remove the highlight when leaving the drop target
    dragOver.value = null;
};

const handleDrop = (event, status) => {
    event.preventDefault();
    axios.put(route('tasks.update', {'task': draggedTask.value.id}), {
        status: status,
        skipRedirect: true
    }, {
        headers: {
            'Content-Type': 'application/json',
        }
    })

    // Change the status manually so it stays
    draggedTask.value.status = status;
    draggedTask.value.updatedAt = new Date();
    dragOver.value = null;


    console.log(`Task ${draggedTask.value.id} dropped to status: ${status}`);


    // Clear the draggedTask after drop
    draggedTask.value = null;

    // Remove the highlight when dropping
    event.target.classList.remove('drag-enter');
};

/*const lastTenClosedTasks = computed(() => {
    const closedTasks = filteredTasks.value
        .filter(task => task.status === 'done')
        .sort((a, b) => new Date(b.updatedAt) - new Date(a.updatedAt));

    return closedTasks.slice(0, 10);
});*/

</script>

<style scoped>
.dragged-item {

}

/* Add styles for the drag enter effect */
.drag-enter {
    background-color: #aed581; /* Customize the background color as needed */
}
</style>

<template>
    <Head title="ToDo's"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <DocumentCheckIcon class="mr-2 h-6 w-6 text-black"/>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Hier findest du deine Aufgaben.</h2>
            </div>
        </template>
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 space-y-2 lg:px-8">
                <!-- Full Width row -->
                <div class="lg:flex lg:items-center lg:justify-between">
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
                    <!-- Button -->
                    <div>
                        <button class="mb-3 ml-3 bg-white btn btn-outline btn-success shadow-md" @click="$inertia.visit(route('tasks.create'))">
                            Aufgabe erstellen
                        </button>
                    </div>
                    <!-- Search bar -->
                    <div class="ml-auto flex items-center space-x-4">
                        <div class="ml-auto flex items-center space-x-4 mb-3">
                            <div class="px-4 space-x-4 space-y-3 ">
                                <TextInput v-model="searchQuery" placeholder="Suchen..." class="w-60"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Full width and height columns -->
                <div class="w-full flex ">
                    <div class="w-full flex ">
                        <div class="w-1/3 flex"
                             @drop="event => handleDrop(event, 'open', task)">
                            <div
                                class="bg-white rounded-lg px-3 py-3 w-full rounded mr-4 min-h-[500px] shadow-md"
                                @dragover.prevent="handleDragOver('open')"
                                :class="columnClasses('open')">
                                <p class="text-gray-800 font-semibold font-sans tracking-wide text-lg">
                                    Offen
                                </p>
                                <TaskItem
                                    v-for="task in filteredTasks"
                                    :key="task.id"
                                    :task="task"
                                    status="open"
                                    :draggable="true"
                                    @dragend="handleDragEnd()"
                                    @dragstart="event => handleDragStart(event, task)"
                                    @dragenter="event => handleDragEnter(event, task)"
                                    @dragleave="event => handleDragLeave(event)"
                                    :class="{ 'dragged-item': task === draggedTask }"
                                />
                            </div>
                        </div>
                        <div class="w-1/3 flex"
                             @drop="event => handleDrop(event, 'in_progress', task)">
                            <div
                                class="bg-white rounded-lg px-3 py-3 w-full rounded mr-4 min-h-[500px] shadow-md"
                                @dragover.prevent="handleDragOver('in_progress')" :class="columnClasses('in_progress')">
                                <p class="text-gray-800 font-semibold font-sans tracking-wide text-lg">
                                    In Bearbeitung
                                </p>
                                <TaskItem
                                    v-for="task in filteredTasks"
                                    :key="task.id"
                                    :task="task"
                                    status="in_progress"
                                    :draggable="true"
                                    @dragend="handleDragEnd()"
                                    @dragstart="event => handleDragStart(event, task)"
                                    @dragenter="event => handleDragEnter(event, task)"
                                    @dragleave="event => handleDragLeave(event)"
                                    :class="{ 'dragged-item': task === draggedTask }"
                                />
                            </div>
                        </div>
                        <div class="w-1/3 flex"
                             @drop="event => handleDrop(event, 'done', task)">
                            <div
                                class="bg-white rounded-lg px-3 py-3 w-full rounded mr-4 min-h-[500px] shadow-md"
                                @dragover.prevent="handleDragOver('done')" :class="columnClasses('done')">
                                <p class="text-gray-800 font-semibold font-sans tracking-wide text-lg">
                                    Erledigt
                                </p>
                                <TaskItem
                                    v-for="task in filteredTasks"
                                    :key="task.id"
                                    :task="task"
                                    status="done"
                                    :draggable="true"
                                    @dragend="handleDragEnd()"
                                    @dragstart="event => handleDragStart(event, task)"
                                    @dragenter="event => handleDragEnter(event, task)"
                                    @dragleave="event => handleDragLeave(event)"
                                    :class="{ 'dragged-item': task === draggedTask }"
                                />
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
        filteredTasks() {
            let tasks = this.filterTasks(this.tasks);
            tasks = this.searchTasks(tasks);
            console.log('Filtered tasks:', tasks);
            return tasks;
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
        filterTasks(tasks) {
            if (this.selectedSemesters.length > 0) {
                tasks = tasks.filter(task => task.semesters.some((semester) => this.selectedSemesters.includes(semester)));
            }
            console.log('Filtered tasks:', tasks);
            return tasks;
        },
        searchTasks(tasks) {
            if (this.searchQuery.trim() !== '') {
                return tasks.filter(task => task.name.toLowerCase().includes(this.searchQuery.toLowerCase()));
            }
            return tasks;
        },
    }
}
</script>
