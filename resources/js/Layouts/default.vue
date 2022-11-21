<template>
  <teleport to="#userdata" v-if="$page.props.global.auth.user">
    <Link
      class="btn btn-outline-primary btn-sm mt-1 mr-1"
      href="#"
    >
      {{ $page.props.global.auth.user.name }}
    </Link>
    <Link
      class="btn btn-outline-secondary btn-sm mt-1"
      method="post"
      as="button"
      :href="route('auth.logout')"
    >
      <i class="fas fa-lock"></i> Log out
    </Link>
  </teleport>
  <teleport to="#userdata" v-else>
    <Link
      class="btn btn-outline-secondary btn-sm mt-1"
      :href="route('login')"
    >
      <i class="fas fa-lock"></i> Log in
    </Link>
  </teleport>
  <!-- teleport nav to sidebar -->
  <Nav></Nav>

  <!-- inertia main content to slot -->
  <slot />
</template>

<script>
import Nav from "@/Components/Nav.vue";

export default {
  components: { Nav },

  data() {
    return {};
  },

  mounted() {},
};
</script>