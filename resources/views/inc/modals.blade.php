<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body font-weight-bold text-danger" id="body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="deleteData()" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    var formId = undefined;
    
    function showModalWarning(_dataId, _message, _formId) {
        // console.log(dataId, message, formId);
        formId = _formId;
        document.getElementById("title").innerHTML = "Delete #ID: " + _dataId;
        document.getElementById("body").innerHTML = "Are you sure you wan't to delete " + _message;
    }

    function deleteData() {
        document.getElementById(formId).submit();
    }
    </script>