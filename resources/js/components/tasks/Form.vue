<template>
    <div class="home-container">
      <Sidebar />

      <main class="main-content">
        <div class="form-section" id="task-form">
          <h3>{{ isEditMode ? 'Edit Task' : 'Create Task' }}</h3>

          <form @submit.prevent="submitForm">
            <!-- Task Title -->
            <div class="form-group">
              <label for="title">Title</label>
              <input
                type="text"
                id="title"
                v-model="task.title"
                required
                placeholder="Enter task title"
              />
            </div>

            <!-- Task Description -->
            <div class="form-group">
              <label for="description">Description</label>
              <textarea
                id="description"
                v-model="task.description"
                required
                placeholder="Enter task description"
              ></textarea>
            </div>

            <div class="form-group">
              <label for="category">Select Category</label>
              <select v-model="task.catogry_id" required>
                <option value="" disabled selected>Select a Category</option>
                <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                  {{ cat.title }}
                </option>
              </select>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
              <button type="submit">{{ isEditMode ? 'Update Task' : 'Create Task' }}</button>
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
    name: 'TaskFormWithSidebar',

    setup() {
      const task = ref({
        title: '',
        description: '',
        category_id: '',
      });
      const isEditMode = ref(false);
      const route = useRoute();
      const router = useRouter();
      const categories = ref([]);


      const fetchCategories = async () => {
        try {
          const response = await axios.get('/api/getCatogry', {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
          });
          categories.value = response.data.data;


          if (!isEditMode.value && categories.value.length > 0) {
            task.value.category_id = categories.value[0].id;
          }
        } catch (error) {
          console.error('Error fetching categories:', error);
          alert('Failed to fetch categories');
        }
      };


      const fetchTask = async (id) => {
        try {
          const response = await axios.get(`/api/getTaskById/${id}`, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
          });
          task.value = response.data.data;
          console.log(task.value);
        } catch (error) {
          console.error('Error fetching task:', error);
          alert('Failed to fetch task data');
        }
      };


      const submitForm = async () => {
        try {
          if (isEditMode.value) {

            await axios.put(`/api/updateTask/${route.params.id}`, task.value, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
              },
            });
            alert('Task updated successfully');
          } else {

            await axios.post('/api/createTask', task.value, {
              headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
              },
            });
            alert('Task created successfully');
          }
          router.push('/tasks');
        } catch (error) {
          console.error('Error submitting form:', error);
          alert('Failed to submit form');
        }
      };


      onMounted(() => {
        fetchCategories();
        if (route.params.id) {
          isEditMode.value = true;
          fetchTask(route.params.id);
        } else {
          isEditMode.value = false;
        }
      });

      return {
        task,
        isEditMode,
        submitForm,
        categories,
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
  form textarea,
  form select {
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

  table {
    width: 100%;
    margin-top: 20px;
  }

  table th,
  table td {
    padding: 10px;
    text-align: left;
  }

  button {
    margin-right: 10px;
  }
  </style>
