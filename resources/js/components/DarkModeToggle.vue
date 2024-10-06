<template>
  <div>
    <div @click="toggleDarkMode">
      {{ isDarkMode ? "Modo Claro" : "Modo Oscuro" }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isDarkMode: false,
    };
  },
  mounted() {
    this.isDarkMode = localStorage.getItem("darkMode") === "true";
    if (this.isDarkMode) {
      document.documentElement.classList.add("dark");
    }
  },
  methods: {
    toggleDarkMode() {
      this.isDarkMode = !this.isDarkMode;
      localStorage.setItem("darkMode", this.isDarkMode);
      document.documentElement.classList.toggle("dark", this.isDarkMode);
    },
  },
};
</script>

<style scoped>
button {
  padding: 10px;
  background-color: #333;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}
</style>
