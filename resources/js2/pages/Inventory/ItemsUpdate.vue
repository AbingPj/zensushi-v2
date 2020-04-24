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
                                <select
                                    v-model="selectedCategory"
                                    class="form-control form-control-sm"
                                >
                                    <option value="null" disabled>Select Category</option>
                                    <option
                                        v-for="cat in categories"
                                        :value="cat"
                                        :key="cat.id"
                                    >{{ cat.description }}</option>
                                </select>
                            </div>
                            <!-- Unit -->
                            <div class="form-group">
                                <label>Unit &nbsp;</label>
                                <select
                                    v-model="selectedUnit"
                                    class="form-control form-control-sm"
                                    @change="onChangeUnitSelection(selectedUnit)"
                                >
                                    <option value="null" disabled>Select Unit</option>
                                    <option
                                        v-for="unit in units"
                                        :value="unit"
                                        :key="unit.id"
                                    >{{ unit.description }}</option>
                                </select>
                            </div>

                            <div v-if="item.item_type_id == 1">
                                <div class="form-group">
                                    <label for>Value(Grams)</label>
                                    <input
                                        type="text"
                                        name="description"
                                        v-model="rawValue"
                                        placeholder="ex. 1000 grams"
                                        :disabled="disabledValue"
                                        class="form-control"
                                    />
                                </div>
                            </div>

                            <div v-else-if="item.item_type_id == 2">
                                <div class="form-group">
                                    <label for>Raw product</label>
                                    <select v-model="selectedRaw" class="form-control">
                                        <option value="null" disabled>Select Raw Product</option>
                                        <option
                                            v-for="raw in raws"
                                            :value="raw"
                                            :key="raw.id"
                                        >{{ raw.item.description }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for>Value(Grams)</label>
                                    <input
                                        type="text"
                                        v-model="rawProductValue"
                                        placeholder="ex. 100 grams"
                                        class="form-control"
                                        :disabled="disabledValue"
                                    />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button
                                    @click="submitUpdate()"
                                    class="btn btn-info"
                                    data-dismiss="modal"
                                >Update</button>
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
      selectedCategory: {},
      rawValue: 0,
      rawProductValue: 0,
      raws: [],
      selectedRaw: {},
      disabledValue: false,
    };
  },
  methods: {
    onChangeUnitSelection(data){
      // if (this.parseItemType.id == 1 || this.parseItemType.id == 2) {
        if (data.id == 4) {
          console.log(data);
          this.rawValue = 1000;
          this.rawProductValue = 1000;
          this.disabledValue = true;
        } else {
          this.rawValue = "";
          this.rawProductValue = "";
          this.disabledValue = false;
        }
      // }

    },
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
        this.rawValue = data.raw_value;
        this.rawProductValue = data.raw_product_value;
        this.raws = data.raws;
        this.selectedRaw = data.selected_raw;
         if((this.rawValue == 1000 || this.rawProductValue == 1000 )&& this.selectedUnit.id == 4){
            this.disabledValue = true;
        }else{
          this.disabledValue = false;
        }
        LoadingOverlayHide();
      }
    },

    async submitUpdate() {
      LoadingOverlay();
      let selectedRawIdParam = null;
      let rawProductValueParam = null;
      if (this.item.item_type_id == 2) {
        selectedRawIdParam = this.selectedRaw.id;
        rawProductValueParam = this.rawProductValue;
      }
      await axios
        .put("/items/update", {
          id: this.item.id,
          description: this.item.description,
          category: this.selectedCategory.id,
          unit: this.selectedUnit.id,
          rawValue: this.rawValue,
          selectedRaw: selectedRawIdParam,
          rawProductValue: rawProductValueParam
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
    this.$events.listen("showItemUpdateModal", data =>
      this.getUpdateItemData(data.id)
    );
  }
};
</script>
