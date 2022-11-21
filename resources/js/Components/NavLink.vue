<template>
  <li class="nav-item">
    <Link :href=url class="nav-link" :class="{'active': isActive }" >
      <i class="far nav-icon" :class=icon></i>
      <p> <slot /></p>
    </Link>
  </li>
</template>

<script>

export default {
  props: {
    active: Boolean,
    url: String,
    icon: String,
    component: [String, Array]
  },

  computed: {
    isActive() {
      return this.component.includes(this.$page.component )
    }
  }
};
</script>
