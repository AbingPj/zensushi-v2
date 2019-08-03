<template>
  <div class="container">
    <vc-items-table :baseUrl="baseurl"></vc-items-table>
    <vc-items-choose-itemtype-modal></vc-items-choose-itemtype-modal>
  </div>
</template>

<script>
export default {
  props: {
    baseurl: String
  },
  mounted() {
    console.log(this.baseurl);
  }
};
</script>

