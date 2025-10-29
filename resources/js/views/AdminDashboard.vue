<template>
  <section>
    <h1 class="text-2xl font-semibold mb-2">Admin Dashboard</h1>
    <p class="text-sm text-gray-600 mb-4">Akses CRUD dan laporan melalui API.</p>
    <ul class="list-disc ml-6">
      <li>GET/POST/PUT/DELETE /api/admin/posts</li>
      <li>GET/POST/PUT/DELETE /api/admin/packages</li>
      <li>GET/POST/PUT/DELETE /api/admin/boats</li>
      <li>GET/POST/PUT/DELETE /api/admin/operators</li>
      <li>GET/POST/PUT/DELETE /api/admin/rescue</li>
      <li>GET /api/admin/reports/bookings|orders</li>
      <li>POST /api/admin/config/payment</li>
      <li>POST /api/admin/seed/demo</li>
    </ul>
    <p class="text-red-600 mt-4">Butuh autentikasi role admin untuk mencoba endpoint.</p>
  </section>
</template>

<script setup>
// admin info only
</script>