<template>
    <div>
      <Navbar></Navbar>
      <div class="container">
        <router-view />
      </div>
    </div>
  </template>
  
  <script setup>
  import { RouterLink, RouterView } from 'vue-router';
  </script>