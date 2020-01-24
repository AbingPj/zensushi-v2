<template>
   <div class="container">
      <div class="row">
         <div class="col-md-5">
            <h3>Select Products</h3>
            <small>Select product to make request delivery list</small>
            <div class="input-group mb-3">
               <input
                  v-model="search_product"
                  type="text"
                  class="form-control"
                  placeholder="Searh Products here"
               />
               <div class="input-group-append">
                  <button class="btn btn-primary" type="button" @click="search()">Search</button>
               </div>
            </div>
            <table class="table table-striped">
               <thead>
                  <th>Item id</th>
                  <th>Item Name</th>
                  <th>Remaing Qty</th>
                  <th>Select</th>
               </thead>
               <tbody>
                  <tr v-for="product in products" :key="product.id">
                     <td>{{product.id}}</td>
                     <td>{{product.description}}</td>
                     <td>{{product.balance}} {{product.unit_desc}}</td>
                     <td>
                        <button class="btn btn-success btn-sm">Select</button>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>

         <div class="col-md-7">
            <h3 class="text-center">Delivery Reqquest Form</h3>
         </div>
      </div>
   </div>
</template>

<script>
export default {
   props: {},
   data() {
      return {
         search_product: "",
         products: []
      };
   },
   methods: {
      async getProducts() {
         let { data, status } = await axios.get("/items/delivery/products");
         if (data && status == 200) {
            this.products = data;
         } else {
            alert("Something went wrong! Please try again.");
         }
      },
      async search(){
         let { data, status } = await axios.get("/items/delivery/products/"+this.search_product);
         if (data && status == 200) {
            this.products = data;
         } else {
            alert("Something went wrong! Please try again.");
         }
      }
   },
   mounted() {
      this.getProducts();
   }
};
</script>