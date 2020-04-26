<template>
    <div>
        <div class="modal fade" id="itemOutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Item Stock-out</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Date</label>

                            <div
                                class="input-group date"
                                id="outDateTimePicker"
                                data-target-input="nearest"
                            >
                                <input
                                    type="text"
                                    class="form-control datetimepicker-input"
                                    data-target="#outDateTimePicker"
                                    id="outDatePicker"
                                    :value="date"
                                />
                                <div
                                    class="input-group-append"
                                    data-target="#outDateTimePicker"
                                    data-toggle="datetimepicker"
                                >
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Stock-out: {{ item.description }}</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="0"
                                    v-model="outStock"
                                />
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ unit }}</span>
                                </div>
                            </div>
                            <br />
                            <div class="text-center">
                                <button @click="stockOut()" class="btn btn-info">Stock-Out</button>
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
    data() {
        return {
            item: {},
            outStock: null,
            date: null,
            unit: null
        };
    },
    methods: {
        stockOut() {
            this.date = $("#outDatePicker").val();
            this.axiosPost();
        },

        axiosPost() {
            if (this.item.balance == 0 || this.outStock > this.item.balance) {
                alert(
                    "Item balance must not be zero or item out value must not be greater than item balance."
                );
            } else {
                LoadingOverlay();
                axios
                    .post("/items/stockout", {
                        itemId: this.item.id,
                        value: this.outStock,
                        date: this.date
                    })
                    .then(res => {
                        $("#itemOutModal").modal("hide");
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
        }
    },

    mounted() {
        let self = this;
        $("#itemOutModal").on("hidden.bs.modal", function() {
            self.outStock = null;
            self.date = null;
        });

        $("#outDateTimePicker").datetimepicker({
            maxDate: new Date()
        });
    },
    events: {
        showItemOutModal(data) {
            $("#itemOutModal").modal("show");
            this.item = data;
            this.unit = data.unit.description;
            var datetime = new Date();
            this.date = moment(datetime).format("DD/MM/YYYY hh:mm A");
        }
    }
};
</script>
