<div class="row mt-4" style="margin-top: 15px;">
  <div class="col-lg-4 col-lg-offset-4 text-center" >
    <img src="<?php echo base_url();?>assets/img/favicon.png"" width="100" heigth="100"alt="">
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-lg-offset-4 text-venter">
      <h1>Arbolado ADM</h1>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-lg-offset-4">
      <h3>Bienvenido</h1>
      <?php $fattr = array('class' => 'form-signin');
          echo form_open(site_url().'main/login/', $fattr); ?>
      <div class="form-group">
        <?php echo form_input(array(
            'name'=>'email', 
            'id'=> 'email', 
            'placeholder'=>'Nickname', 
            'class'=>'form-control', 
            'value'=> set_value('email'))); ?>
        <?php echo form_error('email') ?>
      </div>
      <div class="form-group">
        <?php echo form_password(array(
            'name'=>'password', 
            'id'=> 'password', 
            'placeholder'=>'Contraseña', 
            'class'=>'form-control', 
            'value'=> set_value('password'))); ?>
        <?php echo form_error('password') ?>
      </div>
      <?php if($recaptcha == 'yes'){ ?>
      <div style="text-align:center;" class="form-group">
          <div style="display: inline-block;"><?php echo $this->recaptcha->render(); ?></div>
      </div>
      <?php
      }
      echo form_submit(array('value'=>'Entrar', 'class'=>'btn btn-lg btn-success btn-block')); ?>
      <?php echo form_close(); ?>
      <br>
      <!-- <p>No registrado? <a href="<?php //echo site_url();?>main/register">Registrarse</a></p>
      <p>Olvido su contraseña? <a href="<?php //echo site_url();?>main/forgot">Olvide mi contraseña</a></p> -->
  </div>
</div>