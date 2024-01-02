<script setup>
function formatSemesters(semesters) {
return semesters.length > 0 ? semesters.map(s => `${s}`).join(', ') : 'N/A';
}
</script>
<!-- TaskItem.vue -->
<template>
    <div>
        <div>
            <div
                v-if="task.status === status"
                class="mt-2 bg-white-100 dark:bg-gray-700 rounded-lg"
                draggable="true"
                @dragstart="handleDragStart"
                @dragenter="handleDragEnter"
                @dragleave="handleDragLeave"
                @dragover.prevent
                @drop="handleDrop">
                <a  :href="route('tasks.edit', {task: task.id})">
                    <div class="p-2 bg-gray-100	 dark:bg-gray-700 rounded-lg">
                        <div class="lg:flex lg:items-center lg:justify-between">
                            <div class="font-semibold text-md text-gray-800 dark:text-gray-200 leading-tight">
                                {{ task.title }}
                            </div>
                            <div>
                                {{ task.moduleName }} (Semester {{ task.semesters ? formatSemesters(task.semesters) : 'N/A' }})
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2 font-semibold text-sm text-gray-500 dark:text-gray-400 leading-tight">
                            {{ task.description}}
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        task: Object,
        status: String,
        semesters: Array,
        module: Object,
        modules: Array,
    },
    methods: {
        handleDragStart(event) {
            event.dataTransfer.setData('text/plain', JSON.stringify(this.task));
            this.$emit('dragstart', event, this.task);
        },
        handleDragEnter(event) {
            this.$emit('dragenter', event, this.task);
        },
        handleDragLeave(event) {
            this.$emit('dragleave', event);
        },
        handleDrop(event) {
            this.$emit('drop', event, this.status);
        },
    },
};

</script>
