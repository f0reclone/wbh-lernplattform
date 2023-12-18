<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DropdownMultiSelect from "@/Components/DropdownMultiSelect.vue";
import TaskItem from "@/Components/TaskItem.vue";
import {computed, ref} from "vue";


const tasks = [
    {
        id: 1,
        parent_task_id: 1,
        title: "SRN04",
        description: "Intrusion Detection und Intrusion Prevention",
        status: "closed",
        progress: 100,
        related_type: "",
        related_id: 156,
        created_at: "Sep 14",
        updated_at: "Sep 16"
    },
    {
        id: 2,
        parent_task_id: 1,
        title: "SRN03",
        description: "Firewall-Systeme",
        status: "inProgress",
        progress: 30,
        related_type: "",
        related_id: 156,
        created_at: "Sep 14",
        updated_at: "Sep 16"
    },
    {
        id: 3,
        parent_task_id: 1,
        title: "SRN05",
        description: "Sichere Netzwerkommunikation",
        status: "inProgress",
        progress: 15,
        related_type: "",
        related_id: 156,
        created_at: "Sep 14",
        updated_at: "Sep 16"
    },
    {
        id: 4,
        parent_task_id: 1,
        title: "ISM01",
        description: "IT-Sicherheitsmanagement 1",
        status: "open",
        progress: 0,
        related_type: "",
        related_id: 156,
        created_at: "Sep 14",
        updated_at: "Sep 16"
    },
    {
        id: 5,
        parent_task_id: 1,
        title: "ISM02",
        description: "IT-Sicherheitsmanagement 2",
        status: "open",
        progress: 0,
        related_type: "",
        related_id: 156,
        created_at: "Sep 14",
        updated_at: "Sep 16"
    },];

const searchQuery = ref('');

const filteredTasks = computed(() => {
    const query = searchQuery.value.toLowerCase();
    return tasks.filter((task) => task.title.toLowerCase().includes(query));
});

</script>

<template>
    <Head title="ToDo's" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Full Width row -->
            <div class="mt-4 lg:flex lg:items-center lg:justify-between">
                <DropdownMultiSelect id="semester" align="left">
                    <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-md leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                >
                                    Semesterauswahl:
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </span>
                    </template>

                    <template #content>

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
            <!-- Full width and hight columns -->
            <div class="flex justify-between h-16">
                <div class="flex w-full h-full">
                    <div class="mt-4 w-1/3 h-full">
                        <div class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg">Open</p>
                            <TaskItem v-for="task in filteredTasks" :key="task.id" :task="task" status="open"/>
                        </div>
                    </div>
                    <div class="mt-4 w-1/3 h-full">
                        <div class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg">In Progress</p>
                            <TaskItem v-for="task in filteredTasks" :key="task.id" :task="task" status="inProgress"/>
                        </div>
                    </div>
                    <div class="mt-4 w-1/3 h-full">
                        <div class="bg-white dark:bg-gray-800 rounded-lg px-3 py-3 column-width rounded mr-4">
                            <p class="text-gray-800 dark:text-gray-200 font-semibold font-sans tracking-wide text-lg">Closed</p>
                            <TaskItem v-for="task in filteredTasks" :key="task.id" :task="task" status="closed"/>
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
            selectedSemester: 1, // Default selected semester
            semesters: [1, 2, 3], // Replace with actual semester data
            tasksInSelectedSemester: [],
            openTasks: [],
            closedTasks: [],
            openTasksInPriorSemesters: [],
        };
    },
    methods: {
        async loadTasks() {
            // Fetch tasks based on selected semester and update data
            // You'll implement this logic in the next step
        },
    },
};
</script>
