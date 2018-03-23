<?php    
session_start();
$mysqli = new mysqli("localhost", "root","", "mela");

class produk 
{
	public $koneksi;
	function __construct ($x)
	{
		$this->koneksi= $x;
	}

	function tampil_produk()
	{
		$semua_data = array();
		$data = $this->koneksi->query("SELECT * FROM produk");
		while ($isi_table=$data->fetch_assoc())
		{
			$semua_data [] = $isi_table;
		}
		return $semua_data;
	}
	function simpan_produk($kategori, $produk,$harga, $berat, $stok, $deskripsi, $foto)
	{
		$nama_foto = $foto['name'];
		$lokasi = $foto ['tmp_name'];
		$nama_foto_costum = 'img_produk_'.date('YmdHis')."_".$nama_foto;

		move_uploaded_file($lokasi, "../assets/img/produk/$nama_foto_costum");

		$this->koneksi->query("INSERT INTO produk (nama_produk, harga_produk, berat_produk, stok_produk, foto_produk, deskripsi_produk, id_kategori) VALUES ('$produk', '$harga','$berat', '$stok', '$nama_foto_costum', '$deskripsi','$kategori' )");
	}
	function ambil_data_produk($id)
	{
		$data_produk =$this->koneksi->query("SELECT * FROM produk WHERE id_produk ='$id'");
		return $data_produk->fetch_assoc();
	}
	function ambil_produk($id_produk)
	{
		$ambil=$this->koneksi->query("SELECT * FROM produk WHERE id_produk = $id_produk");
		$pecah=$ambil->fetch_assoc();
		return $pecah;
	}
	function hapus_produk($id_produk)
	{
		// mengambil informasi produk
		$info=$this->ambil_produk($id_produk);
		$foto_hapus=$info['foto_produk'];
		unlink("../assets/img/produk/$foto_hapus");
		$this->koneksi->query("DELETE FROM produk WHERE id_produk = $id_produk");
	}
	function ubah_produk($kategori, $nama_produk, $harga, $berat, $stok, $deskripsi, $foto, $id_produk)
	{
		$nama_foto = $foto['name'];
		$waktu = date("YmdHis");
		$foto_fix = $waktu."_".$nama_foto;
		$lokasi = $foto['tmp_name']; 

		// mndapatkan ekstensi file
		$ekstensi = pathinfo($foto_fix, PATHINFO_EXTENSION);
		// ekstensi yg diperbolehkan
		$ekstensi_boleh = array("jpg", "png", "jpeg", "gif", "JPG", "JPEG", "PNG");

		// jika gambar diganti (di lokasi penyimpanan sementara tidak kosong)
		if (!empty($lokasi)) 
		{	
			// jika ekstensi file yg diupload ada di dlm ekstensi yg diperbolehkan
			if (in_array($ekstensi, $ekstensi_boleh)) 
			{
				// mengambil informasi produk
				$info = $this->ambil_produk($id_produk);


					// menghapus foto yg lama
				$foto_hapus = $info['foto_produk'];
				unlink("../assets/img/produk/$foto_hapus");

				// mengupload foto baru

				move_uploaded_file($lokasi, "../assets/img/produk/$foto_fix");

				$this->koneksi->query("UPDATE produk SET nama_produk='$nama_produk', harga_produk='$harga', berat_produk='$berat', stok_produk='$stok', deskripsi_produk='$deskripsi', id_kategori='$kategori', foto_produk='$foto_fix' WHERE id_produk='$id_produk' ")or die(mysql_error($this->koneksi));


				return "sukses";

			}	
			else 
			{
				return "ekstensi tidak diperbolehkan";
			}
		} 
		// jka gambar tidak diganti
		else
		{
			$this->koneksi->query("UPDATE produk SET nama_produk='$nama_produk', harga_produk='$harga', berat_produk='$berat', stok_produk='$stok', deskripsi_produk='$deskripsi', id_kategori='$kategori' WHERE id_produk='$id_produk' ");
			return "sukses";
		}
		


	}
	function tampil_keranjang()
	{
		if(isset($_SESSION['keranjang']))
		{

		$keranjang = $_SESSION['keranjang'];
		$total = 0;
		$total_berat = 0;
		foreach ($keranjang as $id_produk => $jumlah_beli) 
		{
			$data_produk = $this->ambil_data_produk($id_produk);
			$data_produk ['jumlah_beli'] = $jumlah_beli;
			// berat * jumlah_beli
			$data_produk['sub_berat'] = ceil(($data_produk['berat_produk']*$jumlah_beli)/1000);
			//  harga * jumlah beli
			$data_produk['sub_total'] = $data_produk['harga_produk'] *$jumlah_beli;
		$total_berat += $data_produk['sub_berat'];
			$total += $data_produk['sub_total'];
			$semua_data[] = $data_produk;
	// 		echo	"<pre>";
	// print_r($data_produk);
	// echo	"</pre>";
		}

		$semua_data ['total_berat'] = $total_berat;
		$semua_data ['total_belanja'] = $total;
		return $semua_data;

		}
	}
	function cari_produk($keyword)
	{
		$semua = array();
		$ambil = $this->koneksi->query("SELECT * FROM produk  JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE nama_produk LIKE '%$keyword%'")or die (mysqli_error($this->koneksi));
		while ($pecah = $ambil->fetch_assoc())
		{
			$semua[] = $pecah;
		}
		return $semua;
	}

	}
class member
{
	public $koneksi;
	function __construct($x)
	{
		$this->koneksi=$x;
	}
	function login_member($username, $password)
	{
		$ambil = $this->koneksi->query("SELECT * FROM member WHERE username_member='$username' AND password_member='$password'");
		$hitung=$ambil->num_rows;

		if ($hitung==1)
		{
			$akun= $ambil->fetch_assoc();

			$_SESSION['member']= $akun;
			return "sukses";

		}
		else 
		{
			return "gagal";
		}
	}
	function tampil_member()
	{
		$ambil_data = $this->koneksi->query("SELECT * FROM member")or die (mysqli_error($this->koneksi));
		while ($pecah_data = $ambil_data->fetch_assoc())
		{
			$semua_data[] = $pecah_data;
		}
		return $semua_data;
	}
	function ambil_member($id_member)
	{
		$ambil=$this->koneksi->query("SELECT * FROM member WHERE id_member='$id_member'");
		$pecah_data=$ambil->fetch_assoc();
		return $pecah_data;
	}
	function simpan_member($nama, $telepon, $email, $username, $password, $alamat, $foto, $tgllhr)
	{
		// cari username
		$data = $this->koneksi->query("SELECT * FROM member WHERE username_member = '$username'");
		$hasil = mysqli_num_rows($data);
		if ($hasil >=1)
		{
			return "ada";
		}
		else
		{
		$nama_foto=$foto['name'];
		$lokasi_foto=$foto['tmp_name'];
		$waktu=date("Y_m_d_H_i_s");
		$nama_foto_costum = $waktu."_".$nama_foto;
		move_uploaded_file($lokasi_foto, "../assets/img/member/$nama_foto_costum");
		$this->koneksi->query("INSERT INTO member (nama_member, telp_member, email_member, username_member, password_member, alamat_member, foto_member, tgl_lhr) VALUES ('$nama', '$telepon', '$email', '$username', '$password', '$alamat', '$nama_foto_costum', '$tgllhr')");
		return "belum";
		}
	}
	
	function registrasi($nama, $telepon, $email, $username, $password, $alamat, $foto, $tgllhr)
	{
		// cari username
		$data = $this->koneksi->query("SELECT * FROM member WHERE username_member = '$username'");
		$hasil = mysqli_num_rows($data);
		if ($hasil >=1)
		{
			return "ada";
		}
		else
		{
		$nama_foto=$foto['name'];
		$lokasi_foto=$foto['tmp_name'];
		$waktu=date("Y_m_d_H_i_s");
		$nama_foto_costum = $waktu."_".$nama_foto;
		move_uploaded_file($lokasi_foto, "assets/img/member/$nama_foto_costum");
		$this->koneksi->query("INSERT INTO member (nama_member, telp_member, email_member, username_member, password_member, alamat_member, foto_member, tgl_lhr) VALUES ('$nama', '$telepon', '$email', '$username', '$password', '$alamat', '$nama_foto_costum', '$tgllhr')");
		return "belum";
		}
	}
	function hapus_member($id_member)
	{
		$data_member= $this->ambil_member($id_member);
		$foto_hapus=$data_member['foto_member'];
		unlink("../assets/img/member/$foto_hapus");

		$this->koneksi->query("DELETE FROM member WHERE id_member='$id_member'");
	}
	function ubah_member ($nama, $tgllhr, $email, $username, $password, $alamat, $telp, $foto, $id_member)
	{
		$nama_foto = $foto['name'];
		$nama_foto_pasti = date("Y_m_d_H_i_s")."_".$nama_foto;
		$lokasi_foto = $foto['tmp_name'];

		//foto dirubah 
		if(!empty($lokasi_foto))
		{
			$data_member = $this->ambil_member($id_member);
			$foto_hapus = $data_member['foto_member'];
			// jika foto ada maka hapus
			if (file_exists("../assets/img/member/$foto_hapus"))
			{
				unlink("../assets/img/member/$foto_hapus");
			}
			// upload foto baru
			move_uploaded_file($lokasi_foto, "../assets/img/member/$nama_foto_pasti");

			$this->koneksi->query("UPDATE member SET nama_member='$nama', tgl_lhr='$tgllhr', email_member='$email', username_member='$username', password_member='$password', alamat_member='$alamat', telp_member='$telp', foto_member='$nama_foto_pasti' WHERE id_member='$id_member'");

		}
		// foto tidak dirubah 
		else
		{
			$this->koneksi->query("UPDATE member SET nama_member='$nama', tgl_lhr='$tgllhr', email_member='$email', username_member='$username', password_member='$password', alamat_member='$alamat', telp_member='$telp' WHERE id_member='$id_member'");

		}
	}
}
class kategori
{
	public $koneksi;
	function __construct($x)
	{
		$this->koneksi=$x;
	}
	function tampil_kategori()
	{
		// mengambil data dari tabel kategori
		$ambil = $this->koneksi->query("SELECT * FROM kategori");
		// pecah ke array dan diperulangkan
		while ($pecah=$ambil->fetch_assoc())
		{
			// gabungkan array perdata ke semua data
			$semua_data []=$pecah;
		}
		return $semua_data;

	}
	function simpan_kategori ($kategori)
	{
		$this->koneksi->query("INSERT INTO kategori (nama_kategori) VALUES('$kategori')");
	}	
	function hapus_kategori($id)
	{
		$this->koneksi->query("DELETE FROM kategori WHERE id_kategori='$id'");
	}
	function ambil_kategori($id)
	{
		$ambil = $this->koneksi->query("SELECT * FROM kategori WHERE id_kategori= '$id'");
		$pecah = $ambil->fetch_assoc();
		return $pecah;
	}
	function ubah_kategori($nama, $id)
	{
		$this->koneksi->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$id'");
	}
}
class admin
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi=$mysqli;
	}
	function login_admin($username, $password)
	{
		// mengambil data dari tabel admin berdasarkan inputan loginnya
		$ambil = $this->koneksi->query("SELECT * FROM admin WHERE username_admin='$username' AND password_admin='$password'");
		// menghitung data yang cocok
		$hitung=$ambil->num_rows;

		// menghitung data yang cocok($hitung==1)
		if ($hitung==1)
		{
			// memecah akun ke array
			$akun= $ambil->fetch_assoc();

			// menyimpan akun ke session
			$_SESSION['admin']= $akun;
			return "sukses";

		}
		// selain itu (0 akun yang cocok) maka gagal
		else 
		{
			return "gagal";
		}
	}
}
class api_ongkir
{
	public $koneksi;
	function __construct($x)
	{
		$this->koneksi = $x;
	}
	function update_provinsi()
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 5ce4661b0e58c4d40c3bc7d1d737ecd5"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err)
		{
			echo "cURL Error #:" . $err;
		} 
		else 
		{
  // echo $response;
  // kovert ke array
			$data_provinsi = json_decode($response, TRUE);
			$data_provinsi = $data_provinsi ['rajaongkir']['results'];
			foreach ($data_provinsi as $key => $value) 
			{
				$id_provinsi = $value['province_id'];
				$nama_provinsi = $value['province'];
				// menyimpan ke tabel provinsi di database
				$this->koneksi->query("INSERT INTO provinsi (id_provinsi, nama_provinsi) VALUES ('$id_provinsi', '$nama_provinsi')");
			}
		}
	}
	function update_kota()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=&province=",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 5ce4661b0e58c4d40c3bc7d1d737ecd5"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) 
		{
			echo "cURL Error #:" . $err;
		} 
		else 
		{
			// echo $response;
			// konvert ke array
			$data_kota = json_decode($response, TRUE);
			// hanya data kota
			$data_kota = $data_kota ['rajaongkir']['results'];
			foreach ($data_kota as $key => $value) 
			{
				$id_kota = $value ['city_id'];
				$id_provinsi = $value ['province_id'];
				$tipe_kota = $value ['type'];
				$nama_kota = $value ['city_name'];
				$kode_pos = $value ['postal_code'];
				// simpan ke database tabel kota
				$this->koneksi->query("INSERT INTO kota (id_kota, id_provinsi, tipe_kota, nama_kota, kodepos_kota)VALUES ('$id_kota', '$id_provinsi', '$tipe_kota', '$nama_kota', '$kode_pos')");


			}
		}
	}
	function update_ongkir($id_kota_asal, $id_kota_tujuan)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=$id_kota_asal&destination=$id_kota_tujuan&weight=1000&courier=jne",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: 5ce4661b0e58c4d40c3bc7d1d737ecd5"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
  // echo $response;
			$data_ongkir = json_decode($response, TRUE);
			echo "<pre>";
			print_r($data_ongkir);
			echo "</pre>";
			$data_ongkir = $data_ongkir ['rajaongkir'] ['results']['0'];
			// mengambil kode ekspedisi
			$kode_ekspedisi = $data_ongkir ['code'];
			$nama_ekspedisi = $data_ongkir ['name'];
			foreach ($data_ongkir['costs']as $key => $value)
			{
				$paket_exp = $value ['service'];
				$deskripsi_ongkir = $value ['description'];
				$biaya_ongkir = $value ['cost']['0']['value'];
				$estimasi_hari = $value ['cost']['0']['etd'];
				// simpan ke tabel ongkir
				$this->koneksi->query("INSERT INTO ongkir (id_kota_asal, id_kota_tujuan, kode_exp, nama_exp, paket_exp, deskripsi_ongkir, biaya_ongkir, estimasi_hari) VALUES ('$id_kota_asal', '$id_kota_tujuan', '$kode_ekspedisi', '$nama_ekspedisi', '$paket_exp', '$deskripsi_ongkir', '$biaya_ongkir', '$estimasi_hari')");
			}
		}
	} 
	function tampil_provinsi()
	{
		$data = $this->koneksi->query("SELECT * FROM provinsi");
		while ($pecah = $data->fetch_assoc())
		{
			$semua[] = $pecah;
		}
		return $semua;
	}
	function tampil_kota_provinsi ($id_provinsi)
	{
		$semua = array();
		$data = $this->koneksi->query("SELECT * FROM kota WHERE id_provinsi = '$id_provinsi'");
		while ($pecah = $data->fetch_assoc())
		{
			$semua[] = $pecah;
		}
		return $semua;
	}
	function tampil_kota()
	{
		$ambil = $this->koneksi->query("SELECT * FROM kota");
		while ($pecah = $ambil-> fetch_assoc());
		{
			$semua_data[]= $pecah;
		}
		return $semua_data;
	}
	function kosongkan_data()
	{
		// membuat array tabel yang mau dikosongkan
		$tabel = array("ongkir", "kota", "provinsi");
		foreach ($tabel as $key => $pertabel) 
		{
			// query mengkosongkan tabel
			$this->koneksi->query("TRUNCATE $pertabel");
		}
	}
	function tampil_paket($id_kota_asal, $id_kota_tujuan, $ekspedisi)
	{
		$semua = array ();
		$data = $this->koneksi->query("SELECT * FROM ongkir WHERE id_kota_asal = '$id_kota_asal' AND id_kota_tujuan = '$id_kota_tujuan' AND kode_ekspedisi = '$ekspedisi'");
		while ($pecah = $data->fetch_assoc())
		{
			$semua[] = $pecah;
		}
		return $semua;
	}
	function detail_ongkir($id_ongkir)
	{
		$data = $this->koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
		return $data->fetch_assoc();
	}
}
class transaksi
{
	public $koneksi;
	function __construct($x)
	{
		$this->koneksi=$x;
	}
	function simpan_transaksi ($tgl_transaksi, $data_keranjang, $id_member, $alamat_penerima, $telp_penerima, $kode_pos, $biaya_ongkir, $nama_penerima, $id_kota, $paket_yg_dipilih, $status, $id_ongkir, $total_bayar)
	{
		// input ke tabel transaksi
		$this->koneksi->query("INSERT INTO transaksi(tgl_transaksi, total_bayar, id_member, alamat_penerima, telp_penerima, pos_penerima, ongkir, nama_penerima, kota_penerima, paket_ongkir, status_pembayaran, id_ongkir) VALUES ('$tgl_transaksi', '$total_bayar', '$id_member', '$alamat_penerima', '$telp_penerima', '$kode_pos', '$biaya_ongkir', '$nama_penerima', '$id_kota', '$paket_yg_dipilih', '$status', '$id_ongkir')");
		// mysqli_insert_id -> untuk mengambil id_ yang baru saja diinputkan
		$id_transaksi = mysqli_insert_id($this->koneksi);
		// input ke tabel detail dengan id_transaksi
		foreach ($data_keranjang as $key => $isi_keranjang) 
		{
			$id_produk = $isi_keranjang ['id_produk'];
			$harga = $isi_keranjang ['harga_produk'];
			$jumlah_beli = $isi_keranjang['jumlah_beli'];

			if ($key !== 'total_belanja' && $key !== 'total_berat')
			{
				$this->koneksi->query("INSERT INTO detail_transaksi (id_transaksi, id_produk, harga_produk, jumlah_produk) VALUES ('$id_transaksi', '$id_produk', '$harga', '$jumlah_beli') ");
			}
		}
		return $id_transaksi;

	}
	function ambil_transaksi($id)
	{
		$data = $this->koneksi->query("SELECT * FROM transaksi WHERE id_transaksi = '$id'");
		return $data->fetch_assoc();
	}
	function ambil_detail_transaksi($id)
	{
		$data = $this->koneksi->query("SELECT * FROM detail_transaksi WHERE id_transaksi = '$id'");
		while ($pecah = $data->fetch_assoc())
		{
			$semua [] = $pecah;
		}
		return $semua;
	}
	function transaksi_belum_konfirmasi($id_member)
	{
		$data = $this->koneksi->query("SELECT * FROM transaksi WHERE id_member = '$id_member' AND status_pembayaran='Belum Konfirmasi'");
		while ($pecah = $data->fetch_assoc())
		{
			$semua[] = $pecah;
		}
		return $semua;
	}
	function konfirmasi ($bukti, $tgl_transfer, $nama_akun, $nama_bank, $tgl_konfirmasi, $jumlah_bayar, $id, $id_member)
	{
		$nama_bukti = $bukti['name'];
		$lok = $bukti['tmp_name'];

		$nama_costum = "struk_".date("YmdHis")."_".$nama_bukti; 
		move_uploaded_file($lok, "assets/img/struk/$nama_costum");
		$this->koneksi->query("INSERT INTO pembayaran (id_member, id_transaksi, jumlah_pembayaran, foto_struk, tgl_transfer, tgl_konfirmasi, nama_akun_rek, bank_rek) VALUES ('$id_member', '$id', '$jumlah_bayar','$nama_costum', '$tgl_transfer', '$tgl_konfirmasi', '$nama_akun', '$nama_bank')") or die (mysqli_error($this->koneksi));
		// update tb_transaksi status_pembayaran = 'menunggu'
		$this->koneksi->query("UPDATE transaksi SET status_pembayaran = 'menunggu' WHERE id_transaksi = '$id'");
	}
	function transaksi_proses($id_member, $status)
	{
		$semua = array();
		$data = $this->koneksi->query("SELECT * FROM transaksi WHERE id_member = '$id_member' AND status_pembayaran='$status'");
		while ($pecah = $data->fetch_assoc())
		{
			$semua[] = $pecah;
		}
		return $semua;
	}
	function transaksi_histori($id_member)
	{
		$semua = array();
		$data = $this->koneksi->query("SELECT * FROM `transaksi` WHERE id_member='$id_member'");
		while ($pecah = $data->fetch_assoc())
		{
			$semua[] = $pecah;
		}
		return $semua;
	}
	function tampil_status_transaksi($status)
	{
		$semua = array();
		$data = $this->koneksi->query("SELECT * FROM transaksi WHERE status_pembayaran = '$status'");
		while ($pecah = $data->fetch_assoc())
		{
			$semua [] = $pecah;
		}
		return $semua;
	}
	function pembayaran($id_transaksi)
	{
		$data = $this->koneksi->query("SELECT * FROM pembayaran WHERE id_transaksi = '$id_transaksi'") or die(mysqli_error($this->koneksi));
		return $data->fetch_assoc();
	}
	function ubah_status($id, $status)
	{
		$this->koneksi->query("UPDATE transaksi SET status_pembayaran = '$status' WHERE id_transaksi='$id'");
	}
	function simpan_resi($resi,$id)
	{
		$this->koneksi->query("UPDATE transaksi SET no_resi = '$resi' WHERE id_transaksi = '$id'");
	}
	function tampil_transaksi_histori()
	{
		$data = $this->koneksi->query ("SELECT *FROM transaksi");
		while ($pecah = $data->fetch_assoc())
		{
			$semua_data[] = $pecah;
		}
		return $semua_data;
	}
		
}
$ongkir = new api_ongkir ($mysqli);
$produk = new produk ($mysqli);
$kategori = new kategori ($mysqli);
$member= new member($mysqli);
$admin= new admin($mysqli);
$transaksi = new transaksi ($mysqli);
?>
