
<template>

    <div  v-if="currentUser" class="min-h-full flex bg-gray-200">


        <SidebarLayout :class="{'-ml-[200px]' : !sidebarOpen}"/>








        <div class="flex-1">
            <TopHeader @toggle-sidebar="toggleSidebar"></TopHeader>


            <main class="p-6">
                <div class="bg-white p-4 rounded">
                    <router-view></router-view>

                </div>
            </main>
        </div>
    </div>
    <div v-else class="min-h-full bg-gray-200 flex items-center justify-center">
        <svg class="transition-all animate-spin -ml-1 mr-3 h-16 w-16 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>

    </div>
</template>
<script setup>
import {ref, onMounted, onUnmounted, computed} from "vue";
import SidebarLayout from "./SidebarLayout.vue";
import TopHeader from "./TopHeader.vue";
import store from "../store/index.js";

const {title} = defineProps({
    title: String
})
const sidebarOpen = ref(true);
const emit = defineEmits(['submit'])
const currentUser = computed(() => store.state.user.data);


function toggleSidebar() {
    sidebarOpen.value = !sidebarOpen.value
}

onMounted(()=>{
    store.dispatch('getUser')
    handleSidebarOpened()
    window.addEventListener('resize' , handleSidebarOpened)
})

function handleSidebarOpened() {
    sidebarOpen.value = window.outerWidth > 768
}

onUnmounted(()=>{
    window.removeEventListener('resize' , handleSidebarOpened)
})






















</script>
<style scoped>

</style>
