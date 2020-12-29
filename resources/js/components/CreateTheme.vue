<template>
  <div class="card-box">
    <h4 class="mt-0 mb-3 header-title">Add theme</h4>
    <form role="form" @submit.prevent="addName" id="addTheme">
      <div class="form-group">
        <label for="newTheme">Name</label>
        <input
          type="text"
          class="form-control"
          v-model="theme"
          id="newTheme"
          placeholder="name"
        />
      </div>
      <button
        type="submit"
        class="btn btn-primary mt-2"
        id="sa-custom-position"
      >
        Create
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      theme: "",
      id: "",
    };
  },
  mounted() {
    this.addName();
  },
  methods: {
    addName: async function () {
      if (this.theme) {
        this.data = {
          name: this.theme,
        };
        try {
          const response = await fetch("/set_theme", {
            method: "POST",
            body: JSON.stringify(this.data),
            headers: {
              "Content-Type": "application/json",
            },
          });
          const $result = await response.json();
          this.id = $result.id;
          this.add(this.id, this.theme);
          this.updated();
        } catch (error) {
          console.error("Ошибка:", error);
        }
      }
    },
    updated: function () {
      this.theme = "";
    },
    add: function (id, theme) {
      const $theme = document.querySelector("#theme");
      const $themeAdd = `<div class="col-md-6">
            <a href="theme/${id}">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">${theme}</h5>
                    </div>
                </div>
            </a>
        </div>`;
      $theme.insertAdjacentHTML("afterbegin", $themeAdd);
    },
  },
};
</script>
