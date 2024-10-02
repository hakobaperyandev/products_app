<script setup>
import { ref } from 'vue';
import AppLayout from '../Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import Pagination from '../Components/Pagination.vue';

const props = defineProps({
  products: Array,
});

Echo.channel('product-updated')
    .listen('ProductUpdatedEvent', (updatedProduct) => {
      
        const index = props.products.data.findIndex(p => p.id === updatedProduct.id);
        if (index !== -1) {
          props.products.data[index] = updatedProduct;
        }
    });

const form = useForm({
  min_price: null,
  max_price: null,
});

function filterProducts() {
  form.get('/products', {
    preserveState: true,
    preserveScroll: true,
  });
}

function downloadCSV() {
  router.post('/products/export', form, {
    preserveState: true,
    onSuccess: () => {
      alert('The CSV download is in progress, you will receive it shortly.');
    }
  });
}

</script>

<template>
  <AppLayout>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-6">Products</h1>

      <!-- Filter Section -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Filter Products by Price</h2>
        <form @submit.prevent="filterProducts" class="grid grid-cols-2 gap-4 items-center">
          <div>
            <label class="block text-gray-700">Min Price</label>
            <input v-model="form.min_price" type="number" class="border rounded w-full py-2 px-3" placeholder="0" />
          </div>
          <div>
            <label class="block text-gray-700">Max Price</label>
            <input v-model="form.max_price" type="number" class="border rounded w-full py-2 px-3" placeholder="10000" />
          </div>
          <div class="col-span-2">
            <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Filter</button>
            
          </div>
        </form>
        <button @click="downloadCSV"  class="bg-green-500  text-white px-4 py-2 rounded">
          Export data with CSV
        </button>
        <Link href="/products/exports" class="bg-purple-500 text-white px-4 py-3 ml-1 rounded">
            View Exported CSV Data
          </Link>
      </div>

      <!-- Products List -->
      <div class="grid grid-cols-3 gap-6">
        <div v-for="product in products.data" :key="product.id" class="border rounded-lg p-4 shadow">
          <h3 class="text-lg font-bold">{{ product.title }}</h3>
          <p class="text-gray-600">Price: ${{ product.price }}</p>
          <p class="text-gray-600">Quantity: {{ product.quantity }}</p>
          <Link :href="`/products/${product.id}`" class="text-blue-500">View Product</Link>
        </div>
      </div>

      <!-- Pagination Links -->
      <div class="mt-6 flex justify-center space-x-2">
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
