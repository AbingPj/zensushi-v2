<template>
  <div class="container">
    <div class="row">
      <vc-items-table :baseUrl="baseurl"></vc-items-table>
    </div>
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

