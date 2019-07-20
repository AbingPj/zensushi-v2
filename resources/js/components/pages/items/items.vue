<template>
  <div class="container">
      <vc-items-table :baseUrl="baseurl"></vc-items-table>
  </div>
</template>

<script>
export default {
    props: {
        baseurl: String
    },
    mounted() {
        console.log(this.baseurl);
    },
}
</script>

