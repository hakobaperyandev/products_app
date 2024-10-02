<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
const form = useForm({
    title: null,
    price: null,
    quantity: null
})

const toast = useToast()

function createProduct() {
    console.log('form', form);
    form.post('/admin/products', {
        onSuccess: () => {
            toast.success('Product created successfully!')
            form.reset()
        },
        onError: (error) => form.errors = error 
    })
    
}
</script>
<template>
    <AppLayout>
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Create Product</h1>
        
            <form @submit.prevent="createProduct" class="space-y-4">
                <div>
                <label class="block text-gray-700">Title</label>
                <input v-model="form.title" type="text" class="border rounded w-full py-2 px-3" />
                <p v-if="form.errors.title" class="text-red">{{ form.errors.title }}</p>
                </div>
                <div>
                <label class="block text-gray-700">Price</label>
                <input v-model="form.price" type="number" class="border rounded w-full py-2 px-3" />
                <p v-if="form.errors.price" class="text-red">{{ form.errors.price }}</p>
                </div>
                <div>
                <label class="block text-gray-700">Quantity</label>
                <input v-model="form.quantity" type="number" class="border rounded w-full py-2 px-3" />
                <p v-if="form.errors.quantity" class="text-red">{{ form.errors.quantity }}</p>
                </div>
        
                <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Create</button>
            </form>
    </div>
    </AppLayout>
    
  </template>
  
  