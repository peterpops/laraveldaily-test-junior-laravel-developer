<template>
  <default-header-title title="Companies" />
  <div class="container-fluid">
    <div class="row pb-2">
      <div class="col-12">
        <div class="float-right">
          <Link
            class="btn btn-primary"
            :href="route('companies.create')"
            v-if="global.auth && global.auth.user"
            >Create</Link
          >
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Companies</h3>
          </div>

          <div class="card-body p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Website</th>
                  <th>Logo</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(company, index) in companies.data" :key="index">
                  <td>{{ company.id }}</td>
                  <td>{{ company.name }}</td>
                  <td>{{ company.email }}</td>
                  <td>{{ company.website }}</td>
                  <td>
                    <img :src="company.logo_url" v-if="company.logo" />
                    <a
                      class="btn btn-xs btn-primary ml-1 mr-1"
                      v-if="global.auth.user"
                      :href="
                        route('companies.edit', { company_id: company.id })
                      "
                      >Edit</a
                    >
                    <a
                      class="btn btn-xs btn-danger"
                      v-if="global.auth.user"
                      @click="deleteCompany(company)"
                      >Delete</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination :data="companies" @callback="paginate"></pagination>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import defaultHeaderTitle from "@/Layouts/default-headerTitle.vue";
import pagination from "@/Components/Pagination.vue";
import { ref, useAttrs } from "vue";
import { modal } from "@/Composables/useModal";
import { toast } from "@/Composables/useToast";

// props
const props = defineProps({
  companies: Object,
});

// recive attr
const global = useAttrs().global;

// methods
function paginate(url) {
  Inertia.get(url);
}

function deleteCompany(company) {
  modal.confirm(
    "Delete company",
    'Are your sure you want to delete company "' + company.name + '"?',
    () => {
      Inertia.delete(route("companies.destroy", { company_id: company.id }), {
        onSuccess: (page) => {
          // show success toast
          toast.success('Success!', 'Company successfully deleted.')

          // reload companies 
          Inertia.reload({
            only: ['companies']
          })
        },
        onError: (error) => {
          alert(error);
        }
      });
    }
  );
}
</script>

<style>
</style>