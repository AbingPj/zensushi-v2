<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Inventroy</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

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
                                            <th>item id</th>
                                            <th>description</th>
                                            <th>item_type</th>
                                            <th>category</th>
                                            <th style="width: 100px;">option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in items" :key="index">
                                            <td>{{item.id}}</td>
                                            <td>{{item.description}}</td>
                                            <td>{{item.item_type_id}}</td>
                                            <td>{{item.category_id}}</td>
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
                    order: [[1, "asc"]]
                });
            });
        }
    }
};
</script>

