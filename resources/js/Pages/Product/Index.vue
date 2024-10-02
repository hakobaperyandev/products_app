
<script setup>
  import AppLayout from '../../Layouts/AppLayout.vue';
  import Pagination from '../../Components/Pagination.vue';
  import { Link } from '@inertiajs/vue3';
  const props = defineProps({
    products: Array
  })  
</script>

<template>
    <AppLayout>
      <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold">Products</h1>
          <Link class="bg-blue-500 text-white px-4 py-2 rounded" href="/admin/products/create">Create New Product</Link>
        </div>
    
        <table class="table-auto w-full mb-4">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-4 py-2">Title</th>
              <th class="px-4 py-2">Price</th>
              <th class="px-4 py-2">Quantity</th>
              <th class="px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products.data" :key="product.id" class="text-center">
              <td class="border px-4 py-2">{{ product.title }}</td>
              <td class="border px-4 py-2">{{ product.price }}</td>
              <td class="border px-4 py-2">{{ product.quantity }}</td>
              <td class="border px-4 py-2">
                <Link class="bg-blue-500 text-white px-3 py-1 rounded" :href="`products/${product.id}/edit`">Edit</Link>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="flex justify-center space-x-2">
            <Pagination 
              :links="products.links" 
              :current_page="products.current_page" 
              :prev_page_url="products.prev_page_url" 
              :next_page_url="products.next_page_url" 
              :last_page="products.last_page" 
            />
        </div>
      </div>
    </AppLayout>
  </template>
  