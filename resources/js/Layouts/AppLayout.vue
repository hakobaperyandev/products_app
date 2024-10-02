<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="min-h-screen flex flex-col">
      <!-- Header -->
      <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Products Application</h1>
        <Link 
          :href="route('logout')" 
          method="post"
          class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
          Logout
        </Link>
      </header>
  
      <!-- Main Content -->
      <main class="flex-grow p-6">
        <slot></slot>
      </main>
  
      <!-- Footer -->
      <footer class="bg-gray-800 text-white p-4 text-center">
        &copy; 2024 Products Application. 
      </footer>
    </div>
  </template>