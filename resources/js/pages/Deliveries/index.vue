<template>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Select Item</h3>
                        </div>
                        <div class="card-body" style="min-height: 300px;">
                            <!-- <div class="table-responsive"> -->
                            <table id="dt" class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Remaing Qty</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in items" :key="index">
                                        <td v-if="item.selected == 'false'">{{item.id}}</td>
                                        <td v-if="item.selected == 'false'">{{item.description}}</td>
                                        <td
                                            v-if="item.selected == 'false'"
                                        >{{item.balance}} {{item.unit_desc}}</td>
                                        <td v-if="item.selected == 'false'">
                                            <button
                                                class="btn btn-warning btn-sm text-dark"
                                                @click="selectProduct(item)"
                                            >
                                                <i class="fas fa-mouse-pointer"></i>
                                                Select
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- </div> -->
                        </div>

                        <!-- <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>-->
                    </div>
                </div>
                <div class="col-md-6 col-lg-7">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Product Delivery List</h3>
                        </div>
                        <div class="card-body" style="min-height: 300px;">
                            <!-- <div class="table-responsive"> -->
                            <table id="dt" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 100px;">Item id</th>
                                        <th>Item Name</th>
                                        <th style="width: 150px;">Quantity</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in selectedProducts" :key="product.id">
                                        <td style="width: 100px;">{{product.id}}</td>
                                        <td>{{product.description}}</td>
                                        <td style="width: 150px;">
                                            <div class="input-group input-group-sm">
                                                <input
                                                    type="number"
                                                    style="text-align:center;"
                                                    class="form-control"
                                                    v-model="product.quantity"
                                                    min="1"
                                                    max="100"
                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                />
                                                <!-- :value="product.quantity" -->
                                                <div class="input-group-append">
                                                    <span
                                                        class="input-group-text"
                                                    >{{product.unit_desc}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 50px;">
                                            <button
                                                class="btn btn-danger"
                                                @click="deleteProduct(product)"
                                            >
                                                <i class="fas fa-backspace"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />

                            <!-- </div> -->
                        </div>

                        <div class="card-footer">
                            <div style="padding: 0px 50px 0px 50px ">
                                <label for="branch" class="mr-sm-2">Branch:</label>
                                <input
                                    v-model="branch"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Branch Name"
                                    id="branch"
                                />
                                <br />
                                <button class="btn btn-warning btn-block" @click="submit()">
                                    <i class="fas fa-check-circle"></i>
                                    &nbsp;
                                    &nbsp;
                                    Submit
                                    &nbsp;
                                    &nbsp;
                                    <i
                                        class="fas fa-shipping-fast"
                                    ></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.getItems("initialize");
    },
    data() {
        return {
            items: [],
            selectedProducts: [],
            branch: ""
        };
    },
    methods: {
        submit() {
            LoadingOverlay();

            axios
                .post("/items/delivery/send-delivery", {
                    branch: this.branch,
                    products: this.selectedProducts
                })
                .then(res => {
                    console.log(res);
                    this.branch = "";
                    this.selectedProducts = [];
                    this.getItems();
                    LoadingOverlayHide();
                });
        },
        getItems(action) {
            axios.get("/items/delivery/products").then(res => {
                this.items = res.data;
                if (action == "initialize") {
                    this.datatablesInitialize();
                }
            });
        },

        datatablesInitialize() {
            $(document).ready(function() {
                $("#dt").DataTable({
                    ordering: true, // Allows ordering
                    searching: true, // Searchbox
                    paging: false, // Pagination
                    columnDefs: [
                        {
                            targets: 3,
                            searchable: false, // Stops search in the fields
                            sorting: false, // Stops sorting
                            orderable: false // Stops ordering
                        }
                    ],
                    dom: '<"top"f>rt<"bottom"lp><"clear">', // Positions table elements
                    language: {
                        search: "_INPUT_", // Removes the 'Search' field label
                        searchPlaceholder: "Search", // Placeholder for the search box
                        emptyTable: "no Products yet"
                    },
                    search: {
                        addClass: "form-control input-lg col-xs-12"
                    },
                    fnDrawCallback: function() {
                        $("input[type='search']").attr("id", "selectSearchBox");
                        $("#dt").css("cssText", "margin-top: 0px !important;");
                        $(
                            "select[name='dt_length'], #selectSearchBox"
                        ).removeClass("input-sm");
                        $("#selectSearchBox")
                            .css("width", "300px")
                            .focus();
                        $("#dt_filter").removeClass("dataTables_filter");
                    }

                    // language: {  },
                });
            });
        },
        selectProduct(data) {
            let y = this.selectedProducts.find(list => list.id == data.id);
            var selectedData;
            if (y == undefined) {
                selectedData = data;
                selectedData.quantity = 1;
                this.selectedProducts.push(selectedData);
            }
            return (data.selected = "true");
        },
        deleteProduct(data) {
            let newList = this.selectedProducts.filter(function(list) {
                return list.id != data.id;
            });
            this.selectedProducts = newList;

            let item = this.items.find(list => list.id == data.id);
            return (item.selected = "false");
        }
    }
};
</script>
