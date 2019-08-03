<template>
  <!-- Modal -->
  <div class="modal fade" id="chooseItemTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="text-center">
            <h5>Choose Item Type</h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div v-for="(itemType, index) in itemTypes" :key="index">
                <div class="col-4">
                  <button
                    class="btn btn-primary"
                    @click="onClickItemType(itemType)"
                  >{{ itemType.description}}</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      itemTypes: []
    };
  },
  created() {
    this.getItemTypes();
  },
  methods: {
    onClickItemType(data) {
      window.location = "/items/create/" + data.id;
    },
    getItemTypes() {
      let that = this;
      axios
        .get("/items/item_types")
        .then(function(response) {
          console.log(response.data);
          that.itemTypes = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
