<template>
  <div>
    <div class="modal fade" id="itemRawOutModal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Set Value</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body" style="padding: 30px">
            <!-- <div class="form-group">
                <label for="date">Date</label>
                <input
                  :class="dateIsValid? '': 'is-invalid'"
                  type="date"
                  class="form-control"
                  id="date"
                  v-model="date"
                />
            </div>-->

            <div class="form-group">
              <label>
                <strong>Item</strong>
              </label>
              <div class="input-group">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text" style="width:80px;"><strong>Item :</strong></span>
                </div>-->
                <input type="text" class="form-control" :value="item.desc" disabled />
              </div>
              <br>
              <label>
                <strong>Balance</strong>
              </label>
              <div class="input-group">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text" style="width:80px;"><strong>Balance :</strong></span>
                </div>-->
                <input
                  type="text"
                  class="form-control"
                  :class="outStockIsValid? '': 'is-invalid'"
                  :value="item.balance"
                  disabled
                />
                <div class="input-group-append">
                  <span class="input-group-text">{{ item.unit }}</span>
                </div>
              </div>
              <br>
              <label>
                <strong>Raw Out Value</strong>
              </label>
              <div class="input-group">
                <!-- <div class="input-group-prepend">
                  <span class="input-group-text" style="width:80px;" ><strong>Out :</strong></span>
                </div>-->
                <input
                  :class="outStockIsValid? '': 'is-invalid'"
                  type="number"
                  class="form-control"
                  placeholder="0"
                  v-model="outStock"
                />

                <div class="input-group-append">
                  <span class="input-group-text">{{ item.unit }}</span>
                </div>
                <div
                  class="invalid-feedback"
                >Raw Out value must not be greater than Raw remaining balance or Raw remaining balance must not be zero.</div>
              </div>
              <small>set stock-out value for raw</small>

              <br />
                <br />
              <div class="text-center">
                <button @click="stockOut()" class="btn btn-info"><i class="far fa-check-square"></i> Set Raw Out Value</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      item: {},
      outStock: null,
      outStockIsValid: true,
      link: ""
    };
  },
  methods: {
    stockOut() {
      this.outStock == null ||
      this.outStock == undefined ||
      this.outStock <= 0 ||
      this.outStock == ""
        ? (this.outStockIsValid = false)
        : this.setRawOut();
    },
    setRawOut() {
      if (this.item.balance == 0 || this.outStock > this.item.balance) {
        this.outStockIsValid = false;
      } else {
        this.$parent.rawOut = this.outStock;
         this.outStockIsValid = true;
         $("#itemRawOutModal2").modal("hide");
      }
    }
  },

  mounted() {
    let self = this;
    // $("#itemRawOutModal").on("hidden.bs.modal", function() {
    //   // self.outStockIsValid = true;
    //   self.outStockIsValid = true;
    // });
  },
  events: {
    showItemRawOutModal2(data) {
      this.item = data;
      //  this.link = link;
      $("#itemRawOutModal2").modal("show");
      LoadingOverlayHide();
    }
  }
};
</script>
