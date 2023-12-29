

<!-- TaskItem.vue -->
<template>
    <div>
        <div v-if="task.status === status && task.parent_task_id === null" class="mt-2 bg-white-100 dark:bg-gray-700 rounded-lg">
            <div class="p-2 bg-gray-100	 dark:bg-gray-700 rounded-lg">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">
                        {{ task.title }}
                    </div>
                    <div class="mr-5 font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">

                    </div>
                </div>
                <div class="mt-2 font-semibold text-sm text-gray-500 dark:text-gray-400 leading-tight">
                    {{ task.description}}
                </div>
                <div>
                    ParentID: {{ task.parent_task_id}} <br>
                    ChildTasks:
                    <div v-if="task.child_task_ids && task.child_task_ids.length">
                        <div v-for="childTaskId in task.child_task_ids" :key="childTaskId">
                            <!-- Render child task information here using childTaskId -->
                            ID: {{ childTaskId  }}
                            Title: {{ }}
                        </div>
                    </div>
                    <div v-else>
                        No child tasks.
                    </div>

                </div>
            </div>
        </div>

        <div v-else-if="task.status === status && task.parent_task_id !== null" class="mt-2 bg-white-100 dark:bg-gray-700 rounded-lg">
            <div class="p-2 bg-gray-100	 dark:bg-gray-700 rounded-lg">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">
                        {{ task.title }}
                    </div>
                    <div class="mr-5 font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">

                    </div>
                </div>
                <div class="mt-2 font-semibold text-sm text-gray-500 dark:text-gray-400 leading-tight">
                    {{ task.description}}
                </div>
                <div>
                    ParentID: {{ task.parent_task_id}} <br>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        task: Object, // Pass the task as a prop
        status: String, // Pass the desired status as a prop
    },
};
</script>
