<template>
  <div class="home-container">
    <Sidebar />
    <main class="main-content">
      <div class="tasks-section" id="tasks">
        <h3>Tasks</h3>
        <button class="create-task-btn" @click="addTask">Create</button>
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
              <td>{{ task.description.slice(0, 50) }}...</td>
              <td>
                <button @click="editTask(task.id)">Edit</button>
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

export default {
  name: 'TaskTable',

  setup() {
    const tasks = ref([]);
    const router = useRouter();

    const fetchTasks = async () => {
      try {
        const response = await axios.get('/api/getTasks', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        tasks.value = response.data.data;
      } catch (error) {
        console.error('Error fetching tasks:', error);
      }
    };

    const addTask = () => {
      router.push({ name: 'create-task' });
    };

    const editTask = (id) => {
      router.push({ name: 'edit-task', params: { id } });
    };

    const deleteTask = async (id) => {
      try {
        await axios.delete(`/api/deleteTask/${id}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });
        fetchTasks();
        alert('Task deleted successfully');
      } catch (error) {
        console.error('Error deleting task:', error);
        alert('Failed to delete task');
      }
    };

    onMounted(() => {
      fetchTasks();
    });

    return { tasks, addTask, editTask, deleteTask };
  },
};
</script>
