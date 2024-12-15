<template>
    <div class="register">
      <h1>Register</h1>
      <form @submit.prevent="submitForm">
        <!-- Name Field -->
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" v-model="form.name" id="name" class="form-control" />
          <span v-if="errors.name" class="error-message">{{ errors.name[0] }}</span>
        </div>

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

        <!-- Confirm Password Field -->
        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="form-control" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div>
  </template>

  <script>
  import Swal from 'sweetalert2';
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: '',
          password_confirmation: ''
        },
        errors: {}
      };
    },
    methods: {
      async submitForm() {
        try {
          // Send registration request to backend
          const response = await axios.post('registerUser', this.form);
          alert('Registration successful!');
          // Redirect or reset form after successful registration
        } catch (error) {
          // Handle validation errors
          if (error.response && error.response.data.errors) {
            this.errors = error.response.data.errors;
          }
        }
      }
    }
  };
  </script>

