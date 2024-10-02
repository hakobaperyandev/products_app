<script setup>
import { defineProps, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  links: Array,
  current_page: Number,
  prev_page_url: String,
  next_page_url: String,
  last_page: Number,
});

const filteredLinks = computed(() => {
  return props.links.filter((link, index) => {
    
    return (
      index === 0 || 
      index === props.links.length - 1 || 
      (link.url && Math.abs(props.current_page - index) <= 2) 
    );
  });
});

const hasEllipsis = computed(() => {
  return (
    filteredLinks.value.length > 0 &&
    props.current_page > 3 &&
    props.current_page < props.last_page - 1
  );
});

</script>
<template>
  <div class="mt-6 flex justify-center space-x-2">
    <template v-if="filteredLinks.length">
      <Link 
        v-for="link in filteredLinks" 
        :key="link.label" 
        :href="link.url" 
        class="px-3 py-1 rounded" 
        :class="{
          'bg-blue-500 text-white': link.active, 
          'bg-gray-200 text-gray-600 cursor-not-allowed': !link.url,
        }"
      >
        <span v-html="link.label"></span>
      </Link>
      <span v-if="hasEllipsis" class="px-3 py-1">...</span>
    </template>
  </div>
</template>
