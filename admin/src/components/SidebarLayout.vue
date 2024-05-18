
<template>
    <div class="w-[200px] bg-indigo-700 text-white py-4 px-2">
        <router-link :to="{name: 'app.dashboard'}" class="flex items-center py-1 px-2 rounded-md transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <HomeIcon class="w-6 h-6" />
            </span>
            <span class="text-sm  ">Home</span>
        </router-link>

        <router-link :to="{name: 'app.products'}" class="flex items-center py-1 px-2 rounded-md transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <ChartPieIcon class="w-6 h-6" />
            </span>
            <span class="text-sm  ">Products</span>
        </router-link>

        <router-link :to="{name: 'app.users'}" class="flex items-center py-1 px-2 rounded-md transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <UsersIcon class="w-6 h-6" />
            </span>
            <span class="text-sm  ">Users</span>
        </router-link>

        <router-link :to="{name: 'app.reports'}" class="flex items-center py-1 px-2 rounded-md transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <ChartBarIcon class="w-6 h-6" />
            </span>
            <span class="text-sm  ">Reports</span>
        </router-link>



    </div>


</template>
<script setup>
import {HomeIcon,  UsersIcon, ChartPieIcon, ChartBarIcon } from "@heroicons/vue/24/outline";


</script>


<style scoped>

</style>
