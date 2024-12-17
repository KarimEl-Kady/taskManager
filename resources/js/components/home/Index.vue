<template>
<div class="home-container">

    <Sidebar />

    <!-- Main Content Section -->
    <main class="main-content">
        <div class="categories-section" id="categories">
            <h3>Last Categories</h3>
            <table v-if="catogries.length > 0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in catogries" :key="category.id">
                        <td>{{ category.title }}</td>
                        <td>{{ category.description.slice(0, 50) }}...</td>
                    </tr>
                </tbody>
            </table>
            <p v-else>No categories found.</p>
        </div>

        <div class="tasks-section" id="tasks">
            <h3>Last Tasks</h3>
            <table v-if="tasks.length > 0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
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
import Swal from 'sweetalert2';

export default {
    setup() {
        const tasks = ref([]);
        const catogries = ref([]);

        const fetchTasks = async () => {
            try {
                const response = await axios.get('/api/getTasks', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
                    },

                });
                tasks.value = response.data.data.slice(0, 3);
            } catch (error) {
                console.error('Error fetching tasks:', error);
            }
        };

        const fetchCatogries = async () => {
            try {
                const response = await axios.get('/api/getCatogry', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
                    },
                });
                catogries.value = response.data.data.slice(0, 3);
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        };


        onMounted(() => {
            fetchTasks();
            fetchCatogries();
        });

        return { tasks , catogries };
    },
};
</script>
