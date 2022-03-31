<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">

            <div class="login-box ">
                <!-- /.login-logo -->
                <div class=" card-outline">
                    <div class="card-header text-center">
                        <a href="#" class="h1"><b><?php echo APP_NAME;?></b></a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">Inicie su sesión</p>

                        <!--
                        <form action="../../index3.html" method="post">
                          <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                          </div>
                          <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                          </div>
                            <div class="col-12 p-0">
                              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                  Remember Me
                                </label>
                            </div>
                        </form>
                        -->

                        <?php echo form_open( 'auth/login', ['class' => 'std-form','id' => 'loginform'] ) ?>

                        <div class="input-group mb-3">

                            <?php
                            //esta variable se usa para definir los atributos del input como se hace habitualmente en html
                            $text_input = array(
                                'type' => 'text',
                                'name' => 'username',
                                'id' => 'username',
                                'class' => 'form_input form-control',
                                'placeholder' => 'Usuario'
                            );
                            ?>
                            <?php echo form_input($text_input); ?>


                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <?php echo form_error('username','<div class="text-error">','</div>') ?>
                        <div class="input-group mb-3">
                            <?php
                            //esta variable se usa para definir los atributos del input como se hace habitualmente en html
                            $text_input = array(
                                'type' => 'password',
                                'name' => 'password',
                                'id' => 'password',
                                'class' => 'form_input form-control',
                                'placeholder' => 'Contraseña'
                            );
                            ?>
                            <?php echo form_input($text_input); ?>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>


                        </div>
                        <?php echo form_error('password','<div class="text-error">','</div>') ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo form_submit('login', 'Login', ['class' => 'btn btn-primary'] ); ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>

                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="text-center text-danger">
                    <?php echo !empty($error)?$error:''; ?>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.login-box -->
        
    </div>
</div>


<script>

if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>


