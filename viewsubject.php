<?php session_start();
include "include/no-cache.php";
include "include/check-login.php";
include "include/menu.php";
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <h3 class="page-header">Subjects Details</h3>
            <table id="editable_table" class="table table-bordered">
                <thead>
                    <th style="text-align:center;font-size:12px;">SL NO </th>
                    <th style="text-align:center;font-size:12px;">COURSE NAME </th>
                    <th style="text-align:center;font-size:12px;">SUBJECT NAME </th>
                    <th style="text-align:center;font-size:12px;">FULL MARKS </th>
                    <th style="text-align:center;font-size:12px;" colspan="2">ACTION </th>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>



        </div>



    </div>

</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class=" modal-title p-2">Update Student</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form class="col-sm" id="myform">
                    <div>
                        <input type="text" class="form-control" id="m-stuid" style="display: none;" />
                        <label for="nameid" class="form-label">Name</label>
                        <input type="text" class="form-control" id="m-nameid" />
                    </div>
                    <div>
                        <label for="emailid" class="form-label">Email</label>
                        <input type="email" class="form-control" id="m-emailid" />
                    </div>
                    <div>
                        <label for="passwordid" class="form-label">Password</label>
                        <input type="password" class="form-control" id="m-passwordid" />
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success myWish" id="m-btnadd" data-dismiss="modal">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end Modal -->



<?php include('include/footer.php'); ?>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {

        showdata();

        $("tbody").on("click", ".btn-del", function() {
            let id = $(this).attr("data-sid");
            // console.log(id);
            mythis = this;
            $.ajax({
                url: "deleteSubject.php",
                method: "POST",
                data: {
                    'id': id
                },
                success: function(data) {
                    // console.log(data);
                    if (data) {
                        alert("Delete Successfully");
                        $(mythis).closest("tr").fadeOut();
                    } else {
                        alert("Unable to Delete !");
                    }
                },
            });
        });


        $("tbody").on("click",".btn-edit",function(){
            let id = $(this).attr("data-sid");
            window.location="editsubject.php?id="+id;
        })








    });

    function showdata() {

        output = "";
        $.ajax({
            url: "retrieveSubject.php",
            method: "GET",
            dataType: "json",
            success: function(data) {
                // console.log(data);
                if (data) {
                    x = data;
                } else {
                    x = "";
                }
                for (i = 0; i < x.length; i++) {
                    output +=
                        "<tr><td>" +
                        (i+1) +
                        "</td><td>" +
                        x[i].cname +
                        "</td><td>" +
                        x[i].subject +
                        "</td><td>" +
                        x[i].full_marks +
                        "</td><td> <button  class='btn btn-warning btn-sm btn-edit' data-toggle='modal' data-target='#myModal'  data-sid=" + x[i].sid + ">Edit</button> <button class='btn btn-danger btn-sm btn-del' data-sid=" +
                        x[i].sid +
                        ">Delete</button></td></tr>";
                }
                $("#tbody").html(output);
            },
        });
    }
</script>