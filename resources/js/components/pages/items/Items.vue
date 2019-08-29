<template>
  <div class="container">
    <button @click="trigger()">Trigger Puhser</button>
    <vc-items-table :baseUrl="baseurl"></vc-items-table>
    <vc-items-choose-itemtype-modal></vc-items-choose-itemtype-modal>
    <vc-items-delete-modal></vc-items-delete-modal>
    <vc-items-update-modal></vc-items-update-modal>
  </div>
</template>

<script>
export default {
  props: {
    baseurl: String
  },
  methods: {
    trigger() {
      axios.post("/triggerPusher").then(function(response) {
        // handle success
        // console.log(response);
      });
    }
  },

  mounted() {
    Echo.channel("my-channel").listen("my-event", data => {
      console.log("Shitt" + data);
      // console.log(JSON.stringify(data));
    });
  },

  //   var channel = pusher.subscribe('my-channel');
  //   channel.bind('my-event', function(data) {
  //     alert(JSON.stringify(data));
  //   });

  created() {
    Echo.channel("ItemsChannel").listen("ItemsEvent", data => {
      console.log("Hai!!" + data);
      // console.log(JSON.stringify(data));
    });
  }
};
</script>

