<template>
  <HeaderTop />
  <router-view />
  <Contacts />
</template>

<script setup>
import HeaderTop from "./Header/Header.vue";
import Contacts from "./Contacts/Contacts.vue";
</script>
