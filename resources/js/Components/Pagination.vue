<template>
  <div class="card-footer p-0 border-top">
    <div class="row">
      <div class="col-sm-6">
        <div id="paginationInfo" class="mt-auto p-3">
          Showing {{ data.from }} to {{ data.to }} of total {{ data.total }} rows.
        </div>
      </div>
      <div class="col-sm-6">
        <ul id="pagination" class="pagination float-right mt-auto mb-1 p-2">
          <li
            class="paginate_button page-item"
            v-for="(link, index) in data.links"
            :key="index"
            :class="{ active: link.active }"
          >
            <button
              class="page-link"
              @click="paginationLink(link.url)"
              v-if="(data.current_page != 1) && index <= 0"
            >
              Previous
            </button>
            <button
              class="page-link"
              @click="paginationLink(link.url)"
              v-else-if="(link.label.search('Next') >= 0) && data.last_page != data.current_page"
            >
              Next
            </button>
            <button 
              class="page-link" 
              @click="paginationLink(link.url)"
              v-else-if="(link.url) && (index + 1 < data.last_page)"
            >
              {{ link.label }}
            </button>

          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    data: Object,
  },

  methods: {
  paginationLink: function(url) {
      this.$emit("callback", url)
    },
  },
};
</script>

<style>
</style>