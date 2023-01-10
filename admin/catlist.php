<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
include '../classes/category.php';

$cat = new category();

if (isset($_GET['delID'])) {
	$id = $_GET['delID'];
	$delCat = $cat->delete_cat($id);
}


?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<?php
		if (isset($delCat)) {
			echo $delCat;
		}
		?>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_cate = $cat->getAllCategory();
					$i = 0;
					if ($show_cate->num_rows > 0) {

						while ($res = $show_cate->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $res['catName'] ?></td>
								<td><a href="catedit.php?catID=<?php echo $res['catID'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')
								" href="?delID=<?php echo $res['catID'] ?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>


				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>