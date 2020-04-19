import VuetableFieldSwitch from "./VuetableFieldSwitch.vue";
import VuetableFieldButtons from "./VuetableFieldButtons.vue";

export default [
    {
        name: "id",
        title: "Item ID",
        sortField: "id"
    },
    {
        name: "description",
        title: "Description",
        sortField: "description"
    },
    {
        name: "balance",
        title: "Balance",
        sortField: "balance"
    },
    {
        name: "unit",
        title: "Unit",
        sortField: "unit"
    },
    {
        name: "category",
        title: "Category",
        sortField: "category"
    },
    {
        name: "item_type",
        title: "Item Type",
        sortField: "item_type"
    },
    {
        name: "created",
        title: "Created",
        sortField: "created"
    },

    {
        name: "created_by",
        title: "Created By",
        sortField: "created_by"
    },
    {
        name: VuetableFieldButtons,
        title: "Button Actions",
        titleClass: "text-center",
        dataClass: "text-center"
    }
];
