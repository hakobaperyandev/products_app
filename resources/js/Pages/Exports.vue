
<script setup>

  
import { Link } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';
  const props = defineProps({
    files: Array
  })
  
  function formatDate(timestamp) {
    const date = new Date(timestamp * 1000); 
    return date.toLocaleDateString() + ' ' + date.toLocaleTimeString(); 
  }

</script>

<template>
    <AppLayout>
      <div class="container mx-auto p-4">
     
  
      <table class="table-auto w-full mb-4">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Date</th>
            <th class="px-4 py-2">Size</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="file in files" :key="file.id" class="text-center">
            <td class="border px-4 py-2"><a :href="file.url" download>{{ file.name }}</a> -</td>
             <td class="border px-4 py-2"><span>{{ formatDate(file.created_at) }}</span> </td>
            <td class="border px-4 py-2"><span>{{ file.size }} bytes</span></td>
          </tr>
        </tbody>
      </table>
      <div class="flex justify-center space-x-2">
    </div>
    </div>
    </AppLayout>
  </template>
  