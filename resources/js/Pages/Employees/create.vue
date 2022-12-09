<template>
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

    <!-- form card -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create new employee</h3>
      </div>
      <div class="card-body">
        <!-- first name -->
        <div class="form-group row">
          <label for="name" class="col-sm-4 col-form-label"
            >employee first name</label
          >
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['firstName'],
              }"
              id="name"
              placeholder="Firstname"
              v-model="addForm.firstName"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['firstName']"
            >
              {{ errors["firstName"] }}
            </span>
          </div>
        </div>

        <!-- last name -->
        <div class="form-group row">
          <label for="name" class="col-sm-4 col-form-label"
            >employee last name</label
          >
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['lastName'],
              }"
              id="name"
              placeholder="Lastname"
              v-model="addForm.lastName"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['lastName']"
            >
              {{ errors["lastName"] }}
            </span>
          </div>
        </div>

        <!-- email -->
        <div class="form-group row">
          <label for="email" class="col-sm-4 col-form-label"
            >Employee email</label
          >
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['email'],
              }"
              id="name"
              placeholder="Email"
              v-model="addForm.email"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['email']"
            >
              {{ errors["email"] }}
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
                'is-invalid': errors && errors['phone'],
              }"
              id="name"
              placeholder="Phone"
              v-model="addForm.phone"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['phone']"
            >
              {{ errors["phone"] }}
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
                'is-invalid': errors && errors['company'],
              }"
              v-model="addForm.company"
            >
              <option
                v-for="(option, index) in companies"
                :key="index"
                :value="option.id"
              >
                {{ option.name }}
              </option>
            </select>
            <span
              class="error invalid-feedback"
              v-if="errors && errors['company']"
            >
              {{ errors["company"] }}
            </span>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button class="btn btn-default" @click="store()">Save</button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { toast } from "@/Composables/useToast";
import { defineProps, ref } from "vue";

// props
const props = defineProps({
  companies: Object,
  errors: Object,
});

// data
let addForm = {
  firstName: "",
  lastName: "",
  email: "",
  phone: "",
  company: "",
};

let store = () => {
  Inertia.post(
    route("employees.store"),
    addForm,

    {
      preserveScroll: true,
      onSuccess: (page) => {
        // toast
        toast.success("Success", "Employee has been created.");
      },
      onError: (errors) => {
        toast.error("Error", "The from contains some errors.");
      },
    }
  );
};
</script>

<style>
</style>