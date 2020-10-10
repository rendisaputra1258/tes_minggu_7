<?php 


include "connection.php";

$siswa=$db->query("select siswa.id_siswa, siswa.nama_siswa,sekolah,motivasi, tim.id_tim, tim.nama_tim from siswa,tim where siswa.id_siswa=tim.id_tim;");
$data_siswa=$siswa->fetchAll();

// echo $data_siswa;

foreach ($data_siswa as $key) {
    // echo $key['nama']."  ".$key['pekerjaan']."<br>";
}

if(isset($_POST['search']))
{

  $filter=$_POST['search'];

  $search=$db->prepare("select * from siswa where nama_siswa=? or sekolah=?");

  $search->bindValue(1,$filter,PDO::PARAM_STR);
  $search->bindValue(2,$filter,pdo::PARAM_STR);

  $search->execute(); //Execution of PDO statement

  $data=$search->fetchAll(); //Result from PDO stateent

  // var_dump($data);

  $row=$search->rowCount();

  // var_dump($row);

}else{
  $data = $db->query("select * from siswa");

  $tampil_data = $data->fetchAll();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Ujian Minggu 7</title>
</head>
<body>
    


<div class="container " >
  <div class="row">
    <div class="col-12">

    <h1 class="text-primary">Data Siswa</h1>
    <hr>

    <!--alert mesege-->
    <?php if(isset($row)):?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <p class="lead"><?php echo $row ; ?>Data Ditemukan</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php endif;?>
<div class="container positiion-fixed">
  <div class="row">
    <div class="col-6">
      
      <h2 class="text-primary">Cari Data Siswa</h2>
      
      <!--Data Form -->
      
    <form action="index.php" method="post" class="form-inline my-2 my-lg-0 ">
        <input type="text" name="search" class="form-control mr-sm-2" placeholder="nama/sekolah" aria-label="Search">
        <input type="submit" value="Cari" class="btn btn-outline-info my-2 my-sm-0">
    </form>
         
    </div>
  </div>
</div>

<div class="container">
        <div class="row">
            <?php foreach($data_siswa as $key) : ?>
            <div class="card m-2 bg-dark" style="width: 20rem; float:left;">
                <div class="card-body">
                    <h5 class="card-title text-primary"></h5>
                    <ul style="list-style: none;">
                        <li>
                        <b class="text-light">Nama Siswa : <?php echo $key["nama_siswa"]; ?></b>
                        </li>
                        <li>
                            <b class="text-light">Sekolah : <?php echo $key["sekolah"]; ?></b>
                        </li>
                        <li>
                           <b class="text-light">Motivasi : <?php echo $key["motivasi"]; ?></b>
                        </li>
                        <li>
                           <b class="text-light">Nama Tim : <?php echo $key["nama_tim"]; ?></b>
                        </li>
                        <li>
                          <td><a class="btn btn-warning" data-toggle="modal" data-target="#oop">hapus</a>|<a class="btn btn-primary" href="edit.php?id_siswa=<?php echo $key["id_siswa"]; ?>">edit</a></td>
                        </li>
                    </ul>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<!-- from input daftar -->

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Tambahkan Data Baru
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Masukan Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div class="container">
      <div class="row">
          <div class="col">
          <form action="input.php" method="POST">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Siswa</label>
                      <input type="text" name="nama_siswa" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Sekolah</label>
                      <input type="text" name="sekolah" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Motivasi</label>
                      <input type="text" name="motivasi" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Tim</label>
                      <input type="text" name="nama_tim" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-success">Simpan</button>
              </form>
          </div>
      </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="oop" tabindex="-1" role="dialog">
  <div class="modal-dialog"  role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <a type="button" class="btn btn-primary" href="delete.php?id_siswa=<?php echo $key["id_siswa"]; ?>">Hapus</a>
      </div>
    </div>
  </div>
</div>
<hr>
<p class="text-center">&copy;Rendi saputra</p>
<hr>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>



    

