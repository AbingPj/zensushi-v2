<template>
    <div>
        <div class="modal fade" id="itemInModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Item Stock-in</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <!-- <input type="date" class="form-control" v-model="date" /> -->
                            <div
                                class="input-group date"
                                id="tempusdominus"
                                data-target-input="nearest"
                            >
                                <input
                                    type="text"
                                    class="form-control datetimepicker-input"
                                    data-target="#tempusdominus"
                                    v-model="date"
                                />
                                <div
                                    class="input-group-append"
                                    data-target="#tempusdominus"
                                    data-toggle="datetimepicker"
                                >
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                        <!-- <i class="fas fa-calendar-alt"></i> -->
                                        <!-- <i class="far fa-calendar-alt"></i> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Stock-in: {{ item.description }}</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="0"
                                    v-model="inStock"
                                />
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ item.unit.description }}</span>
                                </div>
                            </div>

                            <br />
                            <div class="text-center">
                                <button @click="stockIn()" class="btn btn-info">Stock-IN</button>
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
    props: {
        item: Object
    },
    data() {
        return {
            inStock: null,
            date: null
        };
    },
    methods: {
        stockIn() {
            this.axiosPost();
        },
        axiosPost() {
            LoadingOverlay();
            axios
                .post("/items/stockin", {
                    itemId: this.item.id,
                    value: this.inStock,
                    date: this.date
                })
                .then(res => {
                    $("#itemInModal").modal("hide");
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
    },

    mounted() {
        let self = this;
        $("#itemInModal").on("hidden.bs.modal", function() {
            self.inStock = null;
            self.date = null;
        });
        $(function() {
            $("#tempusdominus").datetimepicker({
                maxDate: new Date()
            });
        });
    }
};
</script>
