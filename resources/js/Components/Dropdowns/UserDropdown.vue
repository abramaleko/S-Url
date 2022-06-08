<template>
  <div>
    <a
      class="block text-blueGray-500"
      href="#pablo"
      ref="btnDropdownRef"
      v-on:click="toggleDropdown($event)"
    >
      <div class="flex items-center">
        <span
          class="inline-flex items-center justify-center w-12 h-12 text-sm text-white rounded-full" style="background-color: #269ED1;"
        >
          <i class="fas fa-user"></i>
        </span>
      </div>
    </a>
    <div
      ref="popoverDropdownRef"
      class="z-50 float-left py-2 text-base text-left list-none bg-white rounded shadow-lg min-w-48"
      v-bind:class="{
        hidden: !dropdownPopoverShow,
        block: dropdownPopoverShow,
      }"
    >
      <a
        href="javascript:void(0);"
        class="block w-full px-4 py-2 text-sm font-normal bg-transparent whitespace-nowrap text-blueGray-700"
      >
        Profile
      </a>
      <div class="h-0 my-2 border border-solid border-blueGray-100" />

        <Link :href="route('logout')" class="block w-full px-4 py-2 text-sm font-normal bg-transparent cursor-pointer whitespace-nowrap text-blueGray-700" method="post" as="link">Log Out</Link>
    </div>
  </div>
</template>

<script>
import { createPopper } from "@popperjs/core";
import { Link } from '@inertiajs/inertia-vue3'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';



export default {
    components: {
        Link,
    },
  data() {
    return {
      dropdownPopoverShow: false,
    };
  },
  methods: {
    toggleDropdown: function (event) {
      event.preventDefault();
      if (this.dropdownPopoverShow) {
        this.dropdownPopoverShow = false;
      } else {
        this.dropdownPopoverShow = true;
        createPopper(this.$refs.btnDropdownRef, this.$refs.popoverDropdownRef, {
          placement: "bottom-start",
        });
      }
    },
  },
};
</script>
