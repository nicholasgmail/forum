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
        <div v-if="err_theme && result.errors" class="text-danger">
          <ul>
            <li v-for="error in result.errors.name" :key="error">
              {{ error }}
            </li>
          </ul>
        </div>
      </div>
      <div class="mb-3">
        <label for="themeTextarea" class="form-label">Theme text</label>
        <textarea
          class="form-control"
          v-model="text"
          id="themeTextarea"
          rows="3"
        ></textarea>
        <div v-if="err_text && result.errors" class="text-danger">
          <ul>
            <li v-for="error in result.errors.text" :key="error">
              {{ error }}
            </li>
          </ul>
        </div>
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
      text: "",
      err_theme: false,
      err_text: false,
      data_json: [],
      result: [],
    };
  },
  mounted() {},
  methods: {
    addName: async function () {
      this.data_json = {
        name: this.theme,
        text: this.text,
      };
      try {
        const response = await fetch("/set_theme", {
          method: "POST",
          body: JSON.stringify(this.data_json),
          headers: {
            "Content-Type": "application/json",
          },
        });
        this.result = [];
        this.result = await response.json();
        this.result.errors && this.result.errors.name
          ? (this.err_theme = true)
          : "";
        this.result.errors && this.result.errors.text
          ? (this.err_text = true)
          : "";
        if (this.result.id) {
          this.add(this.result.id, this.theme, this.text);
          this.updated();
        }
        return false;
      } catch (error) {
        console.error("Ошибка:", error);
      }
    },
    updated: function () {
      this.theme = "";
      this.text = "";
      this.err_text = false;
      this.err_theme = false;
    },
    add: function (id, theme, text) {
      const $theme = document.querySelector("#theme");
      const $themeAdd = `<div class="col-md-6">
            <a href="theme/${id}">
                <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">${theme}</h5>
                        <p class="font-monospace text-truncate" style="max-width: 200px;">
                            ${text}
                        </p>
                    </div>
                </div>
            </a>
        </div>`;
      $theme.insertAdjacentHTML("afterbegin", $themeAdd);
    },
  },
};
</script>
