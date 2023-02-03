<form method="POST" v-on:submit.prevent="addScanner()">
  @csrf
  <div class="modal fade" id="agregar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add</h4>

          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="Folio">#</label>
                <input type="text" name="Folio" class="form-control" v-model="scanner.id" disabled>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="Descripcion">Description</label>
                <input type="text" name="Descripcion" class="form-control" v-model="scanner.description" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-row">
                <label for="Apertura">State</label>
                <select v-model="scanner.status" class="form-control" required>
                  <option value=0>Available</option>
                  <option value=1>In use</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-row">
                <label>Facility</label>
                <select v-model="scanner.facility_id" class="form-control" required>
                  <option v-for="facility in facilities" :value="facility.id">@{{ facility.name }}</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-row">
                <label for="Apertura">Status</label>
                <select v-model="scanner.active" class="form-control" required>
                  <option value=0>Inactive</option>
                  <option value=1>Active</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</form>