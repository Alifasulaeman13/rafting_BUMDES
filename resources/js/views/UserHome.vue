<template>
  <section>
    <h1 class="text-2xl font-semibold mb-2">User Home</h1>
    <p class="text-sm text-gray-600 mb-4">Menampilkan paket aktif dan konten beranda.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
      <div class="p-4 border rounded">
        <h2 class="font-medium mb-2">Paket Aktif</h2>
        <div v-if="loadingPackages" class="text-gray-500">Memuat...</div>
        <ul v-else>
          <li v-for="p in packages" :key="p.id" class="py-1">
            {{ p.name }} — {{ p.min_persons }}-{{ p.max_persons ?? '∞' }} orang — Rp {{ p.price }}
          </li>
        </ul>
        <div v-if="errorPackages" class="text-red-600 mt-2">{{ errorPackages }}</div>
      </div>

      <div class="p-4 border rounded">
        <h2 class="font-medium mb-2">Konten Beranda</h2>
        <div v-if="loadingPosts" class="text-gray-500">Memuat...</div>
        <ul v-else>
          <li v-for="post in posts" :key="post.id" class="py-1">
            {{ post.judul }}
          </li>
        </ul>
        <div v-if="errorPosts" class="text-red-600 mt-2">{{ errorPosts }}</div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import api from '../api';

const packages = ref([]);
const posts = ref([]);
const loadingPackages = ref(false);
const loadingPosts = ref(false);
const errorPackages = ref('');
const errorPosts = ref('');

onMounted(async () => {
  // packages
  loadingPackages.value = true;
  try {
    const { data } = await api.get('/packages');
    packages.value = data;
  } catch (e) {
    errorPackages.value = 'Gagal memuat paket (butuh auth user).';
  } finally {
    loadingPackages.value = false;
  }

  // posts (published)
  loadingPosts.value = true;
  try {
    const { data } = await api.get('/posts');
    posts.value = data;
  } catch (e) {
    errorPosts.value = 'Gagal memuat konten (butuh auth user).';
  } finally {
    loadingPosts.value = false;
  }
});
</script>