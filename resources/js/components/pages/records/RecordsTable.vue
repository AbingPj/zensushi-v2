<template>
    <div>
        <h1>Records Table</h1>
        <div class="row">
            <!-- Show Entries Selection -->
            <div class="col">
                <per-page-option :propPerPage="perPage" @perPageNumber="onChangePerPage"></per-page-option>
            </div>
            <!-- Filter Bar -->
            <div class="col">
                <filter-bar class="pull-right" @filterText="onFilterSet"></filter-bar>
            </div>
        </div>

        <vuetable
            ref="vuetable"
            :api-url="base_Url"
            :fields="fields"
            data-path="data"
            pagination-path
            :css="css.table"
            :append-params="moreParams"
            :per-page="perPage"
            @vuetable:pagination-data="onPaginationData"
        ></vuetable>

        <div class="row" style="margin-top:20px;">
            <div class="col">
                <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
            </div>
            <div class="col">
                <vuetable-pagination
                    ref="pagination"
                    class="pull-right"
                    :css="css.pagination"
                    @vuetable-pagination:change-page="onChangePage"
                ></vuetable-pagination>
            </div>
        </div>
        <!-- <vuetable
      ref="vuetable"
      api-url="https://vuetable.ratiw.net/api/users"
      :fields="['name', 'email', 'birthdate']"
        ></vuetable>-->
    </div>
</template>
<script>
import RecordsFields from "./RecordsFields.js";
export default {
    props: {
        baseUrl: String
    },

    data() {
        return {
            base_Url: "",
            perPage: 10,
            moreParams: {},
            css: this.$VueTableCssForBootstrap4,
            fields: RecordsFields
        };
    },
    created() {
        // this.base_Url = this.baseUrl + "/items";
        this.base_Url = "/records";
    },
    methods: {
        onChangePage(page) {
            this.$refs.vuetable.changePage(page);
        },

        // Refresh VueTable
        refreshVueTable() {
            this.$refs.vuetable.refresh();
            LoadingOverlayHide();
        },

        // For Search or Filter Data
        onFilterSet(filterText) {
            this.moreParams = {
                filter: filterText
            };
            Vue.nextTick(() => this.$refs.vuetable.refresh());
        },

        // For Per Page Option
        onChangePerPage(perPageNumber) {
            LoadingOverlay();
            this.perPage = perPageNumber;
            setTimeout(() => {
                this.refreshVueTable();
            }, 1500);
        },

        // For Pagination Buttons
        onPaginationData(paginationData) {
            this.$refs.pagination.setPaginationData(paginationData);
            this.$refs.paginationInfo.setPaginationData(paginationData);
        }
    }
};
</script>