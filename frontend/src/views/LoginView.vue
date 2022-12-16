<template>
  <h2>Login</h2>

  <template v-if="!auth.isAuthenticated">
    <form @submit.prevent="login">
      <input
        v-model="user.email"
        type="text"
        placeholder="Seu email"
      >
      <input
        v-model="user.password"
        type="password"
        placeholder="Sua senha"
      >
      <button type="submit">
        Login
      </button>
    </form>
  </template>

  <template v-else>
    Logen id
  </template>
</template>

<script setup>
import http from '@/services/http.js';
import {reactive} from 'vue';
import {useAuth} from '@/stores/auth.js';

const auth = useAuth();

const user = reactive({
  email:'jordane09@example.net',
  password:'123'
})

async function login(){
  try {
    const {data} = await http.post('/auth',user);
    auth.setToken(data.token);
    auth.setUser(data.user);
  } catch (error) {
    console.log(error?.response?.data);
  }
}

</script>
