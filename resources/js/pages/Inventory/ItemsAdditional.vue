<template>
    <div>
        <div class="modal fade" id="itemAdditionalModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Item Additional</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date">Date</label>

                            <div
                                class="input-group date"
                                id="addDateTimePicker"
                                data-target-input="nearest"
                            >
                                <input
                                    type="text"
                                    class="form-control datetimepicker-input"
                                    data-target="#addDateTimePicker"
                                    id="addDatePicker"
                                    :value="date"
                                />
                                <div
                                    class="input-group-append"
                                    data-target="#addDateTimePicker"
                                    data-toggle="datetimepicker"
                                >
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Additional: {{ item.description }}</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    class="form-control"
                                    placeholder="0"
                                    v-model="additional"
                                />
                                <div class="input-group-append">
                                    <span class="input-group-text">{{ unit }}</span>
                                </div>
                            </div>

                            <br />
                            <div class="text-center">
                                <button @click="additionalItem()" class="btn btn-info">Additional</button>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                <button class="btn btn-info" data-dismiss="modal">IN</button>
                        </div>-->
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
            unit: null,
            additional: null,
            date: null
        };
    },
    methods: {
        additionalItem() {
            this.date = $("#addDatePicker").val();
            this.axiosPost();
        },
        axiosPost() {
            LoadingOverlay();
            axios
                .post("/items/additional", {
                    itemId: this.item.id,
                    value: this.additional,
                    date: this.date
                })
                .then(res => {
                    $("#itemAdditionalModal").modal("hide");
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
        $("#itemAdditionalModal").on("hidden.bs.modal", function() {
            self.additional = null;
            self.date = null;
        });
        $("#addDateTimePicker").datetimepicker({
            maxDate: new Date()
        });
    },
    events: {
        showItemAdditonalModal(data) {
            $("#itemAdditionalModal").modal("show");
            this.item = data;
            this.unit = data.unit.description;
            var datetime = new Date();
            this.date = moment(datetime).format("MM/DD/YYYY hh:mm A");
        }
    }
};
</script>
