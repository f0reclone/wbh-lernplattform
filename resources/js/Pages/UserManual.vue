<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const dynamicContent = ref('');

function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
}
function changeContent(content) {
    let helpPages = {
        "registration": `<iframe src="https://app.tango.us/app/embed/747a309f-e36b-4152-baf0-cd81f2426556?skipCover=false&defaultListView=false&skipBranding=true" sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin" security="restricted" title="WBH Lernplattform - Registrierung" width="100%" height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>`,
        "logInAndOut": '<iframe src="https://app.tango.us/app/embed/0aebfdec-ec88-494c-9efd-066a85ca1c16" sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin" security="restricted" title="Logging in to the WBH Learning Platform" width="100%" height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>',
        "dashboardBasics": '<iframe src="https://app.tango.us/app/embed/e0c92f99-15ec-4098-a1cf-7e72eb29f5bd" sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin" security="restricted" title="Grundfunktionen der WBH-Lernplattform" width="100%" height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>',
        "viewAndEditProfile": "Profil",
        "changePassword": "Password",
        "createAndEditModules": '<iframe src="https://app.tango.us/app/embed/e5f4f953-beb1-44e9-af78-d3ceb206ccab" sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin" security="restricted" title="WBH Lernplattform - Module erstellen und anzeigen" width="100%" height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>',
        "createAndEditExams": "Prüfungen",
        "synchroniseCalendar": ""
    }

    switch (content) {
        case "registration":
            dynamicContent.value = helpPages["registration"];
            break;
        case "logInAndOut":
            dynamicContent.value = helpPages["logInAndOut"];
            break;
        case "viewAndEditProfile":
            dynamicContent.value = helpPages["viewAndEditProfile"];
            break;
        case "createAndEditModules":
            dynamicContent.value = helpPages["createAndEditModules"];
            break;
        case "synchroniseCalendar":
            dynamicContent.value = helpPages["synchroniseCalendar"];
            break;
        default:
            break;
    }
}
</script>

<template>
    <Head title="Hilfe" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Hilfe</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="max-w-7xl mx-auto space-y-6">
                    <div class="p-2 sm:p-4 bg-opacity-0 flex gap-4 content-between justify-center">
                        <div class="p-2 sm:p-4 bg-white shadow-sm sm:rounded-lg w-1/4">
                            <ul class="menu w-56 rounded-box text-black">
                                <li class="menu-title">
                                    <div class="flex items-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                        </svg>
                                        <h2 class="text-black text-xl font-bold ml-2">Hilfe-Themen</h2>
                                    </div>
                                </li>
                                <li><a @click.prevent="changeContent('registration')">Registrierung</a></li>
                                <li><a @click.prevent="changeContent('logInAndOut')">Anmeldung</a></li>
                                <li><a @click.prevent="changeContent('dashboardBasics')">Übersicht</a></li>
                                <li><a @click.prevent="changeContent('viewAndEditProfile')">Benutzerdaten anzeigen und bearbeiten</a></li>
                                <li><a @click.prevent="changeContent('changePassword')">Passwort ändern</a></li>
                                <li><a @click.prevent="changeContent('createAndEditModules')">Module anlegen und bearbeiten</a></li>
                                <li><a @click.prevent="changeContent('createAndEditTasks')">Aufgaben anlegen und bearbeiten</a></li>
                                <li><a @click.prevent="changeContent('createAndEditExams')">Prüfungen anlegen und bearbeiten</a></li>
                                <li><a @click.prevent="changeContent('synchroniseCalendar')">Termine synchronisieren</a></li>
                            </ul>
                        </div>
                        <div id="dynamicContent" class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg w-3/4">
                            <div v-html="dynamicContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
