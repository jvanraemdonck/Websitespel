<div class="top-bar">
	<div class="title">HHD Admin Access</div>

	<div class="user">
		<div class="news">
			<span class="number">7</span>
			<span class="glyphicon glyphicon-th-list"></span>
		</div>

		<div class="news">
			<span class="number">3</span>
			<span class="glyphicon glyphicon-envelope"></span>
		</div>

		<div class="news profile">
			<img src="{{ $admin[0]->avatar }}" alt="avatar" />
			<span>{{ explode(' ', $admin[0]->longname)[0] }}</span>
		</div>
	</div>
</div>

<div class="left-bar">
	<h4>NAVIGATION</h4>
	<ul>
		<li><a href="#">Dashbord</a></li>
		<li><a href="#">Vragen</a></li>
		<li><a href="#">Extra Tip-Vraag</a></li>
		<li><a href="#">Teams</a></li>
		<li><a href="#">Administrators</a></li>
	</ul>
</div>