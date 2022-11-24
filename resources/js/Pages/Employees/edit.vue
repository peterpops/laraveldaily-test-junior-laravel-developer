<template>
  <HeaderTitle title="Edit employee" />
  <section class="content">
    <div class="row mb-2">
      <div class="col-sm-6"></div>

      <div class="col-sm-6">
        <div class="float-right">
          <Link class="btn btn-primary" :href="route('employees.index')">
            <i class="far fa-calendar-alt"></i> Back
          </Link>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit employee</h3>
      </div>
      <div class="card-body">
        <!-- first name -->
        <div class="form-group row">
          <label for="firstName" class="col-sm-4 col-form-label">employee first name</label>
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['editForm.firstName'],
              }"
              id="name"
              placeholder="First name"
              v-model="editForm.firstName"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.firstName']"
            >
              {{ errors["editForm.firstName"] }}
            </span>
          </div>
        </div>

                <!-- last name -->
        <div class="form-group row">
          <label for="lastName" class="col-sm-4 col-form-label">employee last name</label>
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['editForm.lastName'],
              }"
              id="name"
              placeholder="Last name"
              v-model="editForm.lastName"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.lastName']"
            >
              {{ errors["editForm.lastName"] }}
            </span>
          </div>
        </div>

        <!-- email -->
        <div class="form-group row">
          <label for="email" class="col-sm-4 col-form-label"
            >Company email</label
          >
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['editForm.email'],
              }"
              id="name"
              placeholder="Email"
              v-model="editForm.email"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.email']"
            >
              {{ errors["editForm.email"] }}
            </span>
          </div>
        </div>

        <!-- phone -->
        <div class="form-group row">
          <label for="phone" class="col-sm-4 col-form-label"
            >Employee phone</label
          >
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['editForm.phone'],
              }"
              id="name"
              placeholder="phone"
              v-model="editForm.phone"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.phone']"
            >
              {{ errors["editForm.phone"] }}
            </span>
          </div>
        </div>

        <!-- company -->
        <div class="form-group row">
          <label for="company" class="col-sm-4 col-form-label">Company</label>
          <div class="col-sm-8">
            <select
              class="form-control"
              :class="{
                'is-invalid': errors && errors['editForm.company'],
              }"
              v-model="editForm.company"
            >
              <option v-for="(option, index) in companies" :key="index" :value="option.id">{{option.name}}</option>
            </select>
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.company']"
            >
              {{ errors["editForm.company"] }}
            </span>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button class="btn btn-default mr-2" @click="update()">Save</button>
        <Link class="btn btn-primary" :href="route('employees.index')">
          <i class="far fa-calendar-alt"></i> Back
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup>
import defaultHeaderTitle from "@/Layouts/default-headerTitle.vue";
import { Inertia } from "@inertiajs/inertia";
import { toast } from "@/Composables/useToast";
import { defineProps } from "vue";

// props
const props = defineProps({
  employee: Object,
  companies: Object,
  errors: Object,
});

// data
let editForm = {
  firstName: props.employee.first_name,
  lastName: props.employee.last_name,
  email: props.employee.email,
  phone: props.employee.phone,
  company: props.employee.company_id,
};


// functions
let update = () => {
  Inertia.post(
    route("employees.update", { employee_id: props.employee.id }),
    {
      _method: 'put',
      editForm: editForm,
    },
    {
      onSuccess: (page) => {
        // success toast
        toast.success("Employee updated!", 'Employee info updated.');

        // redirect to list
        Inertia.get(route("employees.index"));
      },
      onError: (error) => {
        // error toast
        toast.error('Error!', "Failed to update employee!");
      },
    }
  );
};
</script>

<style>
</style>