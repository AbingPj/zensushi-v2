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
                                            <th>M.I.</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th style="width: 100px;">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
