<script setup>
import {ref} from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {QuestionMarkCircleIcon} from "@heroicons/vue/24/solid/index.js";


const helpPage = ref('registration');

const isSelected = (page) => {
    return helpPage.value === page
}

const helpPages = [
    {
        key: 'registration',
        title: 'Registrierung'
    },
    {
        key: 'logInAndOut',
        title: 'Anmeldung'
    },
    {
        key: 'dashboardBasics',
        title: 'Übersicht'
    },
    {
        key: 'viewAndEditProfile',
        title: 'Benutzerdaten anzeigen und bearbeiten'
    },
    {
        key: 'changePassword',
        title: 'Passwort ändern'
    },
    {
        key: 'createAndEditModules',
        title: 'Module anlegen und bearbeiten'
    },
    {
        key: 'createAndEditTasks',
        title: 'Aufgaben anlegen und bearbeiten'
    },
    {
        key: 'createAndEditExams',
        title: 'Prüfungen anlegen und bearbeiten'
    },
    {
        key: 'synchroniseCalendar',
        title: 'Termine synchronisieren'
    },
]
</script>

<template>
    <Head title="Hilfe" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center">
                <QuestionMarkCircleIcon class="mr-2 h-6 w-6 text-black fill-none strokeWidth-5 stroke-black strokeLinecap-round strokeLinejoin-round"/>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Hilfe</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="max-w-7xl mx-auto space-y-6">
                    <div class="p-2 sm:p-4 bg-opacity-0 flex gap-4 content-between justify-center">
                        <div class="p-2 sm:p-4 bg-white shadow-sm sm:rounded-lg w-1/4">
                            <ul class="menu w-56 rounded-box text-black">
                                <li class="menu-title">
                                    <div class="flex items-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
                                        </svg>
                                        <h2 class="text-black text-xl font-bold ml-2">Hilfe-Themen</h2>
                                    </div>
                                </li>
                                <li><a v-for="page in helpPages" @click.prevent="helpPage = page.key"
                                       :class="{'active': isSelected(page.key)}" v-text="page.title"></a>
                                </li>
                            </ul>
                        </div>
                        <div id="dynamicContent" class="w-3/4">
                            <iframe v-show="isSelected('registration')"
                                    src="https://app.tango.us/app/embed/747a309f-e36b-4152-baf0-cd81f2426556?skipCover=false&defaultListView=false&skipBranding=true"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="WBH Lernplattform - Registrierung" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                                    webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"
                                    class="bg-black rounded-[24px]"></iframe>
                            <iframe v-show="isSelected('logInAndOut')"
                                    src="https://app.tango.us/app/embed/0aebfdec-ec88-494c-9efd-066a85ca1c16"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="Logging in to the WBH Learning Platform" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                                    webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"
                                    class="bg-black rounded-[24px]"></iframe>
                            <iframe v-show="isSelected('dashboardBasics')"
                                    src="https://app.tango.us/app/embed/e0c92f99-15ec-4098-a1cf-7e72eb29f5bd"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="Grundfunktionen der WBH-Lernplattform" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                                    webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"
                                    class="bg-black rounded-[24px]"></iframe>
                            <iframe v-show="isSelected('viewAndEditProfile')"
                                    src="https://app.tango.us/app/embed/7ce6c281-a8f7-42f7-9e1f-a00bebbd4edf"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="WBH Lernplattform - Profil anzeigen und bearbeiten" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                                    webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>
                            <iframe v-show="isSelected('changePassword')"
                                    src="https://app.tango.us/app/embed/b086b499-8c91-4142-8f64-8e7364675768"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="WBH Lernplattform - Passwort ändern" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0" webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>
                            <iframe v-show="isSelected('createAndEditModules')"
                                    src="https://app.tango.us/app/embed/e5f4f953-beb1-44e9-af78-d3ceb206ccab"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="WBH Lernplattform - Module erstellen und anzeigen"
                                    width="100%" height="500px" referrerpolicy="strict-origin-when-cross-origin"
                                    frameborder="0" webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>
                            <iframe v-show="isSelected('createAndEditTasks')"
                                    src="https://app.tango.us/app/embed/4afee4f9-ecaa-4631-adbb-bade228f42bd"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="WBH Lernplattform - Aufgaben erstellen" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                                    webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>
                            <iframe v-show="isSelected('createAndEditExams')"
                                    src="https://app.tango.us/app/embed/96babe22-2d4c-40cb-af4a-666f286e25bc"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="WBH Lernplattform - Prüfungen erstellen und bearbeiten" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                                    webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>
                            <iframe v-show="isSelected('synchroniseCalendar')"
                                    src="https://app.tango.us/app/embed/ca446c45-6b67-44e5-a10d-48282da132ad"
                                    sandbox="allow-scripts allow-top-navigation-by-user-activation allow-popups allow-same-origin"
                                    security="restricted" title="WBH Lernplattform - Kalender synchronisieren" width="100%"
                                    height="500px" referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                                    webkitallowfullscreen="webkitallowfullscreen"
                                    mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
#dynamicContent > iframe, #dynamicContent {
    border-radius: 24px !important;
}
</style>
