<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
      <div class="panel panel-success">
        <div class="panel-body">
          <?php 
          if(isset($_POST['daftar']))
          {
            $pass = $_POST['password'];
            $pass2 = $_POST['password_confirm'];
            $karakter_pass = strlen($pass);
            if ($karakter_pass >=4)
            {
              if ($pass == $pass2)
              {
                $hasil = $member->registrasi($_POST['nama'], $_POST['telp'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['alamat'], $_FILES['foto'], $_POST['tanggal']);
                if ($hasil == 'belum')
                {
                  echo "
                  <div class='alert alert-success'>Pendaftaran sukses<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>
                  ";
                }
                else
                  // jika belum == input ulang
                {
                  echo "<div class='alert alert-warning'>Username sudah ada<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                }
              }
              else
              {
                echo "<div class='alert alert-warning'>Password tidak sama<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
              }
            }
            else 
            {
              echo "<div class='alert alert-warning'>Password kurang dari 4<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }
          }
          ?>
          <form class="form-horizontal" action='' method="POST" enctype="multipart/form-data">
            <fieldset>
              <div id="legend">
                <legend class="">Daftar member</legend>
              </div>
              <div class="control-group">
                <!-- Username -->
                <label class="control-label col-sm-2"  for="username">Nama</label>
                <div class="controls col-sm-10">
                  <input type="text" name="nama" placeholder="" class="form-control" required>
                  <p class="help-block">Nama lengkap sesuai kartu identitas</p>
                </div>
              </div>
              
              <div class="control-group">
                <!-- E-mail -->
                <label class="control-label col-sm-2" for="email">Tanggal Lahir</label>
                <div class="controls col-sm-10">
                  <input type="date"  name="tanggal" placeholder="" class="form-control">
                  <p class="help-block">Tanggal lahir sesuaikartu identitas</p>
                </div>
              </div>
              
              <div class="control-group">
                <!-- Password-->
                <label class="control-label col-sm-2" for="username">Username</label>
                <div class="controls col-sm-10">
                  <input type="text" id="username" name="username" placeholder="" class="form-control" required>
                  <p class="help-block">Username</p>
                </div>
              </div>
              
              <div class="control-group">
                <!-- Password -->
                <label class="control-label col-sm-2"  for="email">E-mail</label>
                <div class="controls col-sm-10">
                  <input type="text" id="email" name="email" placeholder="" class="form-control">
                  <p class="help-block">E-mail</p>
                </div>
              </div>
              <div class="control-group">
                <!-- Password -->
                <label class="control-label col-sm-2"  for="password">Password</label>
                <div class="controls col-sm-10">
                  <input type="password" id="password" name="password" placeholder="" class="form-control">
                  <p class="help-block">Password</p>
                </div>
              </div>
              <div class="control-group">
                <!-- password -->
                <label class="control-label col-sm-2">Password (Confirm)</label>
                <div class="controls col-sm-10">
                  <input type="password" name="password_confirm" class="form-control">
                  <p class="help-block">Confirm password</p>
                </div>
              </div>
              <div class="control-group">
                <!-- Password -->
                <label class="control-label col-sm-2">Telp</label>
                <div class="controls col-sm-10">
                  <input type="number" id="telp" name="telp" placeholder="0823465" class="form-control">
                  <p class="help-block">Nomor telepon yang aktif</p>
                </div>
              </div>
              <div class="control-group">
                <!-- Password -->
                <label class="control-label col-sm-2">Alamat</label>
                <div class="controls col-sm-10">
                  <textarea class="form-control" placeholder="Jl. Cempaka" name="alamat"></textarea>
                  <p class="help-block">Alamat sesuaikartu identitas</p>
                </div>
              </div>
              <div class="control-group">
                <!-- Password -->
                <label class="control-label col-sm-2">Foto</label>
                <div class="controls col-sm-10">
                  <input type="file" id="password" name="foto" placeholder="">
                  <p class="help-block">Foto Terbaru</p>
                </div>
              </div>
              <div class="control-group">
                <!-- Button -->
                <div class="controls">
                  <button class="btn btn-success pull-right" name="daftar">Daftar</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div> 
      </div>
    </div>
  </div>
</div>