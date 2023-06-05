<?php $this->load->view('auth/templates/header') ?>

<main class="container">
   <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-8 mx-auto">
         <div class="card card-signin my-5">
            <div class="card-body">
               <h5 class="card-title text-center">Register</h5>

               <!-- Alert -->
               <div class="row">
                  <div class="col">
                     <?php if ($this->session->flashdata('message')) : ?>
                        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                           <?= $this->session->flashdata('message') ?>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                     <?php endif ?>
                  </div>
               </div>

               <?= form_open("auth/register", ["class" => "form-signin"]) ?>
               <div class="row">
                  <div class="col">
                     <div class="form-label-group">
                        <input type="test" name="first_name" id="inputFirstName" value="<?= set_value('first_name'); ?>" class="form-control" placeholder="Frist Name">
                        <label for="inputFirstName">Frist Name</label>
                        <?= form_error('first_name', '<small class="error-input">', '</small>'); ?>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-label-group">
                        <input type="test" name="last_name" id="inputLastName" value="<?= set_value('last_name'); ?>" class="form-control" placeholder="Last Name">
                        <label for="inputLastName">Last Name</label>
                        <?= form_error('last_name', '<small class="error-input">', '</small>'); ?>
                     </div>
                  </div>
               </div>

               <div class="form-label-group">
                  <input type="text" name="username" value="<?= set_value('username'); ?>" class="form-control" id="inputUsername" placeholder="Username" autofocus>
                  <label for="inputUsername">Username</label>
                  <?= form_error('username', '<small class="error-input">', '</small>'); ?>
               </div>

               <div class="form-label-group">
                  <input type="email" name="email" value="<?= set_value('email'); ?>" class="form-control" id="inputEmail" placeholder="Email" autofocus>
                  <label for="inputEmail">Email</label>
                  <?= form_error('email', '<small class="error-input">', '</small>'); ?>
               </div>

               <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" value="<?= set_value('password'); ?>" class="form-control" placeholder="Password">
                  <label for="inputPassword">Password</label>
                  <?= form_error('password', '<small class="error-input">', '</small>'); ?>
               </div>

               <div class="form-label-group">
                  <input type="password" name="confirmationPassword" id="inputconfirmationPassword" value="<?= set_value('confirmationPassword'); ?>" class="form-control" placeholder="Confirmation Password">
                  <label for="inputconfirmPassword">Konfirmasi Password</label>
                  <?= form_error('confirmationPassword', '<small class="error-input">', '</small>'); ?>
               </div>

               <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign Up</button>

               <hr class="my-4">

               <div class="text-center mt-1">
                  <a href="<?= base_url('auth/login') ?>">already have an account? login </a>
               </div>

               <?= form_close() ?>
            </div>
         </div>
      </div>
   </div>
</main>

<?php $this->load->view('auth/templates/footer') ?>