<script setup>
import { ref, computed } from 'vue'
import store from "../store/index.js";

const test = computed(()=> store.state.test)

defineProps({
  msg: String,
})

const count = ref(0)
</script>

<template>
    <div class="bg-amber-700">
        {{test}}
    </div>
</template>

<style scoped>
.read-the-docs {
  color: #888;
}
</style>
