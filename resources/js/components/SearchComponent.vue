<template>
  <form class="d-flex position-relative">
    <input
      class="form-control me-2"
      v-model="name"
      v-on:keyup="getTheme()"
      type="search"
      placeholder="Search"
      aria-label="Search"
    />
    <ul
      id="listSearch"
      :class="{ 'd-block position-absolute': isActive }"
      class="dropdown-menu position-absolut"
    >
      <li v-for="result in results" :key="result.message">
        <a v-if="result" class="dropdown-item" :href="/theme/ + result.id">{{
          result.name
        }}</a>
      </li>
    </ul>
  </form>
</template>

<script>
export default {
  data: function () {
    return {
      name: "",
      csrfToken: "",
      data: [],
      isActive: false,
      results: [],
    };
  },
  mounted() {},
  methods: {
    getTheme: async function () {
      try {
        if (this.name != null || typeof str !== "undefined") {
          const response = await fetch("/api/get_theme/" + this.name.trim(), {
            method: "GET",
            headers: {
              "Content-Type": "text/plain",
            },
          });
          const $listSearch = document.querySelector("#listSearch");
          this.results = await response.json();
          if (this.results) {
            this.isActive = true;
          } else {
            this.isActive = false;
          }
        } else {
          this.isActive = false;
        }
      } catch (error) {
        console.error("Ошибка:", error);
      }
    },
  },
};
</script>
