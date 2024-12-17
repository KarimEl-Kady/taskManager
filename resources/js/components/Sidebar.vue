<template>
    <aside class="sidebar">
      <div class="sidebar-header">
        <h2>Dashboard</h2>
      </div>
      <nav class="sidebar-nav">
  <ul>
    <li><router-link to="/catogries">Categories</router-link></li>
    <li><router-link to="/category/archieve">Categories Archive</router-link></li>
    <li><router-link to="/tasks">Tasks</router-link></li>
    <li><router-link to="/task/archieve">Tasks Archive</router-link></li>

  </ul>
</nav>

    </aside>
  </template>

  <script>
  export default {
    name: 'Sidebar',
  };
  </script>
