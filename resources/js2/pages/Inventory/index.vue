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
                                <!-- <h5 class="card-title">Items</h5> -->
                                <table id="dt" class="table table-bordered table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>item id</th>
                                            <th>description</th>
                                            <th>item_type</th>
                                            <th>category</th>
                                            <th>option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in items" :key="index">
                                            <td>{{item.id}}</td>
                                            <td>{{item.description}}</td>
                                            <td>{{item.item_type_id}}</td>
                                            <td>{{item.category_id}}</td>
                                            <td>
                                                <div
                                                    class="btn-group btn-sm"
                                                    role="group"
                                                    aria-label="Button group with nested dropdown"
                                                >
                                                    <button
                                                        @click="editAction(rowData, rowIndex)"
                                                        type="button"
                                                        class="btn btn-sm btn-info"
                                                        data-toggle="modal"
                                                        data-target="#updateItemModal"
                                                    >
                                                        <i class="fa fa-edit fa-lg"></i>
                                                    </button>
                                                    <button
                                                        @click="deleteAction( rowData, rowIndex)"
                                                        type="button"
                                                        class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#deleteItemModal"
                                                    >
                                                        <i class="fa fa-trash fa-lg"></i>
                                                    </button>

                                                    <div class="btn-group" role="group">
                                                        <button
                                                            id="btnGroupDrop1"
                                                            type="button"
                                                            class="btn btn-sm btn-secondary dropdown-toggle"
                                                            data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false"
                                                        ></button>
                                                        <div
                                                            class="dropdown-menu"
                                                            aria-labelledby="btnGroupDrop1"
                                                        >
                                                            <!-- <a class="dropdown-item" href="#"><i class="fa fa-window-close-o" aria-hidden="true"></i> &nbsp;  IN</a> -->
                                                            <a
                                                                @click="itemIn(item)"
                                                                class="dropdown-item"
                                                            >
                                                                <i
                                                                    class="fa fa-check-square-o fa-2x"
                                                                    aria-hidden="true"
                                                                ></i>
                                                                &nbsp; {{item.item_type_id == 2? 'PRODUCTION': 'IN'}}
                                                            </a>

                                                            <a
                                                                @click="itemOut(item)"
                                                                class="dropdown-item"
                                                                href="#"
                                                            >
                                                                <i
                                                                    class="fa fa-minus-square fa-2x"
                                                                    aria-hidden="true"
                                                                ></i>
                                                                &nbsp;{{item.item_type_id == 1? 'PRODUCTION': 'OUT'}}
                                                            </a>
                                                            <a
                                                                @click=" itemAdditional(item)"
                                                                class="dropdown-item"
                                                                href="#"
                                                            >
                                                                <i
                                                                    class="fa fa-plus fa-lg"
                                                                    aria-hidden="true"
                                                                ></i> &nbsp; Additional
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <button class="btn btn-info btn-sm">sample</button> -->
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

