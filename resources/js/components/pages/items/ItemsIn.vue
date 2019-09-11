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
              <label for="title">Stock-in: {{ item.description }}</label>
              <div class="input-group">
                <input type="number" class="form-control" placeholder="0" v-model="inStock" />
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
      inStock: null
    };
  },
  methods: {
    stockIn() {
      LoadingOverlay();
      axios
        .post("/items/stockin", {
          itemId: this.item.id,
          value: this.inStock
        })
        .then(res => {
          setTimeout(() => {
            LoadingOverlayHide();
            $("#itemInModal").modal("hide");
          }, 2000);
        })
        .catch(err => {
          setTimeout(() => {
            LoadingOverlayHide();
            $("#itemInModal").modal("hide");
          }, 2000);
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
    $("#itemInModal").on("show.bs.modal	", function(e) {
      console.log("shit");
      this.inStock = 0;
    });
  }
};
</script>