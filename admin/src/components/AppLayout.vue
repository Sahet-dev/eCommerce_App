
<template>

    <div class="min-h-full flex bg-gray-200">


        <SidebarLayout />








        <div class="flex-1">
            <TopHeader></TopHeader>
            <main class="p-6">
                <div class="bg-white p-4 rounded">
                    <router-view></router-view>

                </div>
            </main>
        </div>
    </div>
</template>
<script setup>
import SidebarLayout from "./SidebarLayout.vue";
import TopHeader from "./TopHeader.vue";

const {title} = defineProps({
    title: String
})

const emit = defineEmits(['submit'])
</script>


<style scoped>

</style>
