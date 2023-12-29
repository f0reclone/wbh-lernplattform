

<!-- TaskItem.vue -->
<template>
    <div>
        <div v-if="task.status === status && task.parent_task_id === null" class="mt-2 bg-white-100 dark:bg-gray-700 rounded-lg">
            <div class="p-2 bg-gray-100	 dark:bg-gray-700 rounded-lg">
                <div class="lg:flex lg:items-center lg:justify-between">
                    <div class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">
                        {{ task.title }}
                    </div>
                </div>
                <div class="mt-2 font-semibold text-sm text-gray-500 dark:text-gray-400 leading-tight">
                    {{ task.description}}
                </div>
                <div>
                    <div v-if="task.child_tasks && task.child_tasks.length && task.status === status" class="mt-2 rounded-lg">
                        <div v-for="childTask in task.child_tasks" :key="childTask.id" class="mt-2 p-2 bg-gray-100	 dark:bg-gray-800 rounded-lg">
                            <div class="lg:flex lg:items-center lg:justify-between">
                                <div class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">
                                    {{ childTask.title }}
                                </div>
                                <div class="mr-5 font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">

                                </div>
                            </div>
                            <div class="mt-2 font-semibold text-sm text-gray-500 dark:text-gray-400 leading-tight">
                                {{ childTask.description }}
                            </div>
                        </div>
                    </div>
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
