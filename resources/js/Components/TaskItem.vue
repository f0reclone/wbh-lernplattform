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
                class="mt-2 bg-white-100 rounded-lg"
                draggable="true"
                @dragstart="handleDragStart"
                @dragenter="handleDragEnter"
                @dragleave="handleDragLeave"
                @dragover.prevent
                @drop="handleDrop">
                <a  :href="route('tasks.edit', {task: task.id})">
                    <div class="p-2 bg-gray-50	rounded-lg shadow-md">
                        <div class="justify-between">
                            <div class="font-semibold text-md text-gray-800 leading-tight">
                                {{ task.title }}
                            </div>
                            <div>
                                {{ task.moduleName }}
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2 font-semibold text-sm text-gray-500 leading-tight">
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
