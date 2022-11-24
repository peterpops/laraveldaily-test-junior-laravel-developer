<template>
  <HeaderTitle title="Company information" />
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"></div>

        <div class="col-sm-6">
          <div class="float-right">
            <Link class="btn btn-primary" :href="route('companies.index')">
              Back
            </Link>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <!-- company info -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Company info</h3>
            </div>
            <div class="card-body">
              <strong>Name</strong>
              <p class="text-muted">
                {{ company.name }}
              </p>
              <strong>Email</strong>
              <p class="text-muted">{{ company.email }}</p>
              <strong>Logo</strong>
              <img :src="company.logo_url" v-if="company.logo_url" />
            </div>
          </div>
        </div>
        <div class="col-6">
          <!-- employees info -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employee in this company</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-mail</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    class="employee-row"
                    @click="visitEmployee(employee)"
                    v-for="(employee, index) in company.employees"
                    :key="index"
                  >
                    <td>{{ employee.id }}</td>
                    <td>{{ employee.first_name }} {{ employee.last_name }}</td>
                    <td>{{ employee.email }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";

// props
const props = defineProps({
  company: Object,
});

// methods
function visitEmployee(employee) {
  Inertia.get(route("employees.show", { employee_id: employee.id }));
}
</script>

<style>
.employee-row {
  cursor: pointer;
}
</style>