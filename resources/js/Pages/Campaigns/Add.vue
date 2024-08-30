<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({
  name: '',
  csv_file: '',
});

const errors = ref([]);

</script>

<template>
  <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Campaign</h2>
        </template>
        <form class="max-w-md mx-auto p-5" @submit.prevent="form.post(route('create.campaigns'))">
      <h1 class="mb-5">Create New Campaign</h1>
      <div class="relative z-0 w-full mb-5 group">
        <InputLabel for="name" value="Campaign Name" />
        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
          autocomplete="name" />
      </div>
      <div class="relative z-0 w-full mb-5 group">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <input @input="form.csv_file = $event.target.files[0]" required accept=".csv"
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          type="file">
      </div>
      <PrimaryButton type="submit" :disabled="form.processing">Submit</PrimaryButton>
      <div class="relative z-0 w-full mb-5 group">
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
      </progress>
      </div>
      <div v-if="errors.length">
        <ul>
          <li v-for="error in errors" :key="error">{{ error }}</li>
        </ul>
      </div>
    </form>
  </AuthenticatedLayout>
</template>