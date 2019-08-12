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
        <!--  -->
        <div class="form-group">
          <label>Category &nbsp;</label>
          <select v-model="selectedCategory" class="form-control form-control-sm">
            <option value="null" disabled>Select Category</option>
            <option v-for="cat in parseCategories" :value="cat" :key="cat.id">{{ cat.description }}</option>
          </select>
        </div>
        <!--  -->
        <div class="form-group">
          <label>Unit &nbsp;</label>
          <select v-model="selectedUnit" class="form-control form-control-sm">
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
              placeholder="ex. 1000 grams"
              class="form-control"
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
      rawProductValue: ""
    };
  },
  created() {
    this.parseItemType = JSON.parse(this.itemtype);
    this.parseCategories = JSON.parse(this.categories);
    this.parseUnits = JSON.parse(this.units);
    this.parseRawItems = JSON.parse(this.rawitems);
  },
  methods: {
    btnSave() {
      axios
        .post("/items/create/item", {
          itemTypeId: this.parseItemType.id,
          category: this.selectedCategory.id,
          unit: this.selectedUnit.id,
          description: this.description,
          selectedRaw: this.selectedRaw.id,
          // selectedItem: this.selectedRaw.item.id,
          rawValue: this.rawValue,
          rawProductValue: this.rawProductValue
        })
        .then(function(response) {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

<style>
</style>