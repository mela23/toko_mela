<h2>Data Member</h2>  <a href="index.php?halaman=tambah_member" class="btn btn-primary col-md-offset-5">Tambah member</a>
<?php 
$data_member = $member->tampil_member()
?>

 <table class="table table-bordered thetable">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama</th>
 			<th>Email</th>
 			<th>Alamat</th>
 			<th>Telepon</th>
 			<th>Foto</th>
 			<th>Tanggal lahir</th>
 			<th>Opsi</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php foreach ($data_member as $key => $value): ?>
 			
 		<tr>
 			<td><?php echo $key+1 ?></td>
 			<td><?php echo $value['nama_member'] ?></td>
 			<td><?php echo $value['email_member'] ?></td>
 			<td><?php echo $value['alamat_member'] ?></td>
 			<td><?php echo $value['telp_member'] ?></td>
 			<td>
 				<img src="../assets/img/member/<?php echo $value['foto_member']; ?>" width="200">
 			</td>
 			<td><?php echo $value['tgl_lhr']?></td>
 			<td>
 				<a href="index.php?halaman=ubah_member&id_member= <?php echo $value['id_member']; ?>" class="fa fa-edit btn btn-warning"></a>
 				<a href="index.php?halaman=hapus_member&id_member= <?php echo $value['id_member']; ?>" class="fa fa-trash btn btn-danger" onclick="return confirm('hapus member?') "></a>
 			</td>
 		</tr>
 		<?php endforeach ?>
 	</tbody>
 	
 </table>
 