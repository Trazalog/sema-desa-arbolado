<div class="col-lg-4 col-lg-offset-4">
    <h2>Ya casi!</h2>
    <h5>Hola <span><?php echo $firstName; ?></span>. <br>Tu usuario es <span><?php echo $email;?></span>.</h5>
    <small>Por favor inserte una contraseña para terminar</small>
    <br>
    <br>
<?php 
    $fattr = array('class' => 'form-signin');
    echo form_open(site_url().'main/complete/token/'.$token, $fattr); ?>
    <div class="form-group">
      <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Contraseña', 'class'=>'form-control', 'value' => set_value('password'))); ?>
      <?php echo form_error('password') ?>
    </div>
    <div class="form-group">
      <?php echo form_password(array('name'=>'passconf', 'id'=> 'passconf', 'placeholder'=>'Confirmar Contraseña', 'class'=>'form-control', 'value'=> set_value('passconf'))); ?>
      <?php echo form_error('passconf') ?>
    </div>
    <?php echo form_hidden('user_id', $user_id);?>
    <?php echo form_submit(array('value'=>'Completar', 'class'=>'btn btn-lg btn-success btn-block')); ?>
    <?php echo form_close(); ?>
   
</div>