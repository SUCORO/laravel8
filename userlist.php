<?php
   $database = "database.sqlite";
   $db = new SQLite3('database.sqlite');
   if(!$db) {
      echo $db->lastErrorMsg();
   } 

    $sql = "SELECT * FROM users";
   $result = $db->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Daftar Pengguna</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1>Daftar Pengguna</h1>
		<button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Tambah Pengguna Baru</button>
		<table id="userTable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
            <?php

   			$result = $db->query($sql);
             while($row = $result->fetchArray()) {
                    echo "<tr>
					<td>".$row['id']."</td>
					<td>".$row['name']."</td>
					<td>".$row['email']."</td>
					<td><button class='btn btn-primary' data-toggle='modal' data-target='#addUserModal'>Tambah Pengguna Baru</button></td>
					</tr>";
                }

                ?>
			</tbody>
		</table>
	</div>

	<!-- Modal Tambah Pengguna Baru -->
	<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna Baru</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="addUserForm">
	        	<div class="form-group">
	        		<label for="name">Nama:</label>
	        		<input type="text" class="form-control" id="name" name="name" required>
	        	</div>
	        	<div class="form-group">
	        		<label for="email">Email:</label>
	        		<input type="email" class="form-control" id="email" name="email" required>
	        	</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	        <button type="submit" form="addUserForm" class="btn btn-primary">Tambahkan Pengguna</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Edit Pengguna -->
	<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editUserModalLabel">Edit Pengguna</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="editUserForm">
	        	<div class="form-group">
	        		<label for="editName">Nama:</label>
	        		<input type="text" class="form-control" id="editName" name="name" required>
                        	</div>
        	<div class="form-group">
        		<label for="editEmail">Email:</label>
        		<input type="email" class="form-control" id="editEmail" name="email" required>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" form="editUserForm" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<?php 
 $db->close();
 ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function() {
		// Mendefinisikan tabel dan mengaktifkan plugin DataTables
		var table = $('#userTable').DataTable({
			ajax: '/getUsers.php', // URL untuk mengambil data pengguna dari server
			columns: [
				{ data: 'id' },
				{ data: 'name' },
				{ data: 'email' },
				{ 
					data: null, // Tidak ada data kolom ini pada sumber data JSON
					render: function(data, type, row, meta) {
						return '<button class="btn btn-sm btn-primary editUserBtn" data-toggle="modal" data-target="#editUserModal" data-id="'+row.id+'" data-name="'+row.name+'" data-email="'+row.email+'">Edit</button>';
					}
				}
			]
		});

		// Mengaktifkan fungsi tambah pengguna
		$('#addUserForm').submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: '/addUser.php', // URL untuk menambahkan pengguna baru ke server
				type: 'POST',
				data: $(this).serialize(),
				success: function(response) {
					if (response.success) {
						$('#addUserModal').modal('hide');
						table.ajax.reload();
					}
				}
			});
		});

		// Mengaktifkan fungsi edit pengguna
		$('#editUserModal').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget);
			var id = button.data('id');
			var name = button.data('name');
			var email = button.data('email');
			var modal = $(this);
			modal.find('#editName').val(name);
			modal.find('#editEmail').val(email);
			modal.find('#editUserForm').attr('action', '/editUser.php?id='+id); // Menambahkan ID pengguna ke URL form pengeditan
		});
		$('#editUserForm').submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: $(this).attr('action'), // URL untuk mengedit pengguna di server
				type: 'POST',
				data: $(this).serialize(),
				success: function(response) {
					if (response.success) {
						$('#editUserModal').modal('hide');
						table.ajax.reload();
					}
				}
			});
		});
	});
</script>
	        	
