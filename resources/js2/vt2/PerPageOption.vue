<template>
  <div class="form-inline">
    <div class="form-group">
      <label>Show &nbsp;</label>
      <select v-model="perPage" @change="onChangePerPage()" class="form-control form-control-sm">
        <option
          v-for="(perPage, index) in perPageOption"
          :key="index"
          :value="perPage"
        >{{ perPage }}</option>
      </select>
      <!-- <input class="form-control" v-model="perPage" /> -->
      <label>&nbsp; entries</label>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propPerPage: Number
  },
  created() {
    this.perPage = this.propPerPage;
  },
  data() {
    return {
      perPageOption: [1, 5, 10, 25, 50, 100],
      perPage: 0
    };
  },
  methods: {
    onChangePerPage() {
      this.$emit("perPageNumber", this.perPage);
    }
  }
};
</script>