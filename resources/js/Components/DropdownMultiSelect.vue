<script setup>
import { reactive, ref, defineProps, defineEmits, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '48',
    },
    contentClasses: {
        type: String,
        default: 'py-1 bg-white dark:bg-gray-700',
    },
    initialSelectedSemesters: {
        type: Array,
        default: () => [],
    },

});

const emit = defineEmits();

const checkboxes = reactive({});
const open = ref(false);

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const widthClass = ref({
    48: 'w-48',
}[props.width.toString()]);

const alignmentClasses = ref(() => {
    if (props.align === 'left') {
        return 'origin-top-left left-0';
    } else if (props.align === 'right') {
        return 'origin-top-right right-0';
    } else {
        return 'origin-top';
    }
});

watch(checkboxes, (newValues) => {
    const selectedSemesters = Object.keys(newValues).filter(semester => newValues[semester]);
    emit('selectSemesters', selectedSemesters);
});

const toggleDropdown = () => {
    open.value = !open.value;
};

const closeDropdown = (e) => {
    if (!e.target.closest('.rounded-md') && !e.target.closest('.checkbox-label')) {
        open.value = false;
    }
};

</script>

<template>
    <div class="relative">
        <div @click="toggleDropdown">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="closeDropdown"></div>

        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 rounded-md shadow-lg"
                :class="[widthClass, alignmentClasses()]"
                style="display: none"
            >
                <div class="rounded-md ring-1 ring-black ring-opacity-5" :class="contentClasses">
                    <label v-for="semester in [1, 2, 3, 4, 5, 6]" :key="semester" class="m-2 flex items-center space-x-2" @click.stop="">
                        <input type="checkbox" v-model="checkboxes[semester]" class="m-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"/> Semester {{ semester }}
                    </label>
                </div>
            </div>
        </Transition>
    </div>
</template>
