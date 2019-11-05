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
                      <label for="raws">Selected Raw</label>
                      <select class="form-control" id="raws">
                        <option>Pork</option>
                        <option>Chicken</option>
                        <option>Beef</option>
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
                <tr>
                  <td colspan="5" class="bg-dark">
                    <div class="form-group ">
                      <label for="raws">Select Products of Chicken</label>
                      <select class="form-control" id="raws">
                        <option>Chicken 80 Grams</option>
                        <option>Chicken 40 Grams</option>
                        <option>Chicken 1 Kilo</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Sub-Total</strong>
                  </td>
                  <td></td>
                  <td></td>
                  <td class="text-right">255,90 €</td>
                  <td></td>
                </tr>

                <tr>
                  <td>
                    <strong>Scrap</strong>
                  </td>
                  <td></td>
                  <td></td>

                  <td class="text-right">6,90 €</td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <strong>Bones</strong>
                  </td>
                  <td></td>
                  <td></td>

                  <td class="text-right">6,90 €</td>
                  <td></td>
                </tr>
                <tr>
                  <td>
                    <strong>Total</strong>
                  </td>
                  <td></td>
                  <td></td>
                  <td class="text-right">
                    <strong>346,90 €</strong>
                  </td>
                  <td></td>
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