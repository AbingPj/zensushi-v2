<template>
  <div>
    <div class="modal fade" id="deleteRecordModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Delete Record</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <p>
              Are you sure you want to delete this record:
              <br />Item:&nbsp;[ &nbsp;
              <b>{{ item.item }}</b> &nbsp;]
            </p>
            <div v-if="item.record_type == 'add'">
              <p>
                Additionals: &nbsp;&nbsp;
                <strong>{{item.ADD}}</strong>
                <br />
              </p>
            </div>
            <div v-else-if="item.record_type == 'in'">
              <p>
                IN: &nbsp;&nbsp;
                <strong>{{item.IN}}</strong>
                <br />
              </p>
            </div>
            <div v-else-if="item.record_type == 'out'">
              <p>
                OUT: &nbsp;&nbsp;
                <strong>{{item.OUT}}</strong>
                <br />
                 BONES: &nbsp;&nbsp;
                <strong>{{item.BONES}}</strong>
                <br />
                 SCRAP: &nbsp;&nbsp;
                <strong>{{item.SCRAPS}}</strong>
                <br />
              </p>
            </div>
            <center>
              <button @click="deleteRecord()" class="btn btn-danger" data-dismiss="modal" >Yes</button>
              <button class="btn btn-secondary" data-dismiss="modal">No</button>
            </center>
          </div>

          <!-- Modal footer -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      item: []
    };
  },
  methods: {
    deleteRecord(){
      LoadingOverlay();
      axios.post("/records/delete",this.item)
      .then(res => {
        console.log(res)
         LoadingOverlayHide();
      })
      .catch(err => {
        console.error(err); 
         LoadingOverlayHide();
      })
    }

  },

 
  events: {
    deleteRecordModal(data) {
      console.log(data);
      this.item = data;
      $("#deleteRecordModal").modal("show");
    }
  }
};
</script>