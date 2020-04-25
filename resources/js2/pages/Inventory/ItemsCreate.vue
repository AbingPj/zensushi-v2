<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header" style="border-bottom:0;">
                                <h5 class="m-0">
                                    <i class="fas fa-folder-plus fa-lg"></i>
                                    Create New Item ({{ parseItemType.description }})
                                </h5>
                                <!-- folder-plus -->
                            </div>
                            <div class="card-body">
                                <h6 class="card-title"></h6>

                                    <!-- item type -->
                                    <div class="form-group row">
                                        <label
                                            for="item_type"
                                            class="col-sm-2 col-form-label"
                                        >Item Type</label>
                                        <div class="col-sm-10">
                                            <input
                                                type="text"
                                                name="item_type"
                                                id="item_type"
                                                :value="parseItemType.description"
                                                class="form-control"
                                                disabled
                                            />
                                        </div>
                                    </div>

                                    <!--  Category -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-10">
                                            <select v-model="selectedCategory" class="form-control">
                                                <option value="null" disabled>Select Category</option>
                                                <option
                                                    v-for="cat in parseCategories"
                                                    :value="cat"
                                                    :key="cat.id"
                                                >{{ cat.description }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Unit -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Unit</label>
                                        <div class="col-sm-10">
                                            <select
                                                v-model="selectedUnit"
                                                class="form-control"
                                                @change="onChangeUnitSelection(selectedUnit)"
                                            >
                                                <option value="null" disabled>Select Unit</option>
                                                <option
                                                    v-for="unit in parseUnits"
                                                    :value="unit"
                                                    :key="unit.id"
                                                >{{ unit.description }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- item name -->
                                    <div class="form-group row">
                                        <label
                                            for="description"
                                            class="col-sm-2 col-form-label"
                                        >Description (Item Name)</label>
                                        <div class="col-sm-10">
                                            <input
                                                type="text"
                                                name="description"
                                                id="description"
                                                v-model="description"
                                                placeholder="item description"
                                                class="form-control"
                                            />
                                        </div>
                                    </div>

                                    <!-- Raw Item -->
                                    <div v-if="parseItemType.id == 1">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Value(Grams)</label>
                                            <div class="col-sm-10">
                                                <input
                                                    type="text"
                                                    v-model="rawValue"
                                                    placeholder="ex. 100 grams"
                                                    class="form-control"
                                                    :disabled="disabledValue"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Product Raw Item -->
                                    <div v-else-if="parseItemType.id == 2">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Raw product</label>
                                            <div class="col-sm-10">
                                                <select v-model="selectedRaw" class="form-control">
                                                    <option value="null" disabled>Select Raw Product</option>
                                                    <option
                                                        v-for="raw in parseRawItems"
                                                        :value="raw"
                                                        :key="raw.id"
                                                    >{{ raw.item.description }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Value(Grams)</label>
                                            <div class="col-sm-10">
                                                <input
                                                    type="text"
                                                    v-model="rawProductValue"
                                                    placeholder="ex. 100 grams"
                                                    class="form-control"
                                                    :disabled="disabledValue"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Other Item -->
                                    <div v-else></div>
                                    <br />

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <!-- <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>-->
                                        <div class="col-sm-10">
                                            <div class="float-right">
                                                <button class="btn btn-primary" @click="btnSave()">
                                                    <i class="far fa-save fa-lg"></i> Save
                                                </button>
                                                <a
                                                    class="btn btn-danger"
                                                    onclick="return LoadingOverlay()"
                                                    href="/zen/inventory"
                                                >
                                                    <i class="far fa-window-close fa-lg"></i> Cancel
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <!-- /.card-body end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
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
