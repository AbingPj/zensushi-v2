<template>
  <div>
    <div class="modal fade" id="itemAdditionalModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Item Additional</h4>
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
              <label for="title">Additional: {{ item.description }}</label>
              <div class="input-group">
                <input
                  :class="additionalIsValid? '' : 'is-invalid'"
                  type="number"
                  class="form-control"
                  placeholder="0"
                  v-model="additional"
                />
                <div class="input-group-append">
                  <span class="input-group-text">{{ item.unit.description }}</span>
                </div>
              </div>

              <br />
              <div class="text-center">
                <button @click="additionalItem()" class="btn btn-info">Additional</button>
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
      additional: null,
      date: null,
      dateIsValid: true,
      additionalIsValid: true
    };
  },
  methods: {
    additionalItem() {
      // validation
      if (
        this.date == null ||
        this.date == undefined ||
        this.date == "" ||
        this.additional == null ||
        this.additional == undefined ||
        this.additional <= 0 ||
        this.additional == ""
      ) {
        this.date == null || this.date == undefined || this.date == ""
          ? (this.dateIsValid = false)
          : (this.dateIsValid = true);

        this.additional == null ||
        this.additional == undefined ||
        this.additional <= 0 ||
        this.additional == ""
          ? (this.additionalIsValid = false)
          : (this.additionalIsValid = true);
      } else {
        this.dateIsValid = true;
        this.additionalIsValid = true;
        this.axiosPost();
      }
    },
    axiosPost() {
      LoadingOverlay();
      axios
        .post("/items/additional", {
          itemId: this.item.id,
          value: this.additional,
          date: this.date
        })
        .then(res => {
          $("#itemAdditionalModal").modal("hide");
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
      "showItemAdditionalModal",
      data => ($("#itemAdditionalModal").modal("show"), (this.item = data))
    );
  },

  mounted() {
    let self = this;
    $("#itemAdditionalModal").on("hidden.bs.modal", function() {
      //  window.clearTimeout(timer);
      self.dateIsValid = true;
      self.additionalIsValid = true;
      self.additional = null;
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
