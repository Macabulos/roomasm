<?php
include('./connection/session.php');
include('./components/header.php');
include('./connection/dbcon.php');
include('./components/nav-top1.php');
include('./components/main.php');
?>

<div class="wrapper">
	<div id="element" class="hero-body-subject-add">
		<div class="nav-content">
			<h2>
				<font color="white">Add Teachers</font>
			</h2>
			<a class="btn btn-primary" href="record.php"> <i class=" icon-arrow-left icon-large"></i>&nbsp;Back</a>
			<hr>
			<div class="teacher">
				<form id="save_voter" class="form-horizontal" method="POST" action="save_teacher.php">
					<fieldset>
						</br>
						<div class="new_voter_margin">
							<ul class="thumbnails_new_voter">
								<li class="span3">
									<div class="thumbnail_new_voter">

										<div class="control-group">
											<label class="control-label" for="input01">First Name:</label>
											<div class="controls">
												<input type="text" name="firstName" class="firstName" id="span900">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="input01">Last Name:</label>
											<div class="controls">
												<input type="text" name="lastName" class="lastName" id="span900">
											</div>
										</div>



										<div class="control-group">

											<div class="control-group">
												<div class="controls">
													<button id="save_voter" class="btn btn-primary" name="save"><i
															class="icon-save icon-large"></i>Save</button>

												</div>
											</div>

					</fieldset>
				</form>

			</div>

		</div>


	</div>

</div>

<?php include('footer.php'); ?>
</div>
</body>
<div class="modal hide fade" id="myModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">�</button>
		<h3> </h3>
	</div>
	<div class="modal-body">
		<p>
			<font color="gray">Are You Sure you Want to LogOut?</font>
		</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">No</a>
		<a href="index.php" class="btn btn-primary">Yes</a>
	</div>
</div>