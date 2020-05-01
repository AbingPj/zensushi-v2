<template>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Select Item</h3>
                        </div>
                        <div class="card-body">
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
                                        <td>{{item.id}}</td>
                                        <td>{{item.description}}</td>
                                        <td>{{item.balance}} {{item.unit_desc}}</td>
                                        <td>
                                            <button
                                                class="btn btn-success btn-sm"
                                                @click="selectProduct(item)"
                                            >Select</button>
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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.getItems();
    },
    data() {
        return {
            items: []
        };
    },
    methods: {
        getItems() {
            axios.get("/items/delivery/products").then(res => {
                this.items = res.data;
                this.datatablesInitialize();
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
                        $("input[type='search']").attr("id", "searchBox");
                        $("#dt").css("cssText", "margin-top: 0px !important;");
                        $("select[name='dt_length'], #searchBox").removeClass(
                            "input-sm"
                        );
                        $("#searchBox")
                            .css("width", "400px")
                            .focus();
                        $("#dt_filter").removeClass("dataTables_filter");
                    }

                    // language: {  },
                });
            });
        }
    }
};
</script>
