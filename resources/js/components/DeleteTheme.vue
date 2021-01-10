
<template>
  <form class="float-end" role="form" @submit.prevent="deleteTheme">
    <button type='submit' class="btn btn-warning">delete</button>
  </form>
</template>

<script>
export default {
  data: function () {
    return {
      result: [],
    };
  },
  props: {
    id: Number,
  },
  mounted() {},
  methods: {
    deleteTheme: async function () {
      try {
        const response = await fetch("/delete_theme/" + this.id, {
          method: "GET",
          headers: {
            "Content-Type": "text/plain",
            "charset": "utf-8",
          },
        });
        this.result = await response.json();
        const $message = document.querySelector(`#card_theme_${this.id}`)
        $message.remove();
      } catch (error) {
        console.error("Ошибка:", error);
      }
    },
  },
};
</script>
