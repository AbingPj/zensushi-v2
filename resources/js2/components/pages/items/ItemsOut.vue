<template>
  <div>
    <div class="modal fade" id="itemOutModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Item Stock-out</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="date">Date</label>
                <input
                  :class="dateIsValid? '': 'is-invalid'"
                  type="date"
                  class="form-control"
                  id="date"
                  v-model="date"
                />
              </div>

              <div class="form-group">
                <label for="title">Stock-out: {{ item.description }}</label>
                <div class="input-group">
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
                </div>

                <!-- <label for="validationCustomUsername">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    id="validationCustomUsername"
                    placeholder="Username"
                    aria-describedby="inputGroupPrepend"
                    required
                  />
                  <div class="invalid-feedback">Please choose a username.</div>
                </div>-->

                <br />
                <div class="text-center">
                  <button @click="stockOut()" class="btn btn-info">Stock-Out</button>
                </div>
              </div>
            </form>
            <!-- <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal">IN</button>
            </div>-->
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
      date: null,
      dateIsValid: true,
      outStockIsValid: true
    };
  },
  methods: {
    stockOut() {
      if (
        this.date == null ||
        this.date == undefined ||
        this.date == "" ||
        this.outStock == null ||
        this.outStock == undefined ||
        this.outStock <= 0 ||
        this.outStock == ""
      ) {
        this.date == null || this.date == undefined || this.date == ""
          ? (this.dateIsValid = false)
          : (this.dateIsValid = true);

        this.outStock == null ||
        this.outStock == undefined ||
        this.outStock <= 0 ||
        this.outStock == ""
          ? (this.outStockIsValid = false)
          : (this.outStockIsValid = true);
      } else {
        this.dateIsValid = true;
        this.outStockIsValid = true;
        this.axiosPost();
      }
    },

    axiosPost() {
      if (this.item.balance == 0 || this.outStock > this.item.balance) {
        alert("Item balance must not be zero or item out value must not be greater than item balance.")
      } else {
        LoadingOverlay();
        axios
          .post("/items/stockout", {
            itemId: this.item.id,
            value: this.outStock,
            date: this.date
          })
          .then(res => {
            $("#itemOutModal").modal("hide");
          })
          .catch(err => {
            alert(
              "This function have an error, please contact the zensushi developer. \n" +
                "Error: [" +
                err.message +
                " \n " +
                err.response.data.message +
                "]"
            );
            LoadingOverlayHide();
          });
      }
    }
  },

  created() {
    this.$events.listen(
      "showItemOutModal",
      data => ($("#itemOutModal").modal("show"), (this.item = data))
    );
  },

  mounted() {
    let self = this;
    $("#itemOutModal").on("hidden.bs.modal", function() {
      //  window.clearTimeout(timer);
      self.dateIsValid = true;
      self.outStockIsValid = true;
      self.outStock = null;
      self.date = null;
    });
  }
  // mounted() {
  //   $("#itemOutModal").on("show.bs.modal	", function(e) {
  //     this.outStock = 0;
  //   });
  // }
};
</script>