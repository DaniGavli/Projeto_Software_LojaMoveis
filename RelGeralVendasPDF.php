<?php

require_once 'dompdf/autoload.inc.php';
 require_once 'conexaoBanco.php';
//$dompdf = new DOMPDF();

$HTML = "";
 
use Dompdf\Dompdf;
require_once 'dompdf/autoload.inc.php';
$dompdf = new DOMPDF();


$HTML .=' ';  
$HTML .= '<table border ="1">';
$HTML .= '<thead>';
$HTML .= '<tr><td>ID</td>';
$HTML .= '<td>Vendedor</td>';
$HTML .= '<td>Cod Pedido</td>';
$HTML .= '<td>Produto</td>';
$HTML .= '<td>Data Venda</td>';
$HTML .= '<td>Valor</td>';
$HTML .= '<td>Quantidade</td>';
$HTML .= '<td>Total</td></tr>';
$HTML .= '</thead>';


 $stmt = $conexao->prepare("SELECT v.id_tblVendas, v.idVenda, l.id_func, l.nome_func, pd.codPedido, pr.nome_produto, v.valor, v.quant_item, c.nome_cliente, c.cpf_cliente, pd.data_Pedido, v.Total_venda 
               FROM venda v 
              INNER JOIN pedidos pd ON (v.idVenda = pd.idVenda) 
			  INNER JOIN produto pr ON (pr.codProduto = v.codProduto) 
			  INNER JOIN loginusu l ON (pd.id_func = l.id_func) 
			  INNER JOIN cliente c ON (c.codCliente = pd.codCliente)");
                            
							  if( $stmt->execute()){
                                       while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){

                                         
											   $HTML .= '<tbody>';
											   $HTML .= '<tr><td>' . $rs['id_func'] .'</td>';
                                               $HTML .= '<td>'. $rs['nome_func'] .'</td>'; 
											    $HTML .= '<td>'. $rs['codPedido'] .'</td>';
												$HTML .= '<td>'. $rs['nome_produto'] .'</td>'; 
											    $HTML .= '<td>'. $rs['data_Pedido']. '</td>'; 
                                                 $HTML .= '<td>'. $rs['valor'] .'</td>';
                                                $HTML .= '<td>'. $rs['quant_item'] .'</td>'; 
                                                $HTML .= '<td>'.$rs['Total_venda']. '</td></tr>'; 
                                                $HTML .= '</tbody>';
									   }
									    $HTML .= '</table>';
							   }
							  
								$HTML .= '</table>';

$dompdf->load_html('
<h1>Relatorio Geral de Vendas</h1> 
 
'.$HTML .' 
');

$dompdf->render();

$dompdf->stream(

"relVendas.pdf",
array("Attachment"=> false)
);

?>
