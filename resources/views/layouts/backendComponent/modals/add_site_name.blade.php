<!-- Edit Site Name Modal -->
<div class="modal fade" id="editSiteNameModal" tabindex="-1" aria-labelledby="editSiteNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSiteNameModalLabel">Edit Site Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="siteNameInput" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveSiteName" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    // Open modal and set input value
    $("#editSiteName").click(function () {
        $("#siteNameInput").val($("#siteNameLabel").text());
        $("#editSiteNameModal").modal("show");
    });

    // Save button inside modal
    $("#saveSiteName").click(function () {
        let newName = $("#siteNameInput").val().trim();
        if (newName) {
            $("#siteNameLabel").text(newName);
            $("#editSiteNameModal").modal("hide");
        }
    });
});
</script>
