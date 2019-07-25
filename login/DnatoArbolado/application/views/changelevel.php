<div class="col-lg-4 col-lg-offset-4">
    <h2>Cambiar Rol</h2>
    <h5>Hola <span><?php echo $first_name; ?></span>, <br>Por favor elija el rol que desea asignar</h5>     
    <?php $fattr = array('class' => 'form-signin');
         echo form_open(site_url().'main/changelevel/', $fattr); ?>
    
    <div class="form-group">
        <select class="form-control" name="email" id="email" onchange="Actualiza();">
            <?php
            foreach($groups as $row)
            { 
              echo "<option data-json='".json_encode($row)."'value='".$row->email."'>".$row->email."</option>";
            }
            ?>
            </select>
    </div>

    <div class="form-group">
    <?php
        $dd_list = array(
                  '1'   => 'Admin',
                  '2'   => 'Sensista',
                );
        $dd_name = "level";
        echo form_dropdown($dd_name, $dd_list, set_value($dd_name),'class = "form-control" id="level"');
    ?>
    </div>
    <?php echo form_submit(array('value'=>'Hecho!', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <a href="<?php echo site_url().'main/users/';?>"><button type="button" class="btn btn-default btn-lg btn-block">Cancelar</button></a>
    <?php echo form_close(); ?>
</div>
<script>
function Actualiza()
{
  seleccionado = JSON.parse($('#email').children("option:selected").attr('data-json'));
  document.getElementById("level").value = seleccionado.role;
}
</script>