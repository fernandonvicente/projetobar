<?php

namespace App\Http\Controllers\All;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class MailController extends Controller
{
   
    //envio do contato pelo site
    public function send_email_contact($tipo_html,$nome_remetente,$email_remetente,$mensagem_remetente,$nome_destinatario,$email_destinatario,$subject,$file_attach){
        

        $mensagem = '';
        $email = '';
        $senha = '';
        $link = '';
        $link_ficha_associativa_serasa = '';
        $link_contrato_serasa = '';
        $link_contrato = '';
        $tipo_contrato = '';
        

        if($tipo_html == 'htmlPadrao'){
            $mensagem = $mensagem_remetente;
        }

        if($tipo_html == 'htmlTermo'){
            $dados = explode('|', $mensagem_remetente);
            $nome = $dados[0];
            $email = $dados[1];
            $senha = $dados[2];
            $link = $dados[3];
            $link_ficha_associativa_serasa = '';
            $link_contrato_serasa = '';
            $link_ficha_associativa_sisbacen = '';
            $link_contrato_sisbacen = '';
            $link_contrato = '';
            $tipo_contrato = '';
        }

        if($tipo_html == 'htmlOrcamento'){
            $dados = explode('|', $mensagem_remetente);
            $nome = $dados[0];
            $email = $dados[1];
            $link = $dados[2];
            $link_ficha_associativa_serasa = '';
            $link_contrato_serasa = '';
            $link_ficha_associativa_sisbacen = '';
            $link_contrato_sisbacen = '';
            $link_contrato = '';
            $tipo_contrato = '';
        }

        if($tipo_html == 'htmlContrato'){
            $dados = explode('|', $mensagem_remetente);
            $nome = $dados[0];
            $email = $dados[1];
            $link_ficha_associativa_serasa = $dados[2];
            $link_contrato_serasa = $dados[3];
            $tipo_contrato = $dados[4];
            $link_contrato = $dados[5];
            $link_contrato_sisbacen = $dados[6];
            $link_ficha_associativa_sisbacen = $dados[7];
            
        }

        
        $data= array(
                'nome' => $nome,
                'email' => $email,
                'senha' => $senha,
                'link' => $link,
                'link_ficha_associativa_serasa' => $link_ficha_associativa_serasa,
                'link_contrato_serasa' => $link_contrato_serasa,
                'link_ficha_associativa_sisbacen' => $link_ficha_associativa_sisbacen,
                'link_contrato_sisbacen' => $link_contrato_sisbacen,
                'link_contrato' => $link_contrato,
                'tipo_contrato' => $tipo_contrato,

        );
        
        $remetente= array(
                'nome' => $data['nome'],
                'email' => $data['email']
        );

        $destinatario= array(
                'nome' => $nome_destinatario,
                'email' => $email_destinatario
        ); 

        //validando qual html irá ser usado
        $htmlEmail = 'emails.contact';//para uso no contato

        if($tipo_html == 'htmlPadrao')
            $htmlEmail = 'emails.htmlEmail';
        elseif($tipo_html == 'htmlTermo')
            $htmlEmail = 'emails.htmlTermo';  
        elseif($tipo_html == 'htmlOrcamento')
            $htmlEmail = 'emails.htmlOrcamento';  
        elseif($tipo_html == 'htmlContrato')
            $htmlEmail = 'emails.htmlContrato';         
               

        
        Mail::send($htmlEmail, $data, function($mail) use ($remetente,$destinatario,$subject,$file_attach)
        {
            $mail->subject($subject);
            if(isset($file_attach)){
                if($file_attach != ''){
                    $mail->attach($file_attach);
                }
            }  
            $mail->from('send@gruporecuperabrasil.com.br', 'Planilha');          
            $mail->to($destinatario['email'], $destinatario['nome']);
            $mail->replyTo($remetente['email'], $remetente['nome']);
            //$mail->bcc('xx@xx.com.br');
        });
        
        if( count(Mail::failures()) > 0 )
            return 'Error';
        else{
            return 'ok';
        }
    } 


    //envio teste de email
    public function send_email_teste()
    {
   
        $link = url('/xxx/xxx');
        /*dados que vem do form de contato*/   
        $data= array(
                'nome' => 'fulano',
                'email' => 'send@gruporecuperabrasil.com.br',
                'assunto' => 'assunto',
                'mensagem' => nl2br('cxxxxxxxxxxxxxxxxx xxxxxx uuuuu xxxxxxxx 10 link:'.$link) ,
        );
     
        $remetente= array(
                'nome' => $data['nome'],
                'email' => $data['email']
        );

        $destinatario= array(
                'nome' => 'XXXXXX',
                'email' => 'fernando.nvicente@gmail.com'
        );


            Mail::send('emails.contact', $data, function ($message) use ($remetente,$destinatario)
           {

               $message->subject('TESTE EMAIL LARAVEL');
               //$message->attach('dominio/docs/FICHA_CADASTRAL_ITURAN_SERVIÇOS.pdf');
               $message->from('send@gruporecuperabrasil.com.br', 'RECUPERA');
               $message->to($destinatario['email'], $destinatario['nome']);
               $message->replyTo($remetente['email'], $remetente['nome']);
               //$message->bcc('support@talkradio.com.br');
               //$message->bcc('opec@talkradio.com.br');
           });

           if( count(Mail::failures()) > 0 )
               echo 'Error!'; //return 'Error!';
            else
                echo 'Success!'; //return 'Success!';
               

    }

    public function returnHtmlContratoAtivacaoInterno($data)
    {
        $cont = '
            <!DOCTYPE html>
            <html>
            <head>
              <title>CONTRATO - ATIVAÇÃO DE RADIO</title>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            </head>
            <body>
              <center>
                <table width="800" height="" border="0" cellpadding="0" cellspacing="0">
                  <tr width="800" height="">
                    <td width="40"><img src="https://talksat.com.br/assets/images/marcacao-titulo.jpg" style="margin-top: 14px;"></td>
                    <td width="760"><p style="color: #000; font-family: Arial, Heveltica, sans-serif;font-size: 31px;text-align: left; margin: 0; margin-top: 14px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">

                        <span>Cara equipe <strong>Talk Radio</strong>,</span><br></p></td>
                  </tr>
                  <tr width="800" height="">
                    <td width="800" height="" colspan="2">
                      <br>
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Segue abaixo os dados para ativação da emissora.</p>

                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Radio:</strong> '.$data['radio'].' </p>


                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">

                        <table width="70%" class="x_table-bordered x_table-condensed x_table" cellspacing="0" cellpadding="0" border="1" style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">
                          <tr style="text-align: center;">
                            <td width="60%"><strong>Programa(s)</strong></td>
                            <td width="20%"><strong>Valor</strong></td>
                          </tr> 
                          '.$data['trTable'].'          
                        </table>

                      </p> 


                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Valor:</strong> '.$data['valor'].' </p>

                    

                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Código do Pedido:</strong> '.$data['pedido'].' </p>
                    

                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Contrato:</strong> 6 MESES</p>
                      
                
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Vendedor:</strong> '.$data['vendedor'].' </p>
                               

                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>E-mail principal:</strong> '.$data['emailPrincipal'].' </p>
                      
                      
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Contato 1:</strong> '.$data['contato1'].' </p>         
                      

                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Contato 2:</strong> '.$data['contato2'].' </p>
                      
                      
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Pagamento:</strong> <span style="color: #ff0000;">'.$data['pagamento'].'</span></p>';

                      if($data['linkBoleto']){
                      $cont .= '<p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Boleto:</strong> <a href="'.$data['linkBoleto'].'">Ver Boleto</a> </p>';
                      }
                     
                      $cont .= '<p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Vencimento do boleto:</strong> Todo dia <span style="color: #ff0000;">'.$data['vencimentoBoleto'].'</span> Subsequente</p>

                      
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Nota Fiscal:</strong> '.$data['notaFiscal'].' </p>
                               

                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em;  text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Código do Cadastro:</strong> '.$data['cadastro'].'</p>';

                      if($data['vendedor'] != 'VIA SITE'){
                        
                        $cont .='<p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em;  text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;"><strong>Histórico:</strong> '.$data['historico'].'
                        </p>';
                      }

                      $cont .= '<p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Segue <strong style="color: #ff0000;"><a href="https://talksat.com.br/assets/upload/contrato/'.$data['contrato'].'">link</a></strong> da copia do contrato assinado digitalmente.</p>

                      
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1.1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Atenciosamente.</p>
                      

                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">===============================================================</p>
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Fazemos programas de rádio e distribuimos para o rádio.</p>
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Nosso compromisso é entregar conteúdos que - envolva, empolgue, emocione.</p>
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Assim, ajudamos o rádio a permanecer por mais tempo no coração das pessoas.</p>
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">Talk Radio. Vai um conteúdo aí?</p>
                      <p style="color: #888787; font-family: Arial, Heveltica, sans-serif;font-size: 1em; text-align: left; margin: 0 20px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: normal;">===============================================================</p>
                      
                      

                    </td>
                  </tr>
                  <!--
                  <tr width="800" height="">
                    <td width="800" height="" colspan="2">
                      <table width="800" height="" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                            <table width="335" height="" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td>
                                  <img src="https://talksat.com.br/assets/assinaturas-email/assinatura-05-800px.jpg" border="0" style="display: block;" alt="Talk Radio (Assinatura de e-mail)">
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                -->
                </table>
              </center>
            </body>
            </html>
        ';

        return $cont;
    }
}
