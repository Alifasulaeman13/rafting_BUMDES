<template>
  <section>
    <h1 class="text-2xl font-semibold mb-2">Operator Dashboard</h1>
    <div v-if="loading" class="text-gray-500">Memuat...</div>
    <pre v-else class="bg-gray-100 p-3 rounded">{{ data }}</pre>
    <div v-if="error" class="text-red-600 mt-2">{{ error }}</div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../api';

const data = ref(null);
const loading = ref(false);
const error = ref('');

onMounted(async () => {
  loading.value = true;
  try {
    const res = await api.get('/operator/dashboard');
    data.value = res.data;
  } catch (e) {
    error.value = 'Gagal memuat dashboard operator (butuh auth ojek_perahu).';
  } finally {
    loading.value = false;
  }
});
</script>