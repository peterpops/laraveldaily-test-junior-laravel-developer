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

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit company</h3>
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
                'is-invalid': errors && errors['editForm.name'],
              }"
              id="name"
              placeholder="First name"
              v-model="editForm.name"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.name']"
            >
              {{ errors["editForm.name"] }}
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
                'is-invalid': errors && errors['editForm.website'],
              }"
              id="name"
              placeholder="Website"
              v-model="editForm.website"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.website']"
            >
              {{ errors["editForm.website"] }}
            </span>
          </div>
        </div>

        <!-- logo -->
        <div class="form-group row">
          <label for="logo" class="col-sm-4 col-form-label">Company logo</label>
          <div class="col-sm-8">
            <img :src="props.company.logo_url" v-if="props.company.logo" />
            <input
              type="file"
              ref="logo"
              class="form-control"
              :class="{
                'is-invalid': errors && errors['editForm.logo'],
              }"
              id="logo"
              placeholder="Logo"
              @input="editForm.logo = $event.target.files[0]"
            />
            <span
              class="error invalid-feedback"
              v-if="errors && errors['editForm.logo']"
            >
              {{ errors["editForm.logo"] }}
            </span>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button class="btn btn-default mr-2" @click="update()">Save</button>
        <Link class="btn btn-primary" :href="route('companies.index')">
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

// props
const props = defineProps({
  company: Object,
  errors: Object,
});

// data
let editForm = {
  name: props.company.name,
  email: props.company.email,
  website: props.company.website,
  logo: null,
};


// functions
let update = () => {
  Inertia.post(
    route("companies.update", { company_id: props.company.id }),
    {
      _method: 'put',
      editForm: editForm,
    },
    {
      onSuccess: (page) => {
        // success toast
        toast.success("Company updated!", 'Company info updated.');

        // redirect to list
        Inertia.get(route("companies.index"));
      },
      onError: (error) => {
        // error toast
        toast.error('Error!', "Failed to update company!");
      },
    }
  );
};
</script>

<style>
</style>