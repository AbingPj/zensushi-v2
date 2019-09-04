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
                <input
                  type="number"
                  class="form-control"
                  aria-label="Amount (to the nearest dollar)"
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
      item: {}
    };
  },
  methods: {
    stockIn() {
      LoadingOverlay();
      setTimeout(() => {
        LoadingOverlayHide();
        $("#itemInModal").modal("hide");
      }, 2000);
    }
  },

  created() {
    this.$events.listen(
      "showItemInModal",
      data => ($("#itemInModal").modal("show"), (this.item = data))
    );
  }
};
</script>