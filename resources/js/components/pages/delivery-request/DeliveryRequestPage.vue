<template>
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <h3>Select Products</h3>
            <small>Select product for request delivery list</small>
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
            <table class="table">
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
                        <button
                           class="btn btn-success btn-sm"
                           @click="selectProduct(product)"
                        >Select</button>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>

         <div class="col-md-8">
            <h3 class="text-center">Delivery Reqquest List Form</h3>
            <table class="table table-striped">
               <thead>
                  <th>Item id</th>
                  <th>Item Name</th>
                  <th style="width: 150px;">Quantity</th>
                  <th></th>
               </thead>
               <tbody>
                  <tr v-for="product in selectedProducts " :key="product.id">
                     <td>{{product.id}}</td>
                     <td>{{product.description}}</td>
                     <td>
                        <div class="input-group input-group-sm">
                           <input
                              type="number"
                              style="text-align:center;"
                              class="form-control"
                              v-model="product.quantity"
                              min="1"
                              max="100"
                              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                           />
                           <!-- :value="product.quantity" -->
                           <div class="input-group-append">
                              <span class="input-group-text">{{product.unit_desc}}</span>
                           </div>
                        </div>
                     </td>
                     <td>
                        <button class="btn btn-danger" @click="deleteProduct(product)">
                           <i class="fa fa-eraser" aria-hidden="true"></i>
                        </button>
                     </td>
                  </tr>
               </tbody>
            </table>

            <div style="padding: 0px 50px 0px 50px ">
               <label for="branch" class="mr-sm-2">Branch:</label>
               <input
                  v-model="branch"
                  type="text"
                  class="form-control"
                  placeholder="Enter Branch Name"
                  id="branch"
               />
               <br />
               <button class="btn btn-primary btn-block" @click="submit()">Submit</button>
            </div>
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
         products: [],
         selectedProducts: [],
         branch: ""
      };
   },

   computed: {
      computedProducts() {
         let newProducts = this.products;
         console.log(newProducts);

         if (this.selectedProducts.length !== 0) {
            let newSelectedProducts = this.selectedProducts;
            newSelectedProducts.forEach(selected => {
               console.log(selected.id);

               this.newProducts.forEach(notselected => {
                  console.log(notselected.id);
               });
            });

            return newProducts;
         } else {
            return newProducts;
         }

         // if (this.selectedProductsNew !== null) {
         //    return this.selectedProductsNew.map(obj => {
         //       obj.total_weight = obj.quantity * obj.value;
         //       return obj;
         //    });
         // }
      }
   },

   methods: {
      submit() {
         LoadingOverlay();

         let params = {
            branch: this.branch,
            products: this.products
         };
         axios
            .post("/items/delivery/send-delivery-request", {
               branch: this.branch,
               products: this.products
            })
            .then(res => {
               console.log(res);
               this.branch = "";
               this.selectedProducts = [];
               LoadingOverlayHide();
            })
            .catch(err => {
               console.error(err);
            });
      },

      selectProduct(data) {
         let y = this.selectedProducts.find(list => list.id == data.id);
         if (y == undefined) {
            data.quantity = 1;
            this.selectedProducts.push(data);
         }
      },
      deleteProduct(data) {
         // let newList = this.selectedProducts.filter(
         //    list => list.id != data.id
         // );

         let newList = this.selectedProducts.filter(function(list) {
            return list.id != data.id;
         });
         this.selectedProducts = newList;
      },

      async getProducts() {
         let { data, status } = await axios.get("/items/delivery/products");
         if (data && status == 200) {
            this.products = data;
         } else {
            alert("Something went wrong! Please try again.");
         }
      },
      async search() {
         let { data, status } = await axios.get(
            "/items/delivery/products/" + this.search_product
         );
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