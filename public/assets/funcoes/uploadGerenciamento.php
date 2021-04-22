<?php 
require_once('funcoesGeral.php');
require_once('uploadArquivo.php');

	//excluindo imagem temporaria
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirArquivo'){

		if($_POST['arquivo'])
			echo deletaArquivoConsultor($_POST['arquivo']);

	}

	//excluindo imagem temporaria
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirImagemTemp'){

		if($_POST['arquivo'])
			echo deletaImagemTemp($_POST['arquivo']);

	}

	//excluindo imagem
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirImagem'){

		if($_POST['arquivo'])
			echo deletaImagem($_POST['arquivo']);

	}

	//excluindo imagem produto
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirImagemProduto'){

		if($_POST['arquivo'])
			echo deletaImagemProduto($_POST['arquivo']);

	}

	//excluindo pdf produto temp
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirPDFTemp'){

		if($_POST['arquivo'])
			echo deletaDocumentoPDFTemp($_POST['arquivo']);

	}

	//excluindo pdf produto
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirPDF'){

		if($_POST['arquivo'])
			echo deletaDocumentoPDFProduto($_POST['arquivo']);

	}

	//excluindo pdf resposta dúvida
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirPDFDuvidaResposta'){

		if($_POST['arquivo'])
			echo deletaDocumentoPDFDuvidaResposta($_POST['arquivo']);

	}

	//excluindo mp3 temporaria
	if(isset($_POST['acao']) && $_POST['acao'] == 'excluirMP3Temp'){

		if($_POST['arquivo'])
			echo deletaMP3Temp($_POST['arquivo']);

	}

?>