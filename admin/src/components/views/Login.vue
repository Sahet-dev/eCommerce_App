<template>
    <GuestLayout title="Sign in to your account" @submit="login">
        <div v-if="errorMsg" class="rounded-md flex items-center py-3 px-5 bg-red-500 text-white text-sm">
            {{errorMsg}}
            <span @click="errorMsg = ''" class="ml-auto  p-1 text-sm cursor-pointer">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>

            </span>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
                <input v-model="form.email" id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                <div class="text-sm">
                    <router-link :to="{name: 'requestPassword'}" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</router-link>
                </div>
            </div>
            <div class="mt-2">
                <input v-model="form.password" id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" v-model="form.remember" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>
        </div>

        <div class="mt-6">
            <button :disabled="loading" type="submit" class="transition-all flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold
            leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
            focus-visible:outline-indigo-600"
            :class="{ 'cursor-not-allowed': loading,
             'bg-indigo-300 hover:bg-indigo-300': loading
             }"
            >
                <svg v-if="loading" class="transition-all animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span v-if="!loading" class="transition-colors">
                Sign in

                </span>
            </button>
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "../GuestLayout.vue";
import {ref} from "vue";
import store from "../../store/index.js";
import  {useRouter} from "vue-router";


const router = useRouter();
const loading = ref(false);
const errorMsg = ref(false);

const form = {
    email: '',
    password: '',
    remember: false
}

function login() {
    loading.value = true;
    store.dispatch('login', form)
        .then(() => {
            loading.value = false;
            router.push({name: 'app.dashboard'})
        })
        .catch(
            ({response}) => {
                loading.value = false;
                errorMsg.value = response.data.message;
            }
        )
    console.log("submit", form);
}







</script>

<style scoped>
</style>
