<?php

/* Template Name: table_session Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
?>

<?php
if(isset($_POST['date'])){

    $code_formation = $_POST['code_formation'];
    $date = $_POST['date'];
    $code_formateur = $_POST['code_formateur'];
    $id = $_POST['id'];

    $sql = "update session set code_formation = '$code_formation',
    date = '$date',
    code_formateur = '$code_formateur'
    where id_session = '$id'";
    
    $res = mysqli_query($con,$sql);
    if($res){
        header(
            "Location: http://localhost/brnsmart/table_session"
        );
    }
}

?>
<?php
$msg = '';
if (isset($_REQUEST["create"])) 
{
    $code_formation = stripslashes($_REQUEST["code_formation"]);
    $code_formation = mysqli_real_escape_string($con, $code_formation);
    $date = stripslashes($_REQUEST["date"]);
    $date = mysqli_real_escape_string($con, $date);
    $code_formateur = stripslashes($_REQUEST["code_formateur"]);
    $code_formateur = mysqli_real_escape_string($con, $code_formateur);
    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT into `session` (code_formation,date,code_formateur,create_datetime)
    VALUES (
        '$code_formation','$date','$code_formateur',
        '$create_datetime')";
    $result = mysqli_query($con, $query);
}

?>
<style>
    <?php include "css/styling.css"; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Table-Session</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js">
    </script>
    
    <style>
        
        .conta {
            background-size: cover;
            margin-top: -20px;
            margin-left: 440px;
        }

        .download {
            margin-top: -35px;
            margin-left: 970px;

        }
        .tabling {
            margin-left: -135px;
        }
        #myModal {
            margin-top: 80px;
        }
        #updateModal {
            margin-top: 100px;
        }
    </style>
    
</head>
<body class="sb-nav-fixed " style="
overflow-x: hidden;">
<main>
    <div class="conta">
        <div class="row" style="margin-top: 70px;">
            <div class="col-md-10 col-md-offset-1" >
                <div class="tabling">
                    <table class="table">
                        <div>
                            <button type="button" data-bs-target="#myModal" data-bs-toggle="modal" class="btn btn-primary ajouting">Ajouter Formation</button>
                        </div>
                        <div>
                            <a href="http://localhost/brnsmart/telecharger_session">
                                <button type="button" class="btn btn-warning pull-right download" name="download" style="float:right; margin-top: -35px;margin-right: -20 px">Télécharger</button>
                            </a>
                        </div>
                    </main>
                    <hr><br>
                    <div id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" class="row g-3">
                                        <div class="input-group col-md-6">
                                            <span class="input-group-text col-md-5">Code Formation</span>
                                            <select name="code_formation" required class="form-control">
                                              <option value="" disabled selected hidden>Veuiller indiquer votre formation</option>
                                              <?php 
                                              $sql = "Select * from liste_formation";
                                              $result = mysqli_query($con,$sql);
                                              $num = mysqli_num_rows($result);
                                              if($result){
                                                if ($num>0){
                                                    while($row=mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <option value="<?php echo $row["code_formation"]; ?>">
                                                            <?php echo $row["code_formation"];?>
                                                        </option>
                                                        <?php 
                                                    }}}
                                                    ?>
                                                </select>
                                            </div><br>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-text col-md-5">Date</span>
                                                <input type="date" required name="date" class="form-control" placeholder="Date">
                                            </div><br>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-text col-md-5">Code Formateur</span>
                                                <input type="text" required name="code_formateur" class="form-control" placeholder="code_formateur" >
                                            </div><br>
                                            <div class="modal-footer">
                                                <div class="col-xs-6 col-md-2">
                                                    <button type="submit" class="btn btn-primary" name="create">
                                                     Ajouter
                                                 </button>
                                             </div></div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div id="updateModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="" class=" row g-3">
                                            
                                            <div class="input-group col-md-6">
                                                <span class="input-group-text col-md-5">Code Formation</span>
                                                <input type="text"  name="code_formation" class="form-control" placeholder="code_formation" autocomplete="rutjfkde"
                                                id="code_formation" value="">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-text col-md-5">Date</span>
                                                <input type="date"  name="date" class="form-control" placeholder="Date" id="date">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-6">
                                                <span class="input-group-text col-md-5">Code Formateur</span>
                                                <input type="text"  name="code_formateur" class="form-control" placeholder="code_formateur" id="code_formateur">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-6">
                                                <input type="hidden"  name="id" class="form-control" placeholder="Formation" id="id">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-xs-6 col-md-2">
                                                    <button type="submit" class="btn btn-primary" id="save" name="modifier">
                                                     Modifier
                                                 </button>
                                             </div></div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         

                         <div class="col-md-12 text-center">
                            <br>
                            <?php echo $msg; ?>
                            <p style="color: red;">Rechercher</p>
                            <input type="text" placeholder="Rechercher"
                            name="rechercher" class="form-control" id="rechercher" autocomplete="off">
                        </div>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr class="table-primary">
                                  <th class="">ID</th>
                                  <th class="">Code Formation</th>
                                  <th class="">Date</th>
                                  <th class="">Code Formateur</th>
                                  <th class="">Date de création</th>
                                  <th class="">Modifier</th>
                                  <th class="">Supprimer</th>
                                  <th class="">Archiver</th>
                              </tr>
                          </thead>
                          <tbody id="table">
                            <?php
                            $sql = "Select * from session";
                            $result = mysqli_query($con,$sql);
                            $num = mysqli_num_rows($result);
                            if ($num>0){
                                while($row=mysqli_fetch_assoc($result)) {
                                    echo "  
                                    <tr style='vertical-align: middle;' id='" . $row["id_session"] ."'>
                                    <td class='table-secondary' data-bs-target='id'>" . $row["id_session"] ."</td>
                                    <td class='table-success' data-bs-target='code_formation'>" . $row["code_formation"] . "</td>
                                    <td class='table-danger' data-bs-target='date'>" . $row["date"] . "</td>
                                    <td class='table-info' data-bs-target='code_formateur'>" . $row["code_formateur"] . "</td>
                                    <td  class='table-danger' >" . $row["create_datetime"] . "</td>
                                    <td>
                                    <a class='btn btn-primary btn-sm edit'
                                    data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id_session"]. " 
                                    data-role='update'>Modifier</a>
                                    </td>
                                    <td>
                                    <a class='btn btn-danger btn-sm'
                                    href='
                                    http://localhost/brnsmart/supprimer_session?supprimer=
                                    " .$row["id_session"]. " '>Supprimer</a>
                                    </td>
                                    <td>
                                    <a class='btn btn-warning btn-sm'
                                    href='
                                    http://localhost/brnsmart/archiver_session?archiver=
                                    " .$row["id_session"]. "' name='archiver' type='button'>Archiver</a>
                                    </td>
                                    </tr>"; 
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>   
<script>
 $(document).ready(function(){
     $(document).on('click','a[data-role=update]', function(){
         var id = $(this).data('id');
         var code_formation = $('#'+id).children('td[data-bs-target=code_formation]').text();
         var date = $('#'+id).children('td[data-bs-target=date]').text();
         var code_formateur = $('#'+id).children('td[data-bs-target=code_formateur]').text();

         $('#code_formation').val(code_formation);
         $('#date').val(date);
         $('#code_formateur').val(code_formateur);
         $('#id').val(id);    
     });

   //get data and update in db
   $('#save').click(function(){
     var id = $('#id').val();
     var code_formation = $('#code_formation').val();
     var date = $('#date').val();
     var code_formateur = $('#code_formateur').val();

     $.ajax({
        url: 'http://localhost/brnsmart/table_session',
        method: 'POST',
        data : {code_formation : code_formation, date: date, code_formateur : code_formateur, id : id},
        success : function(response){
        //update records in table
        $('#'+id).children('td[data-bs-target=code_formation]').text(code_formation);
        $('#'+id).children('td[data-bs-target=date]').text(date);
        $('#'+id).children('td[data-bs-target=code_formateur]').text(code_formateur);
        $('#updateModal').modal('toggle');

    }
});

 });
});


 
</script>
<script>
  $(document).ready(function(){
     $('#rechercher').on("keyup", function(){
       var rechercher = $(this).val();
       $.ajax({
         method:'POST',
         url:'http://localhost/brnsmart/rechercher_session',
         data:{recherche:rechercher},
         success:function(response)
         {
            $("#table").html(response);
        } 
    });
   });
 });
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>



</html>
