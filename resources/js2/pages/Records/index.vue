<template>
    <div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        id="dt"
                                        class="table table-bordered table-sm table-hover"
                                    >
                                        <thead>
                                            <tr>
                                                <th style="width: 150px;">Date</th>
                                                <th>Item ID</th>
                                                <th>Item</th>
                                                <th>Add</th>
                                                <th>IN</th>
                                                <th>OUT</th>
                                                <th>BONES</th>
                                                <th>SCRAPS</th>
                                                <th>TOTAL PROD</th>
                                                <th>DIFFERENCE</th>
                                                <th style="width: 100px;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in items" :key="index">
                                                <td>{{momentFormatter(item.date)}}</td>
                                                <td class="text-center" >{{item.item_id}}</td>
                                                <td>{{item.item}}</td>
                                                <td>{{item.ADD}}</td>
                                                <td>{{item.IN}}</td>
                                                <td>{{item.OUT}}</td>
                                                <td>{{item.BONES}}</td>
                                                <td>{{item.SCRAPS}}</td>
                                                <td>{{item.TOTAL}}</td>
                                                <td>{{item.DIFFERENCE}}</td>
                                                <td>
                                                    <div
                                                        class="btn-group"
                                                        role="group"
                                                        aria-label="Button group with nested dropdown"
                                                    >
                                                        <button
                                                            @click="editAction(item, index)"
                                                            type="button"
                                                            class="btn btn-info"
                                                        >
                                                            <i class="fa fa-edit fa-lg"></i>
                                                        </button>
                                                        <button
                                                            @click="deleteAction( item, index)"
                                                            type="button"
                                                            class="btn btn-danger"
                                                        >
                                                            <i class="fa fa-trash fa-lg"></i>
                                                        </button>
                                                    </div>
                                                    <!-- <records-action-button :item="item" :index="index"></action-button> -->
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
        </div>
        <!-- /.content -->
        <!-- <modal-delete-record></modal-delete-record>
        <modal-update-record></modal-update-record> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            items: []
        };
    },
    created() {
        this.getRecords();
    },
    methods: {
        momentFormatter(datetime) {
            var result = moment(datetime);
            return moment(result).format('MMM.DD,YYYY - hh:mmA');
        },
        getRecords() {
            axios
                .get("/api/getRecords")
                .then(res => {
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
                    order: [[0, "desc"]],
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    iDisplayLength: -1
                });
            });
        },
        editAction(data, index) {
            let dataToUpdate = { ...data };
            this.$events.fire("updateRecordModal", dataToUpdate);
        },
        deleteAction(data, index) {
            let dataToDelete = { ...data };
            this.$events.fire("deleteRecordModal", dataToDelete);
        }
    }
};
</script>
