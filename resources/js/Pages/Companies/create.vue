<template>
  <section class="content">
    <div class="row mb-2">
      <div class="col-sm-6"></div>

      <div class="col-sm-6">
        <div class="float-right">
          <Link class="btn btn-primary" :href="route('companies.index')">
            <i class="far fa-calendar-alt"></i> Back
          </Link>
        </div>
      </div>
    </div>

    <!-- filter card -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create new company</h3>
      </div>
      <div class="card-body">
        <!-- name -->
        <div class="form-group row">
          <label for="name" class="col-sm-4 col-form-label">Company name</label>
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['name'],
              }"
              id="name"
              placeholder="Company name"
              v-model="addForm.name"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['name']"
            >
              {{ errors["name"] }}
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

        <!-- website -->
        <div class="form-group row">
          <label for="website" class="col-sm-4 col-form-label"
            >Company website</label
          >
          <div class="col-sm-8">
            <input
              type="text"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['website'],
              }"
              id="name"
              placeholder="Website"
              v-model="addForm.website"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['website']"
            >
              {{ errors["website"] }}
            </span>
          </div>
        </div>

        <!-- logo -->
        <div class="form-group row">
          <label for="logo" class="col-sm-4 col-form-label">Company logo</label>
          <div class="col-sm-8">
            <input
              type="file"
              ref="logo"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['logo'],
              }"
              id="logo"
              placeholder="Logo"
              @input="addForm.logo = $event.target.files[0]"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['logo']"
            >
              {{ errors["logo"] }}
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
import { defineProps } from "vue";

// props
const props = defineProps({
  company: Object,
  errors: Object,
});

// data
let addForm = {
  name: "",
  email: "",
  logo: "",
  website: "",
};

let handleLogoUpload = () => {
  addForm.logo = this.$refs.logo;
};

let store = () => {
  Inertia.post(
    route("companies.store"),
    addForm,
    {
      preserveScroll: true,
      onSuccess: (page) => {
        // toast
        toast.success("Success", "Company has been created.");
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