<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import defaultHeaderTitle from "@/Layouts/default-headerTitle.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

defineProps({
  canResetPassword: Boolean,
  status: String,
  errors: Object,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <default-header-title title="Log in" />
  <div class="card">
    <div class="card-header">Log in</div>
    <div class="card-body">
      <form @submit.prevent="submit">
        <!-- name -->
        <div class="form-group row">
          <InputLabel for="email" value="Email" />
          <div class="col-8">
            <TextInput
              id="email"
              type="email"
              class="form-control"
              :class="{
                'is-invalid': errors && errors.email,
              }"
              v-model="form.email"
              required
              autofocus
              autocomplete="username"
            />
            <InputError class="mt-2" :message="errors.email" />
          </div>
        </div>
        <!-- email -->
        <div class="form-group row">
          <InputLabel for="password" value="Password" />
          <div class="col-8">
            <TextInput
              id="password"
              type="password"
              class="form-control"
              v-model="form.password"
              required
              autocomplete="current-password"
            />
            <InputError class="mt-2" :message="errors.password" />
          </div>
        </div>

        <div class="form-group row">
          <InputLabel for="remember" value="Remember me" />
          <div class="col-8">
            <Checkbox name="remember" v-model:checked="form.remember" />
          </div>
        </div>

        <div class="flex items-center justify-end mt-4">
          <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="underline text-sm text-gray-600 hover:text-gray-900"
          >
            Forgot your password?
          </Link>
          <button type="submit" class="btn btn-primary">Log in</button>
        </div>
      </form>
    </div>
  </div>

  <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
  </div>
</template>
