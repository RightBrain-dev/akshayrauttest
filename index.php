
<?php
require_once("autoload.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=$css?>">
    <link rel="stylesheet" href="<?=$guestCss?>">
    <script src="<?=$js?>"></script>
    <script src="<?=$guestJS?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>labour Management</title>
</head>
<body>
    <div class="container-float">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center flex-column   my-flex">
                    <div class="item1" id="item1">
                    </div>
                    <div class="item2" id="item2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" id="myBtn">
                            Add Member
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Member</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="newMemberForm" method="POST">
                <div class="form-group">
                    <label for="parent">Parent</label>
                    <select class="form-control form-control-sm" id="parentList">
                    </select>
                </div>
                <div class="form-group">
                    <label for="UserName">Name</label>
                    <input type="text" class="form-control form-control-sm" id="UserName" placeholder="Name">
                </div>
                <small id="NameHelp" class="form-text text-danger"></small>
                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    <button type="submit" id="saveMemberbtn" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>

<script>
    var apiBaseUrl = "<?=$apiBaseUrl?>";
    $('#exampleModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>
</body>
</html>