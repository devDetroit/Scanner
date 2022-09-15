<form method="POST" v-on:submit.prevent="deleteScanner()">
  @csrf
  <div class="modal fade" id="eliminar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Eliminar</h4>
        </div>
        <div class="modal-body">
          <template v-if="scannerData">
            <div class="form-group">
              <label> Are you sure you want to delete Scanner
                <span><i> @{{ scannerData.description }} </i></span> ?
              </label>
            </div>
          </template>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal"></button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</form>