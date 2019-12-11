<template>
  <th v-if="isHeader" class="vuetable-th-component-buttons" v-html="title"></th>
  <td v-else class="vuetable-td-component-buttons">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
      <button
        @click="editAction(rowData, rowIndex)"
        type="button"
        class="btn btn-info"
      >
        <i class="fa fa-edit fa-lg"></i>
      </button>
      <button
        @click="deleteAction( rowData, rowIndex)"
        type="button"
        class="btn btn-danger"
      >
        <i class="fa fa-trash fa-lg"></i>
      </button>
    </div>
  </td>
</template>
<script>
import VuetableFieldMixin from "vuetable-2/src/components/VuetableFieldMixin.vue";

export default {
  name: "vuetable-field-buttons",
  mixins: [VuetableFieldMixin],

  methods: {
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