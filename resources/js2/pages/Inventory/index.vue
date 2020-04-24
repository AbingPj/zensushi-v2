<template>
    <div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <!-- <button class="btn btn-info" onClick="return LoadingOverlay();"> loading overlay </button> -->
                                <!-- <h5 class="card-title">Items</h5> -->
                                <table id="dt" class="table table-bordered table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Description</th>
                                            <th>Balance</th>
                                            <th>Unit</th>
                                            <th>Item Type</th>
                                            <th>Category</th>
                                            <th style="width: 100px;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in items" :key="index">
                                            <td>{{item.id}}</td>
                                            <td>{{item.description}}</td>
                                            <td>{{item.balance}}</td>
                                            <td>{{item.unit.description}}</td>
                                            <td>{{item.item_type.description}}</td>
                                            <td>{{item.category.description}}</td>
                                            <td>
                                                <action-button :item="item"></action-button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <items-update-modal></items-update-modal>
        <items-delete-modal></items-delete-modal>
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: []
        };
    },
    mounted() {
        this.getItems();

        Echo.channel("ItemsChannel").listen("ItemsEvent", data => {
            console.log(data);
            axios
                .get("/api/getItems")
                .then(res => {
                    console.log(res);
                    this.items = res.data;
                    LoadingOverlayHide();
                })
                .catch(err => {
                    console.error(err);
                });
            // this.$refs.itemsVuetable.refreshVueTable();
        });
    },
    methods: {
        getItems() {
            axios
                .get("/api/getItems")
                .then(res => {
                    console.log(res);
                    this.items = res.data;
                    this.datatablesInitialize();
                })
                .catch(err => {
                    console.error(err);
                });
        },
        datatablesInitialize() {
            $(document).ready(function() {
                $("#dt").DataTable({
                    language: { emptyTable: "nothing to see here" },
                    order: [[1, "asc"]],
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    iDisplayLength: -1
                });
            });
        }
    }
};
</script>

