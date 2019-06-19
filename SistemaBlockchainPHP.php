<?php 
	# Exemplo de funcionamento blockchain (simplificado)

	$blockchain = array(); # Criando a variavel que seria a corrente

	# Criando os blocos de informações (simulando)
	$bloco_1 = [
		"transacoes" => [
			[
				"Remetente" => "Diego Matos",
				"Destinatario" => "Tiago Andrade",
				"Mensagem" => "20 BTC"
			],
			[
				"Remetente" => "Tiago Andrade",
				"Destinatario" => "Amanda Martins",
				"Mensagem" => "5 BTC"
			],
			[
				"Remetente" => "Sergio Cunha",
				"Destinatario" => "Amanda Martins",
				"Mensagem" => "0.2 BTC"
			]			
		]
	];

	$bloco_2 = [
		"transacoes" => [
			[
				"Remetente" => "Amanda Martins",
				"Destinatario" => "Diego Matos",
				"Mensagem" => "1 BTC"
			],
			[
				"Remetente" => "Bruno Flores",
				"Destinatario" => "Tiago Andrade",
				"Mensagem" => "5 BTC"
			]			
		]
	];	


	$bloco_3 = [
		"transacoes" => [
			[
				"Remetente" => "santana",
				"Destinatario" => "Bruno Flores",
				"Mensagem" => "1 BTC"
			]		
		]
	];		

	$bloco_4 = [
		"transacoes" => [
			[
				"Remetente" => "Caio Morgado",
				"Destinatario" => "lenny",
				"Mensagem" => "50 BTc"
			], 
			[
				"Remetente" => "Jose",
				"Destinatario" => "Tiago Andrade",
				"Mensagem" => "100 BTc"
			],
			[
				"Remetente" => "Bruno Flores",
				"Destinatario" => "Diego Matos",
				"Mensagem" => "0.5 BTc"
			],
			[
				"Remetente" => "santana",
				"Destinatario" => "Diego Matos",
				"Mensagem" => "0.001 BTC"
			]
		]
	];

	$bloco_5 = [
		"transacoes" => [
			[
				"Remetente" => "Tiago Andrade",
				"Destinatario" => "Amanda Martins",
				"Mensagem" => "0.0005 BTC"
			],
			[
				"Remetente" => "Amanda Martins",
				"Destinatario" => "Tiago Andrade",
				"Mensagem" => "0.0001 BTC"
			]
		]
	];

	# Os dados não precisam ser necessariamente esses, podemos passar/usar qualquer informação

	# Funçaõ que insere o bloco na corrente de blocos
	function addblock($bloco_novo){

		# Chama a variavel global
		global $blockchain;		

		# Verifica se a blockchain esta vazia
		if ($blockchain == array()) {
			# Caso afirmativo, cria o primeiro bloco
			$bloco_novo["hash"] = hash("sha256", json_encode($bloco_novo));
		}else{
			# Senão, pega o ultimo bloco
			$ultimo_bloco = end($blockchain);

			# Add a hash anterior
			$bloco_novo["hash"] = $ultimo_bloco["hash"];

			# Altera o hash do bloco
			$bloco_novo["hash"] = hash("sha256", json_encode($bloco_novo));
		}
		array_push($blockchain, $bloco_novo);
	}

	# Chamando a função
	addblock($bloco_1);
	addblock($bloco_2);
	addblock($bloco_3);
	addblock($bloco_4);
	addblock($bloco_5);

	# Exibir
	echo "<h1>Resultado da blockchain</h1>";
	foreach ($blockchain as $key => $bloco) {
		$posicao = $key + 1;
		echo "Bloco: #".$posicao." - ".$bloco['hash']."<br>";
		foreach ($bloco['transacoes'] as $transacoes) {
			echo " - Tx: ".$transacoes['Remetente']." -> ". $transacoes['Destinatario'] . " - " . $transacoes['Mensagem'] . "<br>";
		}
		echo "<br><br>";
	}
	
	exit;
?>