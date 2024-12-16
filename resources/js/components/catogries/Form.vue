<template>
    <div class="home-container">
      <!-- Sidebar Section -->
      <Sidebar />

      <!-- Main Content Section -->
      <main class="main-content">
        <div class="form-section" id="category-form">
          <h3>{{ isEditMode ? 'Edit Category' : 'Create Category' }}</h3>

          <form @submit.prevent="submitForm">
            <!-- Category Title -->
            <div class="form-group">
              <label for="title">Title</label>
              <input
                type="text"
                id="title"
                v-model="category.title"
                required
                placeholder="Enter category title"
              />
            </div>

            <!-- Category Description -->
            <div class="form-group">
              <label for="description">Description</label>
              <textarea
                id="description"
                v-model="category.description"
                required
                placeholder="Enter category description"
              ></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
              <button type="submit">{{ isEditMode ? 'Update Category' : 'Create Category' }}</button>
            </div>
          </form>
        </div>
      </main>
    </div>
  </template>

  <script>
  import { ref, onMounted } from 'vue';
  import { useRoute, useRouter } from 'vue-router';
  import axios from 'axios';

  export default {
    name: 'CategoryFormWithSidebar',

    setup() {
      const category = ref({
        title: '',
        description: '',
      });
      const isEditMode = ref(false);
      const route = useRoute();
      const router = useRouter();

      const fetchCategory = async (id) => {
        try {
          const response = await axios.get(`/api/getCatogryById/${id}`, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
          });
          category.value = response.data.data;
        } catch (error) {
          console.error('Error fetching category:', error);
          alert('Failed to fetch category data');
        }
      };

      const submitForm = async () => {
        try {
          if (isEditMode.value) {
            await axios.put(`/api/updateCatogry/${route.params.id}`, category.value, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
              },
            });
            alert('Category updated successfully');
          } else {
            await axios.post('/api/createCatogry', category.value, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
              },
            });
            alert('Category created successfully');
          }
          router.push('/catogries');
        } catch (error) {
          console.error('Error submitting form:', error);
          alert('Failed to submit form');
        }
      };


      onMounted(() => {
        if (route.params.id) {
          isEditMode.value = true;
          fetchCategory(route.params.id);
        } else {
          isEditMode.value = false;
        }
      });

      return {
        category,
        isEditMode,
        submitForm,
      };
    },
  };
  </script>

  <style scoped>
  .home-container {
    display: flex;
  }

  .form-section {
    max-width: 800px;
    margin: 0 auto;
  }

  .form-group {
    margin-bottom: 15px;
  }

  form input,
  form textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  form button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  form button:hover {
    background-color: #0056b3;
  }

  h3 {
    text-align: center;
  }
  </style>
