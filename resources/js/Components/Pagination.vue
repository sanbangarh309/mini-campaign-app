<!-- resources/js/Components/Pagination.vue -->
<template>
    <div class="flex justify-center">
      <nav>
        <ul class="flex">
          <li v-for="link in links" :key="link.url">
            <Link :href="link.url" :class="['mx-1', link.active ? 'font-bold' : '']">
              {{ link.label }}
            </Link>
          </li>
        </ul>
      </nav>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Link } from '@inertiajs/vue3'
  
  const props = defineProps({
    links: Array
  });
  </script>
  