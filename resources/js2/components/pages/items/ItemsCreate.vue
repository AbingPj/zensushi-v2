<template>
  <div>
    <h1>Create Item ({{ parseItemType.description }})</h1>
    <!-- <form action> -->
    <div class="row">
      <!--  -->

      <!--  -->

      <div class="col-lg-6">
        <!--  -->
        <div class="form-group">
          <label for>Item Type</label>
          <input
            type="text"
            name="item_type"
            :value="parseItemType.description"
            class="form-control"
            disabled
          />
        </div>
        <!--  Category -->
        <div class="form-group">
          <label>Category &nbsp;</label>
          <select v-model="selectedCategory" class="form-control form-control-sm">
            <option value="null" disabled>Select Category</option>
            <option v-for="cat in parseCategories" :value="cat" :key="cat.id">{{ cat.description }}</option>
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
            <option v-for="unit in parseUnits" :value="unit" :key="unit.id">{{ unit.description }}</option>
          </select>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for>Description (Name)</label>
          <input
            type="text"
            name="description"
            v-model="description"
            placeholder="item description"
            class="form-control"
          />
        </div>

        <!-- Raw Item -->
        <div v-if="parseItemType.id == 1">
          <div class="form-group">
            <label for>Value(Grams)</label>
            <input
              type="text"
              name="description"
              v-model="rawValue"
              placeholder="ex. 100 grams"
              class="form-control"
              :disabled="disabledValue"
            />
          </div>
        </div>
        <!-- Product Raw Item -->
        <div v-else-if="parseItemType.id == 2">
          <div class="form-group">
            <label for>Raw product</label>
            <select v-model="selectedRaw" class="form-control">
              <option value="null" disabled>Select Raw Product</option>
              <option
                v-for="raw in parseRawItems"
                :value="raw"
                :key="raw.id"
              >{{ raw.item.description }}</option>
            </select>
          </div>
          <div class="form-group">
            <label for>Value(Grams)</label>
            <input
              type="text"
              name="description"
              v-model="rawProductValue"
              placeholder="ex. 100 grams"
              class="form-control"
              :disabled="disabledValue"
            />
          </div>
        </div>
        <!-- Other Item -->
        <div v-else>Others</div>
        <br />
        <button class="btn btn-primary pull-right" @click="btnSave()">Save</button>
      </div>
    </div>
  </div>
</template>

<script>
import { setTimeout } from "timers";
export default {
  props: {
    itemtype: String,
    categories: String,
    units: String,
    rawitems: String
  },
  data() {
    return {
      description: "",
      parseItemType: [],
      parseCategories: {},
      parseUnits: {},
      parseRawItems: {},
      selectedCategory: null,
      selectedUnit: null,
      selectedRaw: null,
      rawValue: "",
      rawProductValue: "",
      disabledValue: false
    };
  },
  created() {
    this.parseItemType = JSON.parse(this.itemtype);
    this.parseCategories = JSON.parse(this.categories);
    this.parseUnits = JSON.parse(this.units);
    this.parseRawItems = JSON.parse(this.rawitems);
  },
  // mounted() {
  //   Echo.channel("ItemsChannel").listen("ItemsEvent", data => {
  //     this.$refs.itemsVuetable.refreshVueTable();
  //   });
  // },
  methods: {
    onChangeUnitSelection(data) {
      if (this.parseItemType.id == 1 || this.parseItemType.id == 2) {
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
      }
      // else {
      //   this.rawValue = "";
      //   this.rawProductValue = "";
      //   this.disabledValue = false;
      // }
    },

    btnSave() {
      LoadingOverlay();

      let selectedRawId = null;
      let selectedCategoryId = null;
      let selectedUnitId = null;
      if (this.selectedRaw) {
        selectedRawId = this.selectedRaw.id;
      }
      if (this.selectedCategory) {
        selectedCategoryId = this.selectedCategory.id;
      }
      if (this.selectedUnit) {
        selectedUnitId = this.selectedUnit.id;
      }
      axios
        .post("/items/create/item", {
          itemTypeId: this.parseItemType.id,
          // category: selectedCategoryId,
          // unit: selectedUnitId,
          category: this.selectedCategory.id,
          unit: this.selectedUnit.id,
          description: this.description,
          selectedRaw: selectedRawId,
          rawValue: this.rawValue,
          rawProductValue: this.rawProductValue
        })
        .then(function(response) {
          console.log(response.status);
          if (response.status == 200) {
            setTimeout(() => {
            //   window.location.href = "/zensushi-items";
              window.location.href = "/zen/inventory";
            }, 2000);
          }
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
};
</script>

<style>
</style>
