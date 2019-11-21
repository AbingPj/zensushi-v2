<template>
  <div>
    <div class="modal fade" id="itemInModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Item Stock-in</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="form-group">
              <label for="date">Date</label>
              <input
                :class="dateIsValid? '' : 'is-invalid'"
                type="date"
                class="form-control"
                id="date"
                v-model="date"
              />
            </div>

            <div class="form-group">
              <label for="title">Stock-in: {{ item.description }}</label>
              <div class="input-group">
                <input
                  :class="inStockIsValid? '' : 'is-invalid'"
                  type="number"
                  class="form-control"
                  placeholder="0"
                  v-model="inStock"
                />
                <div class="input-group-append">
                  <span class="input-group-text">{{ item.unit }}</span>
                </div>
              </div>

              <br />
              <div class="text-center">
                <button @click="stockIn()" class="btn btn-info">Stock-IN</button>
              </div>
            </div>
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
      inStock: null,
      date: null,
      dateIsValid: true,
      inStockIsValid: true
    };
  },
  methods: {
    stockIn() {
      // validation
      if (
        this.date == null ||
        this.date == undefined ||
        this.date == "" ||
        this.inStock == null ||
        this.inStock == undefined ||
        this.inStock <= 0 ||
        this.inStock == ""
      ) {
        this.date == null || this.date == undefined || this.date == ""
          ? (this.dateIsValid = false)
          : (this.dateIsValid = true);

        this.inStock == null ||
        this.inStock == undefined ||
        this.inStock <= 0 ||
        this.inStock == ""
          ? (this.inStockIsValid = false)
          : (this.inStockIsValid = true);
      } else {
        this.dateIsValid = true;
        this.inStockIsValid = true;
        this.axiosPost();
      }
    },
    axiosPost() {
      LoadingOverlay();
      axios
        .post("/items/stockin", {
          itemId: this.item.id,
          value: this.inStock,
          date: this.date
        })
        .then(res => {
          $("#itemInModal").modal("hide");
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
  },

  created() {
    this.$events.listen(
      "showItemInModal",
      data => ($("#itemInModal").modal("show"), (this.item = data))
    );
  },
  mounted() {
    let self = this;
    $("#itemInModal").on("hidden.bs.modal", function() {
      //  window.clearTimeout(timer);
      self.dateIsValid = true;
      self.inStockIsValid = true;
      self.inStock = null;
      self.date = null;
    });
  }

  // mounted() {
  //   $("#itemInModal").on("show.bs.modal	", function(e) {
  //     this.inStock = 0;
  //   });
  // }
};
</script>