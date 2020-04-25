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
                                    <a type="button" class="btn btn-info" href>
                                        <i class="fas fa-user-plus fa-lg"></i> Create New User
                                    </a>
                                </h5>
                                <!-- folder-plus -->
                            </div>
                            <div class="card-body">
                                <h6 class="card-title"></h6>
                                <table id="dt" class="table table-bordered table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <!-- <th>M.I.</th> -->
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th style="width: 100px;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="user in users" :key="user.id">
                                            <td>{{user.id}}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{user.name}}</td>
                                            <!-- <td></td> -->
                                            <td>{{user.email}}</td>
                                            <td>{{user.role.description}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
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
export default {
    created() {
        this.getUsers();
    },
    data() {
        return {
            users: []
        };
    },
    methods: {
        getUsers() {
            axios
                .get("/getUsers")
                .then(res => {
                    this.users = res.data;
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
                    order: [[0, "asc"]],
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
