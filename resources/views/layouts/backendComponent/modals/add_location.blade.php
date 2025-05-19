<!-- Edit Site Location Modal -->
<div class="modal fade" id="editSiteLocationModal" tabindex="-1" aria-labelledby="editSiteLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSiteLocationModalLabel">Edit Site Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="siteLocationInput" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveSiteLocation" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Open modal and set input value
        $("#editSiteLocation").click(function () {
            $("#siteLocationInput").val($("#siteLocation").text());
            $("#editSiteLocationModal").modal("show");
        });

        // Save button inside modal
        $("#saveSiteLocation").click(function () {
            let newLocation = $("#siteLocationInput").val().trim();
            if (newLocation) {
                $("#siteLocation").text(newLocation);
                $("#editSiteLocationModal").modal("hide");
            }
        });
    });

</script>