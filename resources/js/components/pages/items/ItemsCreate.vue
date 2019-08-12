<template>
  <div>
    <h1>Create Item</h1>
    <div class="row">
      <div class="col-5">
        <form action>
          <div class="form-group">
            <label for>Item Type</label>
            <input
              type="text"
              name="item_type"
              :value="newItemType.description"
              class="form-control"
              disabled
            />
          </div>

          <div class="form-group">
            <label>Category &nbsp;</label>
            <select v-model="selectedCategory" class="form-control form-control-sm">
              <option value disabled>Select Category</option>
              <option v-for="cat in newCategories" :value="cat" :key="cat">{{ cat.description }}</option>
            </select>
          </div>
          <div class="form-group">
            <label for>Description</label>
            <input
              type="text"
              name="description"
              v-model="description"
              placeholder="item description"
              class="form-control"
            />
          </div>
          <div class="form-group">
            <label>Unit &nbsp;</label>
            <select v-model="selectedUnit" class="form-control form-control-sm">
              <option value disabled>Select Unit</option>
              <option
                v-for="unit in newUnits"
                :key="unit.id"
                :value="unit.id"
              >{{ unit.description }}</option>
            </select>
          </div>
          <button class="btn btn-primary" @click="btnSave()">Save</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    itemtype: String,
    categories: String,
    units: String
  },
  data() {
    return {
      description: "",
      newItemType: [],
      newCategories: {},
      newUnits: {},
      selectedCategory: "",
      selectedUnit: ""
    };
  },
  created() {
    this.newItemType = JSON.parse(this.itemtype);
    this.newCategories = JSON.parse(this.categories);
    this.newUnits = JSON.parse(this.units);
  },
  methods: {
    btnSave() {}
  }
};
</script>

<style>
</style>