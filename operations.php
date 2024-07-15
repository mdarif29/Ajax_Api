<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include_once('db.php') ;
$Flag = $_POST['Flag'];
if($Flag=='Insert')
{
    $idEmp = $_POST['idEmp'];
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Mobile = $_POST['Mobile'];
    print_r($_POST);

    if($idEmp == '')

    {
        if ( mysqli_query($conn,"Insert into tblemp (name,email,mobile,status) value('$Name','$Email','$Mobile','Active')"))
        {
            echo "inserted";
            // alert('data added successfully!');
        }
        else
        {
            echo "failed".mysqli_error($conn);
        }
        
    }
    else{
        if (mysqli_query($conn,"update tblemp set name='$Name',email='$Email',mobile='$Mobile' where  id='$idEmp'"))
        {
            echo "Updated";
        }
        else
        {
            echo "failed".mysqli_error($conn);
        }
        
    }



}

else if($Flag=='Showdata'){
    $rstFormData=mysqli_query($conn,"select * from tblemp where status='Active'");
    if(mysqli_num_rows($rstFormData)!=0)
    {
        echo "<table class='table table-hover center ' id='tblShow'>
        <thead>
            <tr>
                <th>Employee No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
 
           </tr>
        </thead>";
        while($rwFormData=mysqli_fetch_array($rstFormData,MYSQLI_ASSOC))
        {

            $idEmp=$rwFormData['id'];
            $name=$rwFormData['name'];
            $email=$rwFormData['email'];
            $mobile=$rwFormData['mobile'];
            // $empAddress=$rwFormData['empAddress'];
            $Status=$rwFormData['status'];


            echo "
            <tr>
              <td id='tdemployeeId$idEmp'>$idEmp</td>
              <td id='tdFirstName$idEmp'>$name</td>
              <td id='tdEmail$idEmp'>$email</td>
              <td id='tdPhone$idEmp'>$mobile</td>
             
             
              <td><button type='button' id='btnEdit' class='btn fas fa-edit teal-color'  onclick='ShowInEditor($idEmp);'>
             
            
              <button type='button' id='btnDeleteRecord'  class='btn fa-solid fa-trash-can red-color' value ='Delete' onclick='DeleteRecords($idEmp);'>
              </td>
           </tr>
              ";
        }   
        echo "</table>";
    }


}
else if($Flag=='DeleteRecords')
{
    $idEmp=$_POST['idEmp'];
    if(mysqli_query($conn,"update tblemp set status='Delete' where id='$idEmp'"))
    {
        echo "record deleted";
    }
    else{
        echo "record not deleted".mysqli_error($conn);
    }
}
?>
