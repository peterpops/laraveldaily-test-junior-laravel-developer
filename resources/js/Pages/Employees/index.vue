<template>
  <HeaderTitle title="Employees" />
  <div class="container-fluid">
    <div class="row pb-2">
      <div class="col-12">
        <div class="float-right">
          <a
            class="btn btn-primary"
            v-if="global.auth && global.auth.user"
            :href="route('employees.create')"
            >Create</a
          >
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Employees</h3>
          </div>

          <div class="card-body p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Phone</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr
                  class="employee-row"
                  @click="visitEmployee(employee)"
                  v-for="(employee, index) in employees.data" 
                  :key="index">
                  <td>{{ employee.id }}</td>
                  <td>{{ employee.first_name }} {{ employee.last_name }}</td>
                  <td>{{ employee.email }}</td>
                  <td>{{ employee.phone }}</td>
                  <td>
                    <a
                      class="btn btn-xs btn-primary mr-1"
                      v-if="global.auth && global.auth.user"
                      @click.stop="editEmployee(employee)"
                      >Edit</a
                    >
                    <a
                      class="btn btn-xs btn-danger"
                      v-if="global.auth && global.auth.user"
                      @click="deleteEmployee(employee)"
                      >Delete</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination :data="employees" @callback="paginate"></pagination>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { defineProps, useAttrs } from "vue";
import pagination from "@/Components/Pagination.vue";
import { modal } from "@/Composables/useModal";
import { toast } from "@/Composables/useToast";

// recive attr
const global = useAttrs().global;

// props
const props = defineProps({
  employees: Object,
});

// methods
function paginate(url) {
  Inertia.get(url);
}

function deleteEmployee(employee) {
  modal.confirm(
    "Delete employee",
    'Are your sure you want to delete employee "' +
      employee.first_name +
      " " +
      employee.last_name +
      '"?',
    () => {
      Inertia.delete(route("employees.destroy", { employee_id: employee.id }), {
        onSuccess: (page) => {
          // show success toast
          toast.success("Success!", "Employee successfully deleted.");

          // reload companies
          Inertia.reload({
            only: ["employees"],
          });
        },
        onError: (error) => {
          alert(error);
        },
      });
    }
  );
}

function editEmployee(employee) {
  Inertia.get(route('employees.edit', {employee_id: employee.id}));
}

function visitEmployee(employee) {
  Inertia.get(route('employees.show', {employee_id: employee.id}));
}
</script>

<style>
.employee-row {
  cursor: pointer;
}
</style>