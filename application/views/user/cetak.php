<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-Tanaman-".$thn.".xls"); ?>
			<table border="1">
				<thead>
					<tr>
						<td colspan="6"><center><h4>Data Tanaman Tahun <?php echo $thn ?></h4></center></td>
					</tr>
					<tr>
						<th>No.</th>
						<th>Lokasi</th>
						<th>Satuan Harga</th>
						<th>Produktivitas (Kg)</th>
						<th>Total Harga Jual(Tahun)</th>
						<th>Tahun</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1 ?>
					<?php foreach ($jagung as $key) { ?>
						<tr>
							<td><?php echo $no ?></td>
							<td><?php echo $key->nama_lokasi ?></td>
							<td><?php echo $key->produksi ?></td>
							<td><?php echo $key->produktivitas ?></td>
							<td><?php echo $key->luas_panen ?></td>
							<td><?php echo $key->tahun ?></td>
							<?php $no++ ?>
						</tr>
					<?php } ?>
				</tbody>
			</table>