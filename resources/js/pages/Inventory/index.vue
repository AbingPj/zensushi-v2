<template>
    <div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary card-outline">
                            <div class="card-header" style="border-bottom:0;">
                                <h5 class="m-0">
                                    <button
                                        type="button"
                                        class="btn btn-info"
                                        data-toggle="modal"
                                        data-target="#chooseItemTypeModal"
                                    >
                                        <i class="fas fa-folder-plus fa-lg"></i> Create New Item
                                    </button>
                                </h5>
                                <!-- folder-plus -->
                            </div>
                            <div class="card-body">
                                <h6 class="card-title"></h6>
                                <div class="table-responsive">
                                <table id="dt" class="table table-bordered table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Description</th>
                                            <th>Balance</th>
                                            <th>Unit</th>
                                            <th>Item Type</th>
                                            <th>Category</th>
                                            <!-- <th>Created</th> -->
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
                                            <!-- <td>{{getMoment(item.created_at)}}</td> -->
                                            <td>
                                                <action-button :item="item" :index="index"></action-button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <!-- /.card-body end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <items-addtional-modal></items-addtional-modal>
        <items-out-modal></items-out-modal>
        <items-in-modal></items-in-modal>
        <items-update-modal></items-update-modal>
        <items-delete-modal></items-delete-modal>
        <items-choose-itemtype-modal></items-choose-itemtype-modal>
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
            axios
                .get("/api/getItems")
                .then(res => {
                    this.items = res.data;
                    LoadingOverlayHide();
                })
                .catch(err => {
                    console.error(err);
                });
        });
    },
    methods: {
        // getMoment(time) {
        //     var a = moment(time);
        //     return moment(a).fromNow();
        // },
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

