<template>
  <HeaderTitle title="Showing info for employee" />
  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <Link class="btn btn-primary" :href="route('employees.edit', {employee_id: employee.id})" text="Edit" />
        </div>

        <div class="col-sm-6">
          <div class="float-right">
            <Link class="btn btn-primary" :href="route('employees.index')">
              Back
            </Link>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <!-- employee info -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employee info</h3>
            </div>
            <div class="card-body">
              <strong>Name</strong>
              <p class="text-muted">
                {{ employee.first_name }} {{ employee.last_name }}
              </p>
              <strong>Email</strong>
              <p class="text-muted">{{ employee.email }}</p>
              <strong>Phone</strong>
              <p class="text-muted">{{ employee.phone }}</p>
            </div>
          </div>
        </div>
        <div class="col-6">
          <!-- company info -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Employee belongs to company</h3>
            </div>
            <div class="card-body">
              <strong>Company name</strong>
              <p class="text-muted">
                <Link
                  :href="
                    route('companies.show', { company_id: employee.company.id })
                  "
                  :text="employee.company.name"
                ></Link>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
// props
const props = defineProps({
  employee: Object,
});
</script>

<style>
</style>