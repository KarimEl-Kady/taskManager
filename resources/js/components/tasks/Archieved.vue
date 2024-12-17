<template>
    <div class="home-container">
      <Sidebar />
      <main class="main-content">
        <div class="tasks-section" id="tasks">
          <h3>Tasks Archive</h3>
          <table v-if="tasks.length > 0">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="task in tasks" :key="task.id">
                <td>{{ task.title }}</td>
                <td>{{ task.description.slice(0, 50) }}...</td> <!-- Show a short description -->
                <td>
                  <button @click="restoreTask(task.id)">Restore</button>
                  <button @click="deleteTask(task.id)">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
          <p v-else>No tasks found.</p>
        </div>
      </main>
    </div>
  </template>

  <script>
  import { ref, onMounted } from 'vue';
  import { useRouter } from 'vue-router';
  import Swal from 'sweetalert2';

  export default {
    name: 'TaskTable',

    setup() {
      const tasks = ref([]);
      const router = useRouter();

      const fetchTasks = async () => {
        try {
          const response = await axios.get('/api/getDeletedTasks', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
              }
          });
          console.log(localStorage.getItem('auth_token'));

          tasks.value = response.data.data;
        } catch (error) {
          console.error('Error fetching tasks:', error);
        }
      };





      const restoreTask = async (id) => {
    try {
        await axios.put(`/api/restoreTask/${id}`, {}, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
        });

        fetchTasks();
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Task restored successfully',
            confirmButtonText: 'Ok'
        });
    } catch (error) {
        console.error('Error restoring task:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to restore task',
            confirmButtonText: 'Ok'
        });
    }
};



      const deleteTask = async (id) => {
        try {
          await axios.delete(`/api/forceDeleteTask/${id}`, {
            headers: {
              Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
            },
          });
          fetchTasks();
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Task deleted successfully',
            confirmButtonText: 'Ok'
          });
        } catch (error) {
          console.error('Error deleting task:', error);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to delete task',
            confirmButtonText: 'Ok'
          })
        }
      };

      onMounted(() => {
        fetchTasks();
      });

      return { tasks,restoreTask, deleteTask };
    },
  };
  </script>

