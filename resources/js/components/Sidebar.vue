<template>
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Dashboard</h2>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li>
                <router-link to="/">Home</router-link>
            </li>
            <li>
                <router-link to="/catogries">Categories</router-link>
            </li>
            <li>
                <router-link to="/category/archieve">Categories Archive</router-link>
            </li>
            <li>
                <router-link to="/tasks">Tasks</router-link>
            </li>
            <li>
                <router-link to="/task/archieve">Tasks Archive</router-link>
            </li>

        </ul>
    </nav>

    <div class="sidebar-footer">
        <button @click="logout">Logout</button>
    </div>

</aside>
</template>

<script>
export default {
    name: 'Sidebar',
    methods: {
        async logout() {
            try {
                const token = localStorage.getItem('auth_token');
                if (!token) {
                    console.log("No token found, already logged out.");
                    this.$router.push('/login');
                    return;
                }

                await axios.post('/api/logout', {}, {
                    headers: {
                        Authorization: `Bearer ${token}`, // Attach the token in the Authorization header
                    },
                });

                localStorage.removeItem('auth_token');

                    this.$router.push('/login');
            } catch (error) {
                console.error("Logout error:", error);
            }
        }
    }

};
</script>
