<nav id="sidebar" style="font-size: small;">

	<ul class="list-unstyled components text-wrap">
		<li class="active">
			<a href="index.php">
				<i class="fas fa-home"></i>
				Home
			</a>
		</li>
		<li class="sidenav" onclick="showClient()">
			<a class="dropdown-btn" href="#" onclick="showTab(1)">

				<i class="fa fa-user" aria-hidden="true"></i>
				Clients
				<i class="fa fa-caret-down"></i>

			</a>
			<div class="dropdown-container dropdown-manu">

				<a href="#" onclick="showTab(1)">
					<i class="fa fa-user" aria-hidden="true"></i>
					Show All Clients
				</a>

				<a href="#" onclick="showTab(2)">
					<i class="fa fa-plus" aria-hidden="true"></i>
					New Clients
				</a>

				<a href="#" onclick="showTab(3)">
					<i class="fa fa-link" aria-hidden="true"></i>
					Clients Links
				</a>

			</div>
		</li>


		<li class="sidenav" onclick="showContact()">
			<a class="dropdown-btn" href="#" onclick="showTab(4)">

				<i class="fa fa-phone" aria-hidden="true"></i>
				Contacts
				<i class="fa fa-caret-down"></i>

			</a>
			<div class="dropdown-container dropdown-manu">

				<a href="#" onclick="showTab(4)">
					<i class="fa fa-phone" aria-hidden="true"></i>
					Show All Contacts
				</a>

				<a href="#" onclick="showTab(5)">
					<i class="fa fa-plus" aria-hidden="true"></i>
					New Contacts
				</a>

				<a href="#" onclick="showTab(6)">
					<i class="fa fa-link" aria-hidden="true"></i>
					Contact Links
				</a>

			</div>
		</li>
	</ul>
</nav>