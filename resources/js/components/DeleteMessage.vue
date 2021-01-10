
<template>
  <form class="float-end" role="form" @submit.prevent="deleteMessag">
    <button type="button" class="btn btn-link">delete</button>
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
    deleteMessag: async function () {
      try {
        const response = await fetch("/delete_messag?id=" + this.id, {
          method: "GET",
          headers: {
            "Content-Type": "text/plain",
            charset: "utf-8",
          },
        });
        this.result = await response.json();
      } catch (error) {
        console.error("Ошибка:", error);
      }
    },
  },
};
</script>
