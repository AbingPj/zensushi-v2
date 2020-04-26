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
                            <!-- <date-picker v-model="date" :config="options"></date-picker> -->
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
                                    id="inDatePicker"
                                    :value="date"

                                />
                                <!-- :value="date" -->
                                <!-- :value="setDate" -->
                                <div
                                    class="input-group-append"
                                    data-target="#tempusdominus"
                                    data-toggle="datetimepicker"
                                >
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
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
                                    <span class="input-group-text">{{ unit }}</span>
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
// // Import this component
// import datePicker from "vue-bootstrap-datetimepicker";
// // Import date picker css
// import "pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css";

export default {
    // components: {
    //     datePicker
    // },
    // props: {
    //     item: Object
    // },
    data() {
        return {
            item: {},
            inStock: null,
            date: null,
            setDate: null,
            unit: null
            // options: {
            //     format: "DD/MM/YYYY",
            //     useCurrent: false
            // }
        };
    },
    methods: {
        stockIn() {
            this.date = $("#inDatePicker").val();
            // console.log($("#inDatePicker").val());
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
            $("#tempusdominus").datetimepicker({ date: null });
        });
        $("#tempusdominus").datetimepicker({
            // sideBySide: true,
            // debug: true,
            maxDate: new Date()
        });

        // $("#tempusdominus").datetimepicker({
        //     maxDate: new Date()
        // });

        //console.log(this.item);
        //var datetime = moment(this.item.created_at).format('DD/MM/YYYY');
    },
    events: {
        showItemInModal(data) {
            $("#itemInModal").modal("show");
            this.item = data;
            this.unit = data.unit.description;
            var datetime = new Date();
            this.date = moment(datetime).format("DD/MM/YYYY hh:mm A");
            // var datetime = this.item.created_at;
            // console.log(moment(datetime).format("DD/MM/YYYY hh:mm A"));
            // this.date = moment(datetime).format("DD/MM/YYYY hh:mm A");
        }
    }
};
</script>
