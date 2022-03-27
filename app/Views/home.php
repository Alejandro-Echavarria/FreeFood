
	<header>
		<nav class="navbar naveg navbar-light">
			<a class="navbar-brand" href="<?= base_url(); ?>">
				<img src="<?= base_url(); ?>/dist/img/IKEA_logo.svg" width="80" height="30" alt="logo IKEA"><span class="text-dark font-weight-bold ml-1">Free Food</span>
			</a>
		</nav>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-5">
				<div class="d-flex justify-content-center">
					<h1 id="slogan" class="font-weight-bold titulo text-center">Donando podemos hacer una gran diferencia</h1>
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12 col-md-6">
				<img class="img" src="dist/img/food.svg" class="img" alt="Food image">
			</div>
			<div id="login" class="login p-5 col-12 col-md-6">
				<form>
					<div class="form-group">
						<label for="exampleInputEmail1" class="font-weight-bold">Correo electr&oacute;nico</label>
						<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Introduce tu correo electr&oacute;nico" aria-describedby="emailHelp">
						<small id="emailHelp" class="form-text text-muted">Nunca compartas tus credenciales con alguien m&aacute;s.</small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1" class="font-weight-bold">Contrase&ntilde;a</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Introduce tu Contrase&ntilde;a">
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Check me out</label>
					</div>
					<div class="justify-content-between">
						<a href="<?= base_url(); ?>/Residentes/">
							<button type="button" class="btn color-primario text-white font-weight-bold"><i class="fa-solid fa-right-to-bracket"></i> Ingresar</button>
						</a>
						<div class="mt-3">
							<small class="warningColor alerta font-weight-bold">Este form no es funcional, solo preciona el bot&oacute;n ingresar</small>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>