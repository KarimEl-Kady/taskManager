<template>
    <div class="login">
      <h1>Login</h1>
      <form @submit.prevent="submitLogin">
        <!-- Email Field -->
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" v-model="form.email" id="email" class="form-control" />
          <span v-if="errors.email" class="error-message">{{ errors.email[0] }}</span>
        </div>

        <!-- Password Field -->
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" v-model="form.password" id="password" class="form-control" />
          <span v-if="errors.password" class="error-message">{{ errors.password[0] }}</span>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        form: {
          email: '',
          password: '',
        },
        errors: {},
      };
    },
    methods: {
      async submitLogin() {
        try {
          const response = await axios.post('api/loginUser', this.form);

          localStorage.setItem('auth_token', response.data.token);
            console.log(response.data.token);
          this.$swal.fire({
            icon: 'success',
            title: 'Login Successful!',
            text: 'You are now logged in.',
            confirmButtonText: 'Ok'
          });
          this.$router.push('/catogries');

        } catch (error) {
          if (error.response && error.response.data.errors) {
            this.errors = error.response.data.errors;
          } else if (error.response && error.response.data.message) {
            this.$swal.fire({
              icon: 'error',
              title: 'Login Failed',
              text: error.response.data.message,
              confirmButtonText: 'Ok'
            });
          }
        }
      },
    },
  };
  </script>


