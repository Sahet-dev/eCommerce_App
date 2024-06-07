
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
</template>
<script setup>
import {ref, onMounted, onUnmounted, computed} from "vue";
import SidebarLayout from "./SidebarLayout.vue";
import TopHeader from "./TopHeader.vue";
import store from "../store/index.js";
import Spinner from "./core/Spinner.vue";

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
