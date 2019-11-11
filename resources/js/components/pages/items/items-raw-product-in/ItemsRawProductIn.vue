<template>
  <div>
    <h1>Stockin Raw Products</h1>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">
                    <div class="form-group">
                      <label for>Selected Raw</label>
                      <select v-model="selectedRaw" class="form-control" disabled>
                        <option
                          v-for="raw in raws"
                          :value="raw"
                          :key="raw.id"
                        >{{ raw.item.description }}</option>
                      </select>
                    </div>
                  </th>
                  <th scope="col">
                    <div class="form-group">
                      <label for="out">Raw Stock-out Weight</label>
                      <input type="number" class="form-control" id="stock-out" />
                    </div>
                  </th>
                  <th colspan="5"></th>
                </tr>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">Product</th>
                  <th scope="col" style="width: 150px;" class="text-center">Quantity</th>
                  <th scope="col"></th>
                  <th scope="col" style="width: 200px;" class="text-center">Weight</th>
                  <th scope="col" class="text-right">Total Weight</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in selectedProducts" :key="product.id">
                  <td>{{product.item.id}}</td>
                  <td>{{product.item.description}}</td>
                  <td class="text-center">
                    <!-- <input class="form-control" type="text" value="1" /> -->
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
                        <span class="input-group-text">{{product.unit.description}}</span>
                      </div>
                    </div>
                  </td>
                  <td class="text-center">X</td>
                  <td class="text-center">{{product.value}}g</td>
                  <td class="text-right">{{product.total_weight}}g</td>
                  <td class="text-right">
                    <button class="btn btn-sm btn-danger" @click="removeSelection(product)">
                      <i class="fa fa-eraser" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

                <!-- Choose Products -->
                <tr style="background-color:#d9d9d9;">
                  <td colspan="7">
                    <div style="padding: 0px 200px 0px 200px;" class="form-group">
                      <label for="raws" class="text-dark">
                        <strong>Select Products of Chicken</strong>
                      </label>
                      <div class="input-group mb-3">
                        <select v-model="selectedProduct" class="form-control">
                          <option disabled :value="null">Please select product</option>
                          <option
                            v-for="prod in newProducts"
                            :value="prod"
                            :key="prod.id"
                          >{{ prod.item.description }}</option>
                        </select>
                        <div class="input-group-append">
                          <button
                            @click="btnSelectProduct()"
                            class="btn btn-primary"
                            style="width: 200px;"
                            type="button "
                          >Select</button>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- Subtotal -->
                <tr>
                  <td>
                    <strong>Sub-Total</strong>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-right">{{totalWieghtOfSelectedProduct}}g</td>
                  <td></td>
                </tr>

                <!-- Scrap -->
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                    <div class="form-inline">
                      <label for="scrap" class="mr-sm-2">
                        <b>Scrap:</b>
                      </label>
                      <input
                        type="text"
                        maxlength="10"
                        class="form-control"
                        style="width: 100px;"
                        v-model="scrap"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))"
                      />
                    </div>
                  </td>

                  <td class="text-right">{{scrap == ""? 0 : scrap }}g</td>
                  <td></td>
                </tr>
                <!-- BOnes -->
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-center">
                    <div class="form-inline">
                      <label for="scrap" class="mr-sm-2">
                        <b>Bones:</b>
                      </label>
                      <input
                        type="text"
                        maxlength="10"
                        class="form-control"
                        style="width: 100px;"
                        v-model="bones"
                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))"
                      />
                    </div>
                  </td>

                  <td class="text-right">{{bones == ""? 0 : bones}}g</td>
                  <td></td>
                </tr>
                <!-- TOTAl -->
                <tr>
                  <td>
                    <strong>Total</strong>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="text-right">
                    <strong>{{finalWeight}}</strong>
                  </td>
                  <td>Grams</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col mb-2">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <!-- <button class="btn btn-block btn-light">Back to Items</button> -->
            </div>
            <div class="col-sm-12 col-md-6 text-right">
              <button
                @click="sendSelelectedProducts()"
                class="btn btn-lg btn-block btn-success text-uppercase"
              >Stock-in</button>
            </div>
          </div>
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
      raws: [],
      products: [],
      selectedRaw: null,
      selectedRawOut: 0,
      selectedProduct: null,
      scrap: 0,
      bones: 0
      // selectedProducts: []
    };
  },
  computed: {
    newProducts() {
      return this.products.filter(obj => {
        if (obj.selected == false) {
          return obj;
        }
      });
    },
    selectedProducts() {
      return this.products.filter(obj => {
        if (obj.selected == true) {
          obj.total_weight = obj.quantity * obj.value;
          return obj;
        }
      });
    },
    totalWieghtOfSelectedProduct() {
      let selectedProducts = this.products.filter(obj => {
        if (obj.selected == true) {
          return obj;
        }
      });

      if (selectedProducts === undefined || selectedProducts.length == 0) {
        return 0;
      } else {
        let sum = selectedProducts
          .map(obj => obj.total_weight)
          .reduce((a, c) => {
            return a + c;
          });
        return sum;
      }
    },
    finalWeight() {
      let scrap = this.scrap;
      scrap == "" ? (scrap = 0) : (scrap = parseFloat(scrap));
      let bones = this.bones;
      bones == "" ? (bones = 0) : (bones = parseFloat(bones));

      return scrap + bones + parseFloat(this.totalWieghtOfSelectedProduct);
    }
  },
  methods: {
    sendSelelectedProducts() {
      let params = {
        selected_products: this.selectedProducts,
        bones: this.bones,
        scrap: this.scrap,
        total: this.finalWeight,
        selected_raw: this.selectedRaw,
        selected_raw_out: this.selectedRawOut
      };

      axios
        .post("/products/in", params)
        .then(res => {
          console.log(res);
        })
        .catch(err => {
          console.error(err);
        });
    },
    getRaws() {
      axios.get("/items/raw").then(res => {
        // console.log(res);
        this.raws = res.data;
      });
    },
    getProducts() {
      axios.get("/items/products").then(res => {
        // this.products = { ...res.data };
        this.products = res.data;
        // this.products.map(obj => {
        //   obj.selected = false;
        //   return obj;
        // });
      });
    },
    btnSelectProduct() {
      //this.selectedProducts.push(this.selectedProduct);
      //let selected = this.selectedProduct;
      this.products.map(obj => {
        if (obj.id == this.selectedProduct.id) {
          // return (obj.selected = true);
          obj.selected = true;
          return obj;
        }
      });
      this.selectedProduct = null;
    },
    removeSelection(data) {
      this.products.map(obj => {
        if (obj.id == data.id) {
          obj.selected = false;
          obj.quantity = 1;
          obj.total_weight = obj.value;
          return obj;
        }
      });
    }
  },

  mounted() {
    console.log(this.newProducts);
    this.getRaws();
    this.getProducts();
  }
};
</script>