<template>
    <div class="pt-12"  v-for="alert in alerts"
         :key="alert.id" v-auto-animate>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" v-auto-animate>
        <div role="alert" class="alert" :class="{'alert-error': alert.type === 'error', 'alert-success': alert.type === 'success', 'alert-warning': alert.type === 'warning', 'alert-info': alert.type === 'info'}" v-auto-animate>
            <span v-text="alert.message"></span>
        </div>
        </div>
    </div>
</template>

<script setup>
import {computed, watch} from "vue";
import {usePage} from "@inertiajs/vue3";
import useAlerts from "@/Composables/useAlerts.vue";

const alert = computed(() => usePage().props.flash.alert);
const {addAlert, alerts} = useAlerts();

watch(alert, (newVal) => {
    if (newVal) {
        addAlert(newVal);
    }
});
</script>
