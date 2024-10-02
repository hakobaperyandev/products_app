<script setup>
import AppLayout from '../../Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    product: Object
})

const toast = useToast()

const form = useForm({
    id: props.product.id,
    title: props.product.title,
    price: props.product.price,
    quantity: props.product.quantity
})


function updateProduct() {
    form.put(`/admin/products/${form.id}`, {
        onSuccess: () => {
            toast.success('Product updated successfully!')
        },
        onError: (error) => form.errors = error, 
        preserveState: true,
        preserveScroll: true
    })
}

</script>
<template>
    <AppLayout>
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">Edit Product</h1>
            <Link href="/admin/products" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">Back to Products</Link>

            <form @submit.prevent="updateProduct" class="space-y-4">
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
        
                <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Update</button>
            </form>
        </div>
    </AppLayout>
  </template>
  