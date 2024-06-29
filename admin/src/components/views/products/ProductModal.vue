<template>

    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white  text-left align-middle shadow-xl transition-all"
                        >
                            <Spinner v-if="loading" class="absolute left-0 top-0 bg-white right-0 bottom-0 flex items-center justify-center"/>
                            <header class="py-3 px-4 flex justify-between items-center">
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-medium leading-6 text-gray-900"
                                >
                                    {{product.id? `Update product: "${product.id}"` : `Add product`}}
                                </DialogTitle>
                                <button
                                    @click="closeModal" class="w-8 h-8 flex items-center justify-center rounded-full transition-colors text-gray-500 hover:text-gray-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                                </button>
                            </header>
                            <form @submit.prevent="onSubmit">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <CustomInput class="mb-3" v-model="product.title" label="Title"/>
                                    <CustomInput type="file" class="mb-3"  label="Title" @change="file => product.image = file"/>
                                    <CustomInput type="textarea" class="mb-3" v-model="product.description" label="Description"/>
                                    <CustomInput type="number" class="mb-3" v-model="product.price" label="Price" prepend="$"/>
                                </div>

                            </form>

                            <footer class="bg-gray-50 rounded-b-lg px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                    Save
                                </button>
                                <button type="button"
                                        @click="onSubmit($event, true)"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                    Save & Close
                                </button>
                                <!--                                <router-link :to="{name: 'app.products'}"-->
                                <!--                                             class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"-->
                                <!--                                             ref="cancelButtonRef">-->
                                <!--                                    Cancel-->
                                <!--                                </router-link>-->
                            </footer>



                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import {computed, onUpdated, ref} from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import Spinner from "../../core/Spinner.vue";
import store from "../../../store/index.js";
import CustomInput from "../../core/CustomInput.vue";
const props = defineProps({
    modelValue: Boolean,
    product: {
        required: true,
        type: Object
    }
})


const product = ref({
    id: props.product.id,
    title: props.product.title,
    image: props.product.image,
    description: props.product.description,
    price: props.product.price
})

const loading = ref(false)

function closeModal() {
    show.value = false
    emit('close')
}



const emit = defineEmits(['update:modelValue', 'close'])

const show = computed({
    get:  () => props.modelValue,
    set: (value) => {
        emit('update:modelValue', value)
    }
})

onUpdated(()=>{
    product.value = {
        id: props.product.id,
        title: props.product.title,
        image: props.product.image,
        description: props.product.description,
        price: props.product.price
    }
})

function onSubmit() {
    loading.value = true
    if (product.value.id) {
        store.dispatch('updateProduct', product.value)
            .then(response => {
                loading.value = false
                if (response.status === 200) {
                    store.dispatch('getProducts')
                    closeModal()
                }
            })
    }else {
        store.dispatch('createProduct', product.value)
            .then(response => {
                loading.value = false
                if (response.status === 201) {
                    store.dispatch('getProducts')
                    closeModal()
                }
            })
    }
}

</script>


<style scoped>

</style>
