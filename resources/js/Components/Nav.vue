<template>
  <teleport to="#sidebar">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li class="nav-header">MENU</li>
            <NavLink
              :icon="'fas fa-user-friends'"
              :url="route('companies.index')"
              :component="['Companies/index', 'Companies/create']"
            >
              Companies
              <span class="badge badge-primary right">{{
                $page.props.global.companies.count
              }}</span>
            </NavLink>

            <NavLink
              :icon="'fas fa-user-friends'"
              :url="route('employees.index')"
              :component="['Employees/index', 'Employees/create']"
            >
              Employees
              <span class="badge badge-primary right">{{
                $page.props.global.employees.count
              }}</span>
            </NavLink>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </teleport>
</template>


<script>
import NavLink from "./NavLink.vue";

export default {
  components: { NavLink },

  mounted() {},
};
</script>