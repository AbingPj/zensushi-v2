<template>
    <div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary card-outline">
                            <div class="card-body"></div>
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
        item_id: String,
        item_raw_stock_out: String,
        product_item_id: String
    },
    data() {
        return {
            raws: [],
            products: [],
            selectedRaw: null,
            selectedRawOut: 0,
            rawOut: 0,
            selectedProduct: null,
            selectedProductsNew: [],
            scrap: 0,
            bones: 0,
            date: null,
            dateIsValid: true,
            scrapSelectedWeight: "Grams",
            bonesSelectedWeight: "Grams"
            // selectedProducts: []
        };
    },
    computed: {
        notSelectedProducts() {
            return this.products.filter(obj => {
                if (obj.selected == false) {
                    return obj;
                }
            });
        },

        notSelectedProductsLength() {
            return this.notSelectedProducts.length;
        },

        selectedProducts() {
            // return this.products.filter(obj => {
            //   if (obj.selected == true) {
            //     obj.total_weight = obj.quantity * obj.value;
            //     return obj;
            //   }
            // });
            if (this.selectedProductsNew !== null) {
                return this.selectedProductsNew.map(obj => {
                    obj.total_weight = obj.quantity * obj.value;
                    return obj;
                });
            }
        },

        // Select products of {{selectedRaw.item.description}}
        totalWieghtOfSelectedProduct() {
            if (
                this.selectedProducts === undefined ||
                this.selectedProducts.length == 0
            ) {
                return 0;
            } else {
                let sum = this.selectedProducts
                    .map(obj => obj.total_weight)
                    .reduce((a, c) => {
                        return a + c;
                    });
                return sum;
            }
        },

        computedScrap() {
            let scrap = this.scrap;
            scrap == "" ? (scrap = 0) : (scrap = parseFloat(scrap));
            if (this.scrapSelectedWeight == "Kilo") {
                return scrap * 1000;
            } else {
                return scrap;
            }
        },
        computedScrapKilo() {
            let scrap = this.scrap;
            scrap == "" ? (scrap = 0) : (scrap = parseFloat(scrap));
            if (this.scrapSelectedWeight == "Kilo") {
                return scrap;
            } else {
                return scrap / 1000;
            }
        },

        computedBones() {
            let bones = this.bones;
            bones == "" ? (bones = 0) : (bones = parseFloat(bones));
            if (this.bonesSelectedWeight == "Kilo") {
                return bones * 1000;
            } else {
                return bones;
            }
        },
        computedBonesKilo() {
            let bones = this.bones;
            bones == "" ? (bones = 0) : (bones = parseFloat(bones));
            if (this.bonesSelectedWeight == "Kilo") {
                return bones;
            } else {
                return bones / 1000;
            }
        },

        finalWeight() {
            let scrap = this.computedScrap;
            scrap == "" ? (scrap = 0) : (scrap = parseFloat(scrap));
            let bones = this.computedBones;
            bones == "" ? (bones = 0) : (bones = parseFloat(bones));
            return (
                scrap + bones + parseFloat(this.totalWieghtOfSelectedProduct)
            );
        },

        rawStackOutWeightGrams() {
            if (this.selectedRaw == null) {
                return 0;
            } else {
                let value = this.selectedRaw.value;
                value == "" ? (value = 0) : (value = parseFloat(value));
                let rawOut = this.rawOut;
                rawOut == "" ? (rawOut = 0) : (rawOut = parseFloat(rawOut));
                return rawOut * value;
            }
        },

        rawStackOutWeightKilo() {
            if (this.selectedRaw == null) {
                return 0;
            } else {
                let value = this.selectedRaw.value;
                value == "" ? (value = 0) : (value = parseFloat(value));
                let rawOut = this.rawOut;
                rawOut == "" ? (rawOut = 0) : (rawOut = parseFloat(rawOut));
                return (rawOut * value) / 1000;
            }
        },

        difference() {
            let total = this.finalWeight;
            total == "" ? (total = 0) : (total = parseFloat(total));
            let out = this.rawStackOutWeightGrams;
            out == "" ? (out = 0) : (out = parseFloat(out));
            return total - out;
        }
    },
    methods: {
        btnSelectProduct() {
            if (this.selectedProduct !== null) {
                this.products.map(obj => {
                    if (obj.id == this.selectedProduct.id) {
                        obj.selected = true;
                        return obj;
                    }
                });

                this.selectedProductsNew.push(this.selectedProduct);
                this.selectedProduct = null;
            }
        },

        removeSelection(data) {
            this.products.map(obj => {
                if (obj.id == data.id) {
                    obj.selected = false;
                    obj.quantity = 1;
                    obj.total_weight = obj.value;
                    return obj;
                }
            });
            let index = this.selectedProductsNew.indexOf(data);
            if (index !== -1) this.selectedProductsNew.splice(index, 1);
        },

        ////////////////
        rawSelectionChange() {
            LoadingOverlay();
            window.location = "/zen/production/" + this.selectedRaw.item_id;
        },
        sendSelelectedProducts() {
            LoadingOverlay();
            let self = this;
            console.log(this.date);
            if (
                this.date == null ||
                this.date == undefined ||
                this.date == ""
            ) {
                console.log("date is required");
                // alert("date is required");
                document.getElementById("date").focus();
                this.dateIsValid = false;
                LoadingOverlayHide();
                this.$refs.date.$el.focus();
            } else {
                let params = {
                    // selected_products: this.cleaningSelectedProducts(this.selectedProductsNew),
                    selected_products: this.selectedProductsNew,
                    //  bones: this.bones,
                    // scrap: this.scrap,
                    bones: this.computedBones,
                    scrap: this.computedScrap,

                    selected_raw: this.selectedRaw,
                    // selected_raw_out_value: this.selectedRawOut,
                    selected_raw_out_value: this.rawOut,
                    date: this.date,

                    total: this.finalWeight,
                    difference: this.difference
                };

                axios
                    .post("/items/products/stockin", params)
                    .then(res => {
                        console.log(res);
                        self.selectedProductsNew = [];
                        self.products.map(obj => {
                            obj.selected = false;
                            obj.quantity = 1;
                            obj.total_weight = obj.value;
                            return obj;
                        });
                        self.scrap = 0;
                        self.bones = 0;
                        self.selectedRawOut = 0;
                        LoadingOverlayHide();
                    })
                    .catch(err => {
                        console.error(err);
                        LoadingOverlayHide();
                    });
            }
        },
        getRaws() {
            axios.get("/items/raw").then(res => {
                this.raws = res.data;
                this.setSelectedRaw();
            });
        },
        setSelectedRaw() {
            if (!this.item_id == "") {
                let raw = this.raws.find(obj => {
                    if (obj.item_id == this.item_id) {
                        return obj;
                    }
                });

                if (raw == undefined) {
                    this.selectedRaw = null;
                    LoadingOverlayHide();
                } else {
                    this.selectedRaw = raw;
                    this.$events.fire("showItemRawOutModal2", this.selectedRaw);
                    this.getProducts();
                }
            } else {
                this.selectedRaw = null;
                LoadingOverlayHide();
            }
        },
        getProducts() {
            // let url = "/items/products"
            if (!this.item_id == "") {
                let url = "/items/products/" + this.item_id;
                axios.get(url).then(res => {
                    this.products = res.data;
                    this.ifProductItemIdIsNotNull();
                });
            } else {
                LoadingOverlayHide();
            }
        },
        ifProductItemIdIsNotNull() {
            if (this.product_item_id !== "") {
                let prod = this.products.find(obj => {
                    if (obj.item_id == this.product_item_id) {
                        return obj;
                    }
                });
                console.log({ prod });
                if (prod == undefined) {
                    console.log({ prod });
                    LoadingOverlayHide();
                } else {
                    this.selectedProduct = prod;
                    this.btnSelectProduct();
                    setTimeout(() => {
                        LoadingOverlayHide();
                    }, 500);
                }
            } else {
                LoadingOverlayHide();
            }
        },
        // cleaningSelectedProducts(data) {
        //   return data.map(obj => {
        //     delete obj.selected;
        //     delete obj.unit;
        //     delete obj.item;
        //     delete obj.created_at;
        //     delete obj.updated_at;
        //     delete obj.remove;
        //     return obj;
        //   });
        // },
        itemRawOutModal2Show() {
            console.log("show");
            $("#itemRawOutModal2").modal("show");
        }
    },

    mounted() {
        LoadingOverlay();
        console.log("mounted");
        this.getRaws();
    },
    created() {
        console.log("created");
    }
};
</script>
