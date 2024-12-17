<template>
    <div class="home-container">
      <Sidebar />
      <!-- Main Content Section -->
      <main class="main-content">
        <div class="categories-section" id="categories">
          <h3>Categories</h3>
          <button class="create-category-btn" @click="addCategory">Create</button>
          <!-- Category Table -->
          <table v-if="categories.length > 0">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="category in categories" :key="category.id">
                <td>{{ category.title }}</td>
                <td>{{ category.description.slice(0, 50) }}...</td> <!-- Show a short description -->
                <td>
                  <button @click="editCategory(category.id)">Edit</button>
                  <button @click="deleteCategory(category.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
          <p v-else>No categories found.</p>
        </div>
      </main>
    </div>
  </template>

  <script>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import Swal from 'sweetalert2';

  export default {
    name: 'CategoryTable',

    setup() {
      const categories = ref([]);
      const router = useRouter();

      const fetchCategories = async () => {
        try {
          const response = await axios.get('/api/getCatogry', {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
          });
          categories.value = response.data.data;
        } catch (error) {
          console.error('Error fetching categories:', error);
        }
      };


      const addCategory = () => {
        console.log('Navigating to create category page');
        router.push({ name: 'create-category' });
      };


      const editCategory = (id) => {
        console.log('Edit category with id:', id);
        router.push({ name: 'edit-category', params: { id } });
      };


      const deleteCategory = async (id) => {
        try {
          await axios.delete(`/api/deleteCatogry/${id}`, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
          });
          fetchCategories();
        Swal.fire({
            icon: 'success',
            title: 'Category deleted successfully!',
                confirmButtonText: 'Ok'
          });
        } catch (error) {
          console.error('Error deleting category:', error);
        Swal.fire({
            icon: 'error',
            title: 'Failed to delete category',
            confirmButtonText: 'Ok'
          });
        }
      };

      onMounted(() => {
        fetchCategories();
      });

      return { categories, addCategory, editCategory, deleteCategory };
    },
  };
  </script>

