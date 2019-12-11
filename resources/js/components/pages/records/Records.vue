<template>
  <div class="container">
    <!-- <button @click="trigger()">Trigger Puhser</button> -->
    <vc-records-table :baseUrl="baseurl"></vc-records-table>
    <modal-delete-record></modal-delete-record>
    <modal-update-record></modal-update-record>
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
  }
};
</script>

