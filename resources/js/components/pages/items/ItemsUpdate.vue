<template>
  <div>
    <div class="modal fade" id="updateItemModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Update Item</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="title">Description</label>
                <input
                  v-model="item.description"
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  placeholder="Post Title here"
                />
              </div>
              <!--  Category -->
              <div class="form-group">
                <label>Category &nbsp;</label>
                <select v-model="selectedCategory" class="form-control form-control-sm">
                  <option value="null" disabled>Select Category</option>
                  <option v-for="cat in categories" :value="cat" :key="cat.id">{{ cat.description }}</option>
                </select>
              </div>
              <!-- Unit -->
              <div class="form-group">
                <label>Unit &nbsp;</label>
                <select v-model="selectedUnit" class="form-control form-control-sm">
                  <option value="null" disabled>Select Unit</option>
                  <option v-for="unit in units" :value="unit" :key="unit.id">{{ unit.description }}</option>
                </select>
              </div>
              <div class="modal-footer">
                <button @click="submitUpdate()" class="btn btn-info" data-dismiss="modal">Update</button>
              </div>
            </form>
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
      units: [],
      categories: [],
      selectedUnit: {},
      selectedCategory: {}
    };
  },
  methods: {
    async getUpdateItemData(id) {
      LoadingOverlay();
      let { data, status } = await axios.get("/items/update/data/" + id);
      if (status == 200) {
        let newitem = data.item;
        this.item = data.item;
        this.units = data.units;
        this.categories = data.categories;
        this.selectedUnit = data.item.selected_unit;
        this.selectedCategory = data.item.selected_category;
        LoadingOverlayHide();
      }
    }
    // async deleteItem() {
    //   LoadingOverlay();
    //   let { status } = await axios.delete("/items/delete/" + this.item.id);
    //   if (status == 200) {
    //     this.$events.fire("refreshItemsVueTable", status);
    //     LoadingOverlayHide();
    //   }
    // },
  },

  created() {
    this.$events.listen("showItemUpdateModal", data =>
      this.getUpdateItemData(data.id)
    );
  }
};
</script>