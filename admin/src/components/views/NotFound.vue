<template>
    <div class="min-h-screen flex items-center justify-center bg-gray-200">
        <div class="text-center">
            <h1 class="text-9xl font-extrabold text-gray-900 tracking-widest">404</h1>
            <div class="bg-red-500 px-2 text-sm text-white rounded rotate-12 absolute" :style="{ transform: 'translateY(-50%)' }">Page Not Found</div>
            <p class="text-lg mt-2 text-gray-600">Sorry, the page you're looking for doesn't exist. Please check the URL in address bar and try again.</p>
            <router-link :to="{name: 'app.dashboard'}" class="mt-6 inline-block px-5 py-3 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600">
                Go Home
            </router-link>

        </div>
    </div>
</template>

<script setup>


</script>

<style scoped>
.absolute {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
