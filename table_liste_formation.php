<?php

/* Template Name: table_liste_formation Page */

session_start();
require "db.php";
require "include/functions.php"; 
require "include/Session.php";

Confirm_loginAdmin();
?>
<?php
if(isset($_POST['code_formation'])){

    $id_formation = $_POST['id_formation'];
    $code_formation = $_POST['code_formation'];
    $id = $_POST['id'];

    $sql = "update liste_formation set id_formation = '$id_formation',
    code_formation = '$code_formation'
    where id = '$id'";
    
    $res = mysqli_query($con,$sql);
    if($res){
        header(
            "Location: http://localhost/brnsmart/table_liste_formation"
        );
    }
}

?>
<?php
$msg = '';
if (isset($_REQUEST["create"])) 
{
    $code_formation = $_POST['code_formation'];
    $id_formation = $_POST['id_formation'];
    $create_datetime = date("Y-m-d H:i:s");

    $query = "INSERT into `liste_formation` (id_formation,code_formation, create_datetime)
    VALUES ('$id_formation','$code_formation',
        '$create_datetime')";
    $result = mysqli_query($con, $query);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />


    <title>Table-Liste-Formation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js">
    </script>
    
    <style>
        
        .conta {
            background-size: cover;
            margin-top: -20px;
            margin-left: 160px;
        }

        .download {
            margin-top: -35px;
            margin-left: 970px;

        }
        .tabling {
            margin-left: -135px;
        }
    </style>
    
</head>
<body style=" overflow-x: hidden;margin-left: 160px; ">
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
                                <a href="http://localhost/brnsmart/telecharger_liste_formation">
                                    <button type="button" class="btn btn-warning pull-right download" name="download" style="float:right; margin-top: -35px;margin-right: -20 px">Télécharger</button>
                                </a>
                            </div>
                        </main>
                        <hr><br>
                        <div id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="" class="row g-3">
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-5">id_formation</span>
                                                <input type="text" required name="id_formation" class="form-control" placeholder="id_formation">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-5">code_formation</span>
                                                <input type="text" required name="code_formation" class="form-control" placeholder="code_formation">
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        <h4 class="modal-title"></h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="" class=" row g-3">
                                            <br>

                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-5">id_formation</span>
                                                <input type="text"  name="id_formation" class="form-control" placeholder="id_formation" id="id_formation">
                                            </div>
                                            <br>
                                            <div class="input-group col-md-12">
                                                <span class="input-group-text col-md-5">code_formation</span>
                                                <input type="text"  name="code_formation" class="form-control" placeholder="code_formation" id="code_formation">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="hidden" id="id" class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-xs-6 col-md-2">
                                                    <button type="submit" class="btn btn-primary" id="save" name="modifier">
                                                     Modifier
                                                 </button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="col-md-12 text-center">
                        <br>
                        <?php echo $msg; ?>
                        <p style="color: red;">Rechercher</p>
                        <form action="search.php" method="post" class="form-group">
                            
                            <input type="text" placeholder="Rechercher"
                            name="search" class="form-control" id="rechercher">
                        </form>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="table-primary">
                              <th class="">ID</th>  
                              <th class="">ID Formation</th>
                              <th class="">Code Formation</th>
                              <th class="">Date de création</th>
                              <th class="">Modifier</th>
                              <th class="">Supprimer</th>
                          </tr>
                      </thead>
                      <tbody id="table">
                        <?php
                        $sql = "Select * from liste_formation";
                        $result = mysqli_query($con,$sql);
                        $num = mysqli_num_rows($result);
                        if ($num>0){
                            while($row=mysqli_fetch_assoc($result)) {
                                echo "  
                                <tr style='vertical-align: middle;' id='" . $row["id"] ."'>
                                <td class='table-secondary' data-bs-target='id'>" . $row["id"] ."</td>
                                <td class='table-secondary' data-bs-target='id_formation'>" . $row["id_formation"] ."</td>
                                <td class='table-success' data-bs-target='code_formation'>" . $row["code_formation"] . "</td>
                                <td class='table-secondary'>" . $row["create_datetime"] . "</td>
                                <td>
                                <a class='btn btn-primary btn-sm edit'
                                data-bs-target='#updateModal' data-bs-toggle='modal' data-id=" .$row["id"]. " 
                                data-role='update'>Modifier</a>
                                </td>
                                <td>
                                <a class='btn btn-danger btn-sm'
                                href='
                                http://localhost/brnsmart/supprimer_liste_formation?supprimer=
                                " .$row["id_formation"]. " '>Supprimer</a>
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
         var id_formation = $('#'+id).children('td[data-bs-target=id_formation]').text();
         var code_formation = $('#'+id).children('td[data-bs-target=code_formation]').text();

         $('#id_formation').val(id_formation);
         $('#code_formation').val(code_formation);
         $('#id').val(id);    
     });
     $('#save').click(function(){
         var id = $('#id').val();
         var id_formation = $('#id_formation').val();
         var code_formation = $('#code_formation').val();

         $.ajax({
            url: 'http://localhost/brnsmart/table_liste_formation',
            method: 'POST',
            data : {id_formation : id_formation, code_formation: code_formation,id : id},
            success : function(response){
               $('#'+id).children('td[data-bs-target=id_formation]').text(id_formation);
               $('#'+id).children('td[data-bs-target=code_formation]').text(code_formation);
               $('#updateModal').modal('toggle');

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
<script>
  $(document).ready(function(){
     $('#rechercher').on("keyup", function(){
       var rechercher = $(this).val();
       $.ajax({
         method:'POST',
         url:' http://localhost/brnsmart/rechercher_liste_formation',
         data:{recherche:rechercher},
         success:function(response)
         {
            $("#table").html(response);
        } 
    });
   });
 });
</script>
</html>
