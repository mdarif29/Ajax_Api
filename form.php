<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apis with jquery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
       

        <link href="https://code.jquery.com/jquery-3.7.0.js" rel="stylesheet"> 
        <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
        
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
    

<style>
     .red-color {
        color:red;
    }
    .teal-color{
        color:teal;
    }
</style>
    
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-3">
            <div class="card mt-5">
            <div class="card-header">
                    <center><b>Crud-Api with jquery</b></center>
            </div>
                    <div class="card-body">
                        <form id="Masterform" action="#" >
               
                            <div class=" mb-3 mt-3">
                                <!-- <label for="Name" class="form-label">Name:</label> -->
                                <input type="hidden" class="form-control" id="Empid" placeholder="" name="name" readonly >
                            </div>

                            <div class=" mb-3 mt-3">
                                <label for="Name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="Empname" placeholder="Enter name" name="name" required>
                            </div>



                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="Empemail" placeholder="Enter email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Mobile:</label>
                                <input type="text" class="form-control" id="Empmob" placeholder="Enter mobile" name="mobile" required>
                            </div>
                            <input type="submit" value="SAVE" class="btn btn-primary float-end mt-4" id="btnsubmit">
                
                   
               

                            
           
                        </form>
                    </div>
                    <div class="table-responsive" id="restable"></div>
        </div>
            </div>
        </div>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        Name: $("#Empname").focus();
        ShowData();
        // console.log( "ready!" );
        $("#Masterform").submit(function (e) {
            e.preventDefault();
            $.post("operations.php", {
                Flag: 'Insert',
                idEmp: $("#Empid").val(),
                Name: $("#Empname").val(),
                Email: $("#Empemail").val(),
                Mobile: $("#Empmob").val()
            }, function (data, success) {
               alert('data added successfully!');
                console.log(data);
                ShowData();
                Refresh();

            });


        });
    });

    function ShowData()
    {

        $.post("operations.php",{
            Flag: 'Showdata'
        },function(data,success){
                console.log(data);              
                // alert(data);

                $("#tblShow").dataTable(
                    {
                        "destroy" : true ,
                        responsive: true
                    });
                $("#restable").html(data);
                new DataTable('#tblShow');
                
        });

    }


    function Refresh()
    {
        $("#Empid").val("");
        $("#Empname").val("");
        $("#Empmob").val("");
        $("#Empemail").val("");
        $("#btnsubmit").val("SAVE");
        $("#Empname").focus();

    }

    function ShowInEditor(idEmp)
    {
        // alert(idEmp);
        $("#Empid").val(idEmp);
        $("#Empname").val($("#tdFirstName"+idEmp).text());
        $("#Empmob").val($("#tdPhone"+idEmp).text());
        $("#Empemail").val($("#tdEmail"+idEmp).text()); 
        $("#btnsubmit").val("Update");  
        
     
        
    }
    

    function DeleteRecords(idEmp)
    {
    var c=confirm("do u want to delete records");
    if(c)
    {
        $.post("operations.php",{
        Flag:"DeleteRecords",
        idEmp:idEmp
    },function(data,success){ 
    //  console.log(data);
        //alert(data);
       
        ShowData();
       
    });
    }
    }
</script>

</html>
