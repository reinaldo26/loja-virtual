<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Perfect Horizon</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.structure.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/jquery-ui.theme.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" type="text/css" />
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
	</head>
	<body>
		<?php 

		?>
		<nav class="navbar topnav">
			<div class="container">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo BASE_URL; ?>"><?php $this->lang->get('HOME'); ?></a></li>
					<li><a href="<?php echo BASE_URL; ?>contact"><?php $this->lang->get('CONTACT'); ?></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php $this->lang->get('LANGUAGE'); ?>
						<span class="caret"></span></a>
						<ul class="dropdown-menu menu-cat">
							<li><a href="<?php echo BASE_URL; ?>lang/set/en">English</a></li>
							<li><a href="<?php echo BASE_URL; ?>lang/set/pt-br">Português</a></li>
						</ul>
					</li>
					<li>
					<?php if(!empty($_SESSION['user'])): ?>
						<button class="btn-name"><?php echo $viewData['dataUser']['name']; ?></button>
					<?php else: ?>
						<button class="btn-login" data-toggle="modal" data-target=".modal-login"><?php $this->lang->get('LOGIN'); ?></button>
					<?php endif; ?>
					</li>
					<li>
					<?php if(!empty($_SESSION['user'])): ?>
							<a href="<?php echo BASE_URL; ?>logout" class="">Logout</a>
					<?php else: ?>
						<button class="btn-register" type="button" data-toggle="modal" data-target=".modal-register">Register</button>
					<?php endif; ?>
					</li>
				</ul>
			</div>
		</nav>

		<!-- Modal login -->
		<div class="modal modal-login fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <div class="modal-header">
				        <h4 class="modal-title"><?php $this->lang->get('LOGIN'); ?></h4>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    	</div>
				    <div class="modal-body">
				    	<form method="POST" action="<?php echo BASE_URL; ?>login/signIn">
				    		<?php if(isset($_GET['error'])): ?>
  							<div class="alert alert-danger">E-mail/senha inválidos</div>
  							<?php endif; ?>

				    		<div class="form-group">
    							<label for="email">Email:</label>
   						 		<input type="email" class="form-control" id="email" name="email" required="required"/>
  							</div>

  							<div class="form-group">
    							<label for="password">Password:</label>
   						 		<input type="text" class="form-control" id="password" name="password"/>
  							</div>
				    </div>

				    <div class="modal-footer">			    	
				       	<button class="btn-vt" type="button" data-dismiss="modal">Voltar</button>
				 		<input type="submit" value="Sign In"/>
				    </div>
				</form>
			    </div>
			  </div>
			</div>

			<!-- Modal Register -->
			<div class="modal modal-register fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
				    <div class="modal-header">
				        <h4 class="modal-title">Register</h4>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				    	</div>
				    <div class="modal-body">
				    	<form method="POST" action="<?php echo BASE_URL; ?>login/register">
				    		<h6><b>Informações Pessoais</b></h6>
				    		<div class="form-group">
    							<label for="nome">Nome:</label>
   						 		<input type="text" class="form-control" id="nome" name="nome"/>
  							</div>

				    		<div class="form-group">
    							<label for="email">Email:</label>
   						 		<input type="email" class="form-control" id="email" name="email"/>
  							</div>

  							<div class="form-group">
    							<label for="password">Password:</label>
   						 		<input type="text" class="form-control" id="password" name="password"/>
  							</div>	

  							<div class="form-group">
    							<label for="cpf">CPF:</label>
   						 		<input type="text" class="form-control" id="cpf" name="cpf"/>
  							</div>

  							<h6><b>Informações de Endereço</b></h6>
  							<div class="form-group">
    							<label for="rua">Rua:</label>
   						 		<input type="text" class="form-control" id="rua" name="rua"/>
  							</div>

  							<div class="form-group">
    							<label for="numero">Número</label>
   						 		<input type="text" class="form-control" id="numero" name="numero"/>
  							</div>

  							<div class="form-group">
    						   <label for="complemento">Complemento:</label>
   						 	   <input type="text" class="form-control" id="complemento" name="complemento"/>
  							</div>

  							<div class="form-group">
    							<label for="cep">Cep:</label>
   						 		<input type="text" class="form-control" id="cep" name="cep"/>
  							</div>

  							<div class="form-group">
    							<label for="bairro">Bairro:</label>
   						 		<input type="text" class="form-control" id="bairro" name="bairro"/>
  							</div>

  							<div class="form-group">
    							<label for="cidade">Cidade:</label>
   						 		<input type="text" class="form-control" id="cidade" name="cidade"/>
  							</div>

  							<div class="form-group">
    							<label for="estado">Estado:</label>
   						 		<input type="text" class="form-control" id="estado" name="estado"/>
  							</div>
	
				    </div>

				    <div class="modal-footer">
				       	<button class="btn-mdclose" type="button" data-dismiss="modal">Cancelar</button>
				 		<input type="submit" value="Cadastrar"/>
				    </div>
				</form>
			    </div>
			  </div>
			</div>

		<header>
			<div class="container">
				<div class="row">
					<div class="col-sm-2 logo">
						<a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/logo.png" /></a>
					</div>
					<div class="col-sm-7">
						<div class="head_help">(11) 9999-9999</div>
						<div class="head_email">contato@<span>loja2.com.br</span></div>
						
						<div class="search_area">
							<form method="GET" action="<?php echo BASE_URL; ?>busca">
								<input type="text" name="s" value="<?php echo (!empty($viewData['searchTerm']))?$viewData['searchTerm']:''; ?>" required placeholder="<?php $this->lang->get('SEARCHFORANITEM'); ?>" />
								
								<input type="submit" value="" />
						    </form>
						</div>
					</div>
					<div class="col-sm-3">
						<a href="<?php echo BASE_URL; ?>cart">
							<div class="cartarea">
								<div class="carticon">
									<div class="cartqt"><?php echo $viewData['cart_qt']; ?></div>
								</div>
								<div class="carttotal">
									<?php $this->lang->get('CART'); ?><br/>
									<span><?php echo number_format($viewData['cart_subtotal'], 2, ',', '.'); ?></span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</header>

		<div class="categoryarea">
			<nav class="navbar">
				<div class="container">
					<ul class="nav navbar-nav">
						<li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php $this->lang->get('SELECTCATEGORY'); ?>
					        <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <?php foreach($viewData['categories'] as $cat): ?>
					          	<li><a href="<?php echo BASE_URL.'categories/enter/'.$cat['id']; ?>"><?php echo $cat['name']; ?></a></li>
					          <?php 
					          	if(count($cat['subs']) > 0){
					          		$this->loadView('menu_subcategory', ['subs' => $cat['subs'], 'level' => 1]);
					          	}
					          	endforeach;
					          ?>
					        </ul>
					      </li>
					      <?php if(isset($viewData['category_filter'])): ?>
					      	<?php foreach($viewData['category_filter'] as $cf): ?>
						<li><a href="<?php echo BASE_URL; ?>categories/enter/<?php echo $cf['id']; ?>"><?php echo $cf['name']; ?></a></li>
					<?php endforeach; ?>
					<?php endif; ?>
					</ul>
				</div>
			</nav>
		</div>

		<section>
			<div class="container">
				<div class="row">
				  <?php if(isset($viewData['sidebar'])): ?>
				  <div class="col-sm-3">
				  	<?php $this->loadView('sidebar', ['viewData' => $viewData]); ?>
				  </div>
				  <div class="col-sm-9"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
				  <?php else: ?>
				  	<div class="col-sm-12"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
				  <?php endif; ?>
				</div>
	    	</div>
	    </section>

	    <footer>
	    	<div class="container">
	    		<div class="row">
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1><?php $this->lang->get('FEATUREDPRODUCTS'); ?></h1>
			  			<div class="widget_body">
			  				<?php $this->loadView('widget_view', ['list' => $viewData['widget_featured2']]); ?>
			  			</div>
			  		</div>
				  </div>
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1><?php $this->lang->get('ONSALEPRODUCTS'); ?></h1>
			  			<div class="widget_body">
			  				<?php $this->loadView('widget_view', ['list' => $viewData['widget_sale']]); ?>
			  			</div>
			  		</div>
				  </div>
				  <div class="col-sm-4">
				  	<div class="widget">
			  			<h1><?php $this->lang->get('TOPRATEDPRODUCTS'); ?></h1>
			  			<div class="widget_body">
			  				<?php $this->loadView('widget_view', ['list' => $viewData['widget_toprated']]); ?>
			  			</div>
			  		</div>
				  </div>
				</div>
	    	</div>
	    	<div class="subarea">
	    		<div class="container">
	    			<div class="row">
						<div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">

						<!-- Begin MailChimp Signup Form -->
						<form action="https://github.us18.list-manage.com/subscribe/post?u=060ddeeda88d45645e2bcf699&amp;id=13297cf97b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"novalidate>

							<input type="email" value="" name="EMAIL" class="required email subemail" id="mce-EMAIL" placeholder="<?php $this->lang->get('SUBSCRIBETEXT'); ?>" />

						    <input type="hidden" name="b_060ddeeda88d45645e2bcf699_13297cf97b" tabindex="-1" value="">

						    <input type="submit" value="<?php $this->lang->get('SUBSCRIBEBUTTON'); ?>" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
						</form>
						<!--End mc_embed_signup-->

						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="links">
	    		<div class="container">
	    			<div class="row">
						<div class="col-sm-4">
							<a href="<?php echo BASE_URL; ?>"><img width="150" src="<?php echo BASE_URL; ?>assets/images/logo.png" /></a><br/><br/>
							<strong>Slogan da Loja Virtual</strong><br/><br/>
							Endereço da Loja Virtual
						</div>
						<div class="col-sm-8 linkgroups">
							<div class="row">
								<div class="col-sm-4">
									<h3><?php $this->lang->get('CATEGORIES'); ?></h3>
									<ul>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
										<li><a href="#">Categoria X</a></li>
									</ul>
								</div>
								<div class="col-sm-4">
									<h3><?php $this->lang->get('INFORMATION'); ?></h3>
									<ul>
										<li><a href="#">Menu 1</a></li>
										<li><a href="#">Menu 2</a></li>
										<li><a href="#">Menu 3</a></li>
										<li><a href="#">Menu 4</a></li>
										<li><a href="#">Menu 5</a></li>
										<li><a href="#">Menu 6</a></li>
									</ul>
								</div>
								<div class="col-sm-4">
									<h3><?php $this->lang->get('INFORMATION'); ?></h3>
									<ul>
										<li><a href="#">Menu 1</a></li>
										<li><a href="#">Menu 2</a></li>
										<li><a href="#">Menu 3</a></li>
										<li><a href="#">Menu 4</a></li>
										<li><a href="#">Menu 5</a></li>
										<li><a href="#">Menu 6</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
	    	<div class="copyright">
	    		<div class="container">
	    			<div class="row">
						<div class="col-sm-6">© <span>Loja 2.0</span> - <?php $this->lang->get('ALLRIGHTRESERVED'); ?>.</div>
						<div class="col-sm-6">
							<div class="payments">
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
								<img src="<?php echo BASE_URL; ?>assets/images/visa.png" />
							</div>
						</div>
					</div>
	    		</div>
	    	</div>
	    </footer>

		<script type="text/javascript">
			var BASE_URL = '<?php echo BASE_URL; ?>';
			<?php if(isset($viewData['filters'])): ?>
			var maxValue = '<?php echo $viewData['filters']['maxValue']; ?>';
			<?php endif; ?>
		</script>	
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
	</body>
</html>