<?php 
usleep(500000);

require '../functions.php';

$keyword = $_GET["keyword"];


$query = "SELECT * FROM barangmasuk 
                    WHERE
                    kode LIKE '%$keyword%' OR
                    nama LIKE '%$keyword%' OR
                    jumlah LIKE '%$keyword%' OR
                    tgl LIKE '%$keyword%'
                   
                 ";

    $barang = query($query); 

?>

<table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Lantai</th>
                                    <th scope="col">Tanggal</th>

                                    <th scope="col">foto</th>
                                    <th scope="col">Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($barang as $cek) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $cek["kode"]; ?></td>
                                        <td><?= $cek["nama"] ?></td>
                                        <td><?= $cek["jumlah"] ?></td>
                                        <td><?= $cek["lantai"] ?></td>
                                        <td><?= $cek["tgl"] ?></td>
                                        <td><img src="img/<?= $cek["foto"] ?>" style="width:50px"></td>
                                        <td>
                                            <a href="hapus.php?id=<?php echo $cek["id"]; ?>" onclick="return confirm('Yakin Data Di Hapus..?'); "><i class="fa fa-trash  text-danger p-2 rounded btn-lg" data-toggle="tooltip" title="Hapus"></i></a>

                                            <a href="ubah.php?id=<?php echo $cek["id"]; ?>"><i class="fa fa-edit  text-warning p-2 rounded btn-lg" data-toggle="tooltip" title="Edit"></i></a>

                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>


                            </tbody>
                        </table>