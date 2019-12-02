<template>
  <div>
    <h1 class="text-center mb-5 mt-5">Production</h1>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr style=" border-bottom: 4px solid gray; border-top: 4px solid black;">
                  <th colspan="7">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="date">Date</label>
                          <input
                            type="date"
                            class="form-control"
                            :class=" dateIsValid? '' : 'is-invalid'"
                            id="date"
                            v-model="date"
                          />
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for>Selected Raw</label>
                          <select
                            v-model="selectedRaw"
                            class="form-control"
                            @change="rawSelectionChange()"
                          >
                            <option disabled :value="null">Please select raw</option>
                            <option
                              v-for="raw in raws"
                              :value="raw"
                              :key="raw.id"
                            >{{ raw.item.description }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="out">Balance</label>
                          <div class="input-group">
                            <input
                              type="number"
                              class="form-control"
                              :value=" selectedRaw == null? '' : selectedRaw.balance"
                              disabled
                            />
                              
                            <div class="input-group-append">
                              <span class="input-group-text">{{ selectedRaw == null? '' : selectedRaw.unit.description }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="out">Raw Stock-out Weight</label>
                          <!-- <input type="number" class="form-control" id="stock-out" /> -->
                          <div class="input-group">
                            <input
                              type="number"
                              class="form-control"
                            />
                            <div class="input-group-append">
                              <span class="input-group-text">{{ selectedRaw == null? '' : selectedRaw.unit.description }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </th>
                </tr>
                <tr>
                  <th scope="col" style="width: 90px;">id</th>
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
                <tr v-if="notSelectedProductsLength !== 0" style="background-color:#d9d9d9;">
                  <td colspan="7">
                    <div style="padding: 0px 200px 0px 200px;" class="form-group">
                      <!-- <label for="raws" class="text-dark">
                        <strong>Select Products of {{selectedRaw.description}}}</strong>
                      </label>-->
                      <div class="input-group mb-3 mt-3">
                        <select v-model="selectedProduct" class="form-control">
                          <option
                            disabled
                            :value="null"
                          >Select products of {{selectedRaw.item.description}}</option>
                          <option
                            v-for="prod in notSelectedProducts"
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
                <tr style="border-top: 3px solid gray;">
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
                <tr style="border-top: 4px solid black;">
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
  props: {
    item_id: String,
    item_raw_stock_out: String,
    product_item_id: String
  },
  data() {
    return {
      raws: [],
      products: [],
      selectedRaw: null,
      selectedRawOut: 0,
      selectedProduct: null,
      selectedProductsNew: [],
      scrap: 0,
      bones: 0,
      date: null,
      dateIsValid: true
      // selectedProducts: []
    };
  },
  computed: {
    notSelectedProducts() {
      return this.products.filter(obj => {
        if (obj.selected == false) {
          return obj;
        }
      });
    },

    notSelectedProductsLength() {
      return this.notSelectedProducts.length;
    },

    selectedProducts() {
      // return this.products.filter(obj => {
      //   if (obj.selected == true) {
      //     obj.total_weight = obj.quantity * obj.value;
      //     return obj;
      //   }
      // });
      if (this.selectedProductsNew !== null) {
        return this.selectedProductsNew.map(obj => {
          obj.total_weight = obj.quantity * obj.value;
          return obj;
        });
      }
    },

    // Select products of {{selectedRaw.item.description}}
    totalWieghtOfSelectedProduct() {
      if (
        this.selectedProducts === undefined ||
        this.selectedProducts.length == 0
      ) {
        return 0;
      } else {
        let sum = this.selectedProducts
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
    btnSelectProduct() {
      if (this.selectedProduct !== null) {
        this.products.map(obj => {
          if (obj.id == this.selectedProduct.id) {
            obj.selected = true;
            return obj;
          }
        });

        this.selectedProductsNew.push(this.selectedProduct);
        this.selectedProduct = null;
      }
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
      let index = this.selectedProductsNew.indexOf(data);
      if (index !== -1) this.selectedProductsNew.splice(index, 1);
    },

    ////////////////
    rawSelectionChange() {
      LoadingOverlay();
      window.location = "/zensushi-production/" + this.selectedRaw.item_id;
    },
    sendSelelectedProducts() {
      LoadingOverlay();
      let self = this;
      console.log(this.date);
      if (this.date == null || this.date == undefined || this.date == "") {
        console.log("date is required");
        this.dateIsValid = false;
        LoadingOverlayHide();
      } else {
        let params = {
          // selected_products: this.cleaningSelectedProducts(this.selectedProductsNew),
          selected_products: this.selectedProductsNew,
          bones: this.bones,
          scrap: this.scrap,
          total: this.finalWeight,
          selected_raw: this.selectedRaw,
          selected_raw_out_value: this.selectedRawOut,
          date: this.date
        };

        axios
          .post("/items/products/stockin", params)
          .then(res => {
            console.log(res);
            self.selectedProductsNew = [];
            self.products.map(obj => {
              obj.selected = false;
              obj.quantity = 1;
              obj.total_weight = obj.value;
              return obj;
            });
            self.scrap = 0;
            self.bones = 0;
            self.selectedRawOut = 0;
            LoadingOverlayHide();
          })
          .catch(err => {
            console.error(err);
            LoadingOverlayHide();
          });
      }
    },
    getRaws() {
      axios.get("/items/raw").then(res => {
        this.raws = res.data;
        this.setSelectedRaw();
      });
    },
    setSelectedRaw() {
      if (!this.item_id == "") {
        let raw = this.raws.find(obj => {
          if (obj.item_id == this.item_id) {
            return obj;
          }
        });

        if (raw == undefined) {
          this.selectedRaw = null;
          LoadingOverlayHide();
        } else {
          this.selectedRaw = raw;
          this.getProducts();
        }
      } else {
        this.selectedRaw = null;
        LoadingOverlayHide();
      }
    },
    getProducts() {
      // let url = "/items/products"
      if (!this.item_id == "") {
        let url = "/items/products/" + this.item_id;
        axios.get(url).then(res => {
          this.products = res.data;
          this.ifProductItemIdIsNotNull();
        });
      } else {
        LoadingOverlayHide();
      }
    },
    ifProductItemIdIsNotNull() {
      if (this.product_item_id !== "") {
        let prod = this.products.find(obj => {
          if (obj.item_id == this.product_item_id) {
            return obj;
          }
        });
        console.log({ prod });
        if (prod == undefined) {
          console.log({ prod });
          LoadingOverlayHide();
        } else {
          this.selectedProduct = prod;
          this.btnSelectProduct();
          setTimeout(() => {
            LoadingOverlayHide();
          }, 500);
        }
      } else {
        LoadingOverlayHide();
      }
    }
    // cleaningSelectedProducts(data) {
    //   return data.map(obj => {
    //     delete obj.selected;
    //     delete obj.unit;
    //     delete obj.item;
    //     delete obj.created_at;
    //     delete obj.updated_at;
    //     delete obj.remove;
    //     return obj;
    //   });
    // },
  },

  mounted() {
    LoadingOverlay();
    console.log("mounted");
    this.getRaws();
  },
  created() {
    console.log("created");
  }
};
</script>