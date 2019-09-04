<template>
  <div class="container">
    <!-- <button @click="trigger()">Trigger Puhser</button> -->
    <vc-items-table ref="itemsVuetable" :baseUrl="baseurl"></vc-items-table>
    <vc-items-choose-itemtype-modal></vc-items-choose-itemtype-modal>
    <vc-items-delete-modal></vc-items-delete-modal>
    <vc-items-update-modal></vc-items-update-modal>
    <vc-items-in-modal></vc-items-in-modal>
  </div>
</template>

<script>
export default {
  props: {
    baseurl: String
  },
  methods: {
    // trigger() {
    //   axios.post("/triggerPusher");
    // }
  },

  mounted() {
    Echo.channel("ItemsChannel").listen("ItemsEvent", data => {
      this.$refs.itemsVuetable.refreshVueTable();
    });
  }
};
</script>

