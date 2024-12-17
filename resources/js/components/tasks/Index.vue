<template>
<div class="home-container">
    <Sidebar />
    <main class="main-content">
        <div class="tasks-section" id="tasks">
            <h3>Tasks</h3>
            <button class="create-category-btn" @click="addTask">Create</button>
            <table v-if="tasks.length > 0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="task in tasks" :key="task.id">
                        <td>{{ task.title }}</td>
                        <td>{{ task.description.slice(0, 50) }}...</td>
                        <td>
                            <span v-if="task.status === 0">Pending</span>
                            <span v-else-if="task.status === 1">In Progress</span>
                            <span v-else-if="task.status === 2">Finished</span>
                        </td>
                        <td>
                            <button @click="editTask(task.id)">Edit</button>
                            <button @click="deleteTask(task.id)">Delete</button>
                            <button @click="changeTaskStatus(task.id)">change Status</button>

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
                });
            }
        };

        const changeTaskStatus = async (id) => {
            try {
                await axios.get(`/api/changeTaskStatus/${id}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
                    },
                });
                console.log(localStorage.getItem('auth_token'));
                fetchTasks();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Change task status successfully',
                    confirmButtonText: 'Ok'
                });
            } catch (error) {
                console.error('Error change task status:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to change task status',
                    confirmButtonText: 'Ok'
                });
            }
        };

        onMounted(() => {
            fetchTasks();
        });

        return { tasks, addTask, editTask, deleteTask , changeTaskStatus};
    },
};
</script>
