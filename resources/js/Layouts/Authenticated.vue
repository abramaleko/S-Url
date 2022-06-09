<script>
import AdminNavbar from "@/Components/Navbars/MainNav.vue";
import Sidebar from "@/Components/Sidebar/Sidebar.vue";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
  name: "admin-layout",
  components: {
    AdminNavbar,
    Sidebar,
  },
};
</script>

<template>
  <div>
    <sidebar />
     <div class="relative md:ml-64 bg-blueGray-100">
      <admin-navbar />
      <!-- Page Content -->
            <main>
                <slot />
            </main>
    </div>
  </div>
</template>

