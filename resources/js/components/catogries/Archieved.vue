<template>
    <div class="home-container">
      <Sidebar />
      <main class="main-content">
        <div class="categories-section" id="categories">
          <h3>Categories Archive</h3>
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
                  <button @click="restoreCategory(category.id)">Restore</button>
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

  export default {
    name: 'CategoryTable',

    setup() {
      const categories = ref([]);
      const router = useRouter();

      const fetchCategories = async () => {
        try {
          const response = await axios.get('/api/getDeletedCategories', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
              }
          });
          console.log(localStorage.getItem('auth_token'));

          categories.value = response.data.data;
        } catch (error) {
          console.error('Error fetching categories:', error);
        }
      };





      const restoreCategory = async (id) => {
    try {
        await axios.put(`/api/restore/${id}`, {}, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
        });

        fetchCategories();
        alert('Restored successfully');
    } catch (error) {
        console.error('Error restoring category:', error);
        alert('Failed to restore category');
    }
};



      const deleteCategory = async (id) => {
        try {
          await axios.delete(`/api/forceDelete/${id}`, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
          });
          fetchCategories();
          alert('Category deleted successfully');
        } catch (error) {
          console.error('Error deleting category:', error);
          alert('Failed to delete category');
        }
      };

      onMounted(() => {
        fetchCategories();
      });

      return { categories,restoreCategory, deleteCategory };
    },
  };
  </script>

