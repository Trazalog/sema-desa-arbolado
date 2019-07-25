    <div class="container">
        <h2>Usuarios</h2>
        <table class="table table-hover table-bordered table-striped">
          <tr>
              <th>
                  Nombre
              </th>
              <th>
                 Nombre de Usuario
              </th>
              <th>
                  Ultimo Login
              </th>
              <th>
                  Rol
              </th>
              <th>
                  Estado
              </th>
              <th colspan="2">
                  Editar
              </th>
          </tr>
                <?php
                    foreach($groups as $row)
                    { 
                    if($row->role == 1){
                        $rolename = "Admin";
                    }elseif($row->role == 2){
                        $rolename = "Sensista";
                    }elseif($row->role == 3){
                        $rolename = "Editor";
                    }elseif($row->role == 4){
                        $rolename = "Sensista";
                    }
                    
                    echo '<tr>';
                    echo '<td>'.$row->first_name.'</td>';
                    echo '<td>'.$row->email.'</td>';
                    echo '<td>'.$row->last_login.'</td>';
                    echo '<td>'.$rolename.'</td>';
                    echo '<td>'.$row->status.'</td>';
                    echo '<td><a href="'.site_url().'main/changelevel"><button type="button" class="btn btn-primary">Rol</button></a></td>';
                    echo '<td><a href="'.site_url().'main/deleteuser/'.$row->id.'"><button type="button" class="btn btn-danger">Eliminar</button></a></td>';
                    echo '</tr>';
                    }
                ?>
        </table>
    </div>