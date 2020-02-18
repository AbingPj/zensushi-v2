<template>
   <div>
      <i class="fa fa-bell" aria-hidden="true">
         <span :class="unseen != 0? '' : 'd-none' " class="badge badge-danger">{{unseen}}</span>
      </i>
   </div>
</template>
<script>
export default {
   data() {
      return {
         unseen: 0
      };
   },
   created() {
     this.getNotifCounts();
   },
   methods: {
      getNotifCounts() {
         axios
            .get("/notification/unseen")
            .then(res => {
               console.log(res);
               this.unseen = res.data;
            })
            .catch(err => {
               console.error(err);
            });
      }
   },

   mounted() {
      Echo.channel("NotificationChannel").listen("NotificationEvent", data => {
         console.log(data);
          this.getNotifCounts();
      });
   }
};
</script>