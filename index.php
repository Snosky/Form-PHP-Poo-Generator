<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Form POO Test</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
		<?php
			include('include.php');

			$form = new Form\Form();
			$form->decoratorBootstrap();
			$form->setAttribs([
				'name'	=>	'my-form',
				'id'	=>	'form-1'
			]);

			$username = $form->createField('text', 'username',
				[
					'required'	=> true,
					'attribs' 	=> [
						'class'	=> 'form-control',
						'id'	=>	'my-username'
					],
					'label'		=> 'Username :'
				]);
			$username->setDecorators([
				'input'		=> ['tag' => 'div', 'class' => 'input-group'],
				'after'	=> ['tag' => 'div', 'class' => 'input-group-addon', 'content' => '$'],
			]);

			$password = $form->createField('password', 'password');
			$password->setLabel('Password :');
			$password->setAttrib('class', 'form-control');
			$password->setRequired();

			$hidden = $form->createField('hidden', 'hidden');
			$hidden->setAttribs([
				'value'	=>	'hidden',
				'class'	=>	'form-control',
			]);

			$select = $form->createField('select', 'my-select', [
				'options' => [
					['value' => '1', 'content' => 'option 1'],
					['value' => '2', 'content' => 'option 2', 'selected' => true],
					['value' => '3', 'content' => 'option 3'],
				],
				'attribs' => ['class' => 'form-control']
			]);
			$select->setDecorators([
				'input' =>	['tag' => 'div']
			]);


			$checkbox = $form->createField('checkbox', 'my-checkbox');
			$checkbox->setLabel('S\'inscrire a la newsletter !');

			$radio = $form->createField('radio', 'my-radio');
			$radio->setOption('1');
			$radio->setOption('2');


			$form->addField($username);
			$form->addField($password);
			$form->addField($hidden);
			$form->addField($select);
			$form->addField($checkbox);
			$form->addField($radio);

			$form->hydrate([
				'username' => 'snosky',
				'password' => '123',
				'my-select' => '3',
				'my-checkbox' => true,
				'my-radio'	=> '1'
			]);

			echo $form;
		?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
