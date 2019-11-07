<template>
  <div>
    <h1>Stockin Raw Products</h1>
    <div class="container mb-4">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">
                    <div class="form-group">
                      <!-- <label for="raws">Selected Raw</label>
                      <select class="form-control" id="raws">
                        <option>Pork</option>
                        <option>Chicken</option>
                        <option>Beef</option>
                      </select>-->
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
                  <th scope="col" class="text-center"></th>
                  <th scope="col" class="text-right"></th>
                  <th></th>
                </tr>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Weight</th>
                  <th scope="col" class="text-center">Quantity</th>
                  <th scope="col" class="text-right">Total Weight</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td>
                    <img src="https://dummyimage.com/50x50/55595c/fff" />
                  </td>
                  <td>Product Name Dada</td>
                  <td>In stock</td>
                  <td>
                    <input class="form-control" type="text" value="1" />
                  </td>
                  <td class="text-right">124,90 €</td>
                  <td class="text-right">
                    <button class="btn btn-sm btn-danger">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>-->

                <tr>
                  <td>Product Name Titi</td>
                  <td>In stock</td>
                  <td>
                    <input class="form-control" type="text" value="1" />
                  </td>
                  <td class="text-right">70,00 €</td>
                  <td class="text-right">
                    <button class="btn btn-sm btn-danger">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>

                <!-- Choose Products -->
                <tr class="bg-secondary">
                  <td></td>
                  <td colspan="3">
                    <div class="form-group">
                      <label for="raws" class="text-light">
                        <strong>Select Products of Chicken</strong>
                      </label>
                      <div class="form-inline">
                        <!-- <select class="form-control" style="width:80%;" id="raws">
                          <option>Chicken 80 Grams</option>
                          <option>Chicken 40 Grams</option>
                          <option>Chicken 1 Kilo</option>
                        </select> -->
                        <select v-model="selectedProduct" class="form-control" style="width:80%;">
                          <option disabled :value=null >Please select product</option>
                          <option
                            v-for="prod in products"
                            :value="prod"
                            :key="prod.id"
                          >{{ prod.item.description }}</option>
                        </select>
                        <button class="btn btn-primary" style="width:20%;">Select</button>
                      </div>
                    </div>
                  </td>
                  <td></td>
                </tr>

                <!-- Subtotal -->
                <tr>
                  <td>
                    <strong>Sub-Total</strong>
                  </td>
                  <td></td>
                  <td></td>
                  <td class="text-right">255,90 €</td>
                  <td></td>
                </tr>
                <!-- Scrap -->
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="form-inline pull-right">
                      <label for="scrap" class="mr-sm-2">
                        <b>Scrap:</b>
                      </label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="scrap" />
                    </div>
                  </td>

                  <td class="text-right">6,90</td>
                  <td>Grams</td>
                </tr>
                <!-- BOnes -->
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <div class="form-inline pull-right">
                      <label for="scrap" class="mr-sm-2">
                        <b>Bones:</b>
                      </label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="scrap" />
                    </div>
                  </td>
                  <td class="text-right">123</td>
                  <td>Grams</td>
                </tr>
                <!-- TOTAl -->
                <tr>
                  <td>
                    <strong>Total</strong>
                  </td>
                  <td></td>
                  <td></td>
                  <td class="text-right">
                    <strong>346,90</strong>
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
              <button class="btn btn-lg btn-block btn-success text-uppercase">Stock-in</button>
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
      selectedProduct:  null,
    };
  },
  methods: {
    getRaws() {
      axios.get("/items/raw").then(res => {
        console.log(res);
        this.raws = res.data;
      });
    },
    getProducts() {
      axios.get("/items/products").then(res => {
        console.log(res);
        this.products = res.data;
      });
    }
  },
  mounted() {
    this.getRaws();
    this.getProducts();
  }
};
</script>