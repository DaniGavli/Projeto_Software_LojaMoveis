<?php
//require_once 'conexaoBanco.php';

ob_start();
include "fatura.php";
$conteudo = ob_get_contents();
ob_end_clean();
?>
<?php
$para = 'dngg55@gmail.com';
$assunto = 'Fatura de compra na Loja Super Moveis';

mail();
$envio = mail($para,$assunto,$conteudo,"Content-type: text/html\r\n");
if($envio)
		
echo  "<script>alert('Fatura enviada ao email cadastrado');</script>";
echo "<script>location.href='fatura.php'</script>"

?>

