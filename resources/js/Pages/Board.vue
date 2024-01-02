<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import TaskItem from "@/Components/TaskItem.vue";
import DropdownMultiSelect from "@/Components/DropdownMultiSelect.vue";
import {computed, ref} from "vue";


const {tasks,} = defineProps({
    task: Object,
    tasks: Array,
    module: Object,
    modules: Array,
    semesters: Array,
});

// Search Query and Filter //////////////////////////
const searchQuery = ref('');
const statusFilters = ['open', 'in_progress', 'done_without_grade', 'done_with_grade', 'waiting_for_result'];

const allTasks = ref(null);
allTasks.value = tasks;

const filteredTasks = computed(() => {
    const query = searchQuery.value.toLowerCase();
    const selectedSemestersInt = selectedSemesters.value.map(Number);

    if (selectedSemestersInt.length === 0) {
        // No semester selected, return all tasks
        return allTasks.value.filter((task) => task.title.toLowerCase().includes(query));
    }

    return allTasks.value.filter((task) => {
        const taskSemestersInt = task.semesters.map(Number);
        return (
            task.title.toLowerCase().includes(query) &&
            selectedSemestersInt.some((semester) => taskSemestersInt.includes(semester))
        );
    });
});


const handleSelectSemesters = (selected) => {
    selectedSemesters.value = selected;
};

const selectedSemesters = ref([]);

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
    dragOver.value = null;


    console.log(`Task ${draggedTask.value.id} dropped to status: ${status}`);


    // Clear the draggedTask after drop
    draggedTask.value = null;

    // Remove the highlight when dropping
    event.target.classList.remove('drag-enter');
};

</script>

<style scoped>
.dragged-item {
    background-color: deeppink;
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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Full Width row -->
            <div class="mt-4 lg:flex lg:items-center lg:justify-between">
                <DropdownMultiSelect id="semester" align="left" :initialSelectedSemesters="selectedSemesters"
                                     @selectSemesters="handleSelectSemesters">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                            >
                                Semesterauswahl:
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <!-- Dropdown content goes here if needed -->
                    </template>
                </DropdownMultiSelect>
                <!-- Search bar -->
                <div class="ml-auto flex items-center space-x-4">
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search tasks..."
                        class="mr-4 border border-gray-300 dark:border-gray-800 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    />
                </div>
            </div>
            <!-- Full width and height columns -->
            <div class="flex justify-between h-16">
                <div class="flex w-full h-full">
                    <div class="mt-4 w-1/3 h-full"
                    >
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4 min-h-[500px]"
                            @drop="event => handleDrop(event, 'open', task)" @dragover.prevent="handleDragOver('open')"
                            :class="columnClasses('open')">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg">
                                Open</p>
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
                    <div class="mt-4 w-1/3 h-full"
                         @drop="event => handleDrop(event, 'in_progress', task)">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4 min-h-[500px]" @dragover.prevent="handleDragOver('in_progress')" :class="columnClasses('in_progress')">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg"
                               >In
                                Progress</p>
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
                    <div class="mt-4 w-1/3 h-full"
                         @drop="event => handleDrop(event, 'done', task)">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4 min-h-[500px]" @dragover.prevent="handleDragOver('done')" :class="columnClasses('done')">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg"
                               >
                                Closed</p>
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
    </AuthenticatedLayout>
</template>
