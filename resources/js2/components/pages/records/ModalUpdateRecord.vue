<template>
  <div>
    <div class="modal fade" id="updateRecordModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Update Records</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
            <p>
              Date: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <strong>{{item.date}}</strong>
              <br />Item id: &nbsp;&nbsp;
              <strong>{{item.item_id}}</strong>
              <br />Item: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <strong>{{item.item}}</strong>
              <br />
            </p>

            <div class="form-group">
              <div v-if="item.record_type == 'add'">
                <label>Update Additionals valu:</label>
                <div class="input-group mb-3">
                  <input v-model="item.ADD" type="text" class="form-control" />
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{item.unit}}</span>
                  </div>
                </div>
              </div>
              <div v-else-if="item.record_type == 'in'">
                <label>Update IN value:</label>
                <div class="input-group mb-3">
                  <input v-model="item.IN" type="text" class="form-control" />
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{item.unit}}</span>
                  </div>
                </div>
              </div>
              <div v-else-if="item.record_type == 'out'">
                <label for="out">Update Out Value:</label>
                <div class="input-group mb-3">
                  <input v-model="item.OUT" type="text" class="form-control" />
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{item.unit}}</span>
                  </div>
                </div>
                <label>Update Bones Value:</label>
                <div class="input-group mb-3">
                  <input v-model="item.bones_value" type="text" class="form-control" />
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Grams</span>
                  </div>
                </div>
                <label>Update Scrap Value:</label>
                <div class="input-group mb-3">
                  <input v-model="item.scraps_value" type="text" class="form-control" />
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Grams</span>
                  </div>
                </div>
              </div>
              <br />
              <div class="text-center">
                <button @click="updateRecord()" class="btn btn-info">Update This Record</button>
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
      item: {}
    };
  },
  methods: {
    updateRecord(){
      LoadingOverlay();
      axios.post("/records/update",this.item)
      .then(res => {
        console.log(res);
        $("#updateRecordModal").modal("hide");
        LoadingOverlayHide();
      })
      .catch(err => {
        $("#updateRecordModal").modal("hide");
        console.error(err); 
      })
    }
  },
  events: {
    updateRecordModal(data) {
      console.log(data);
      this.item = data;
      $("#updateRecordModal").modal("show");
    }
  }
};
</script>