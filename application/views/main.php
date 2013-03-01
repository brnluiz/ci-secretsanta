<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Amigo secreto de páscoa do #SBL">
    <meta name="author" content="Bruno Luiz da Silva">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
    <style>
      body{font-family: Cabin, Arial, sans-serif; background: url("img/kindajean.png") repeat;}
      form > p{padding-bottom: 10px; font-weight: 700}
      form > input{width: 95%; font-family: Cabin}
      button{font-family: Cabin; font-weight: 700}
      #header{background: #fafafa; border-bottom: 1px solid #ccc; padding: 35px 15px 20px 15px; margin-bottom: 20px; margin-left: 5px;}
      #header > h1{margin-left: 30px;}
      .container{border:1px solid #ccc; box-shadow: 0 0 3px #ccc; background: #fff; padding: 0 15px 10px; margin-top: 10px;}
      .table td{text-align: center!important}

    </style>
  </head>

<?php
$input[0] = array('name'=>'name', 'placeholder'=>'Nome', 'class'=>'span4');
$input[1] = array('name'=>'email', 'placeholder'=>'E-mail', 'class'=>'span3');
$input[2] = array('name'=>'address', 'placeholder'=>'Endereço', 'class'=>'span4');
$input[3] = array('name'=>'number', 'placeholder'=>'Número do local', 'class'=>'span3');
$input[5] = array('name'=>'city', 'placeholder'=>'Cidade', 'class'=>'span4');
$input[4] = array('name'=>'area', 'placeholder'=>'Bairro', 'class'=>'span3');
$input[6] = array('name'=>'state', 'placeholder'=>'Estado', 'class'=>'span2');
$input[7] = array('name'=>'zip', 'placeholder'=>'CEP', 'class'=>'span2');
$input[8] = array('name'=>'twitter', 'placeholder'=>'Twitter (não obrigatório)', 'class'=>'span3', 'style'=>'padding-right: 23px');
$input[9] = array('name'=>'mobile', 'placeholder'=>'Celular', 'class'=>'span4');
$input[10] = array('name'=>'phone', 'placeholder'=>'Telefone', 'class'=>'span3');
$input[11] = array('name'=>'obs', 'placeholder'=>'Observações (apartamento, bloco ou outros - não obrigatório) ', 'class'=>'span4');
$pswd = array('name'=>'pswd', 'placeholder'=>'Senha do usuário', 'class'=>'span3');

if(isset($user_data))
{
  $input[0]['value'] = $user_data['name'];
  $input[1]['value'] = $user_data['email'];
  $input[2]['value'] = $user_data['address'];
  $input[3]['value'] = $user_data['number'];
  $input[4]['value'] = $user_data['city'];
  $input[5]['value'] = $user_data['area'];
  $input[6]['value'] = $user_data['state'];
  $input[7]['value'] = $user_data['zip'];
  $input[8]['value'] = '@'.$user_data['twitter'];
  $input[9]['value'] = $user_data['mobile'];
  $input[10]['value'] = $user_data['phone'];
  $input[11]['value'] = $user_data['obs'];
}

?>

  <body>
    <div class="container">
        <div class="row">
          <div class="span12" id="header">
            <h1>Páscoa do SBL
              <?php if($acc_switch == 'login'): ?>
                <a href="#" id="add-modal-open" class="btn btn-primary" style="margin-bottom: 10px; margin-left: 10px">Inscreva-se!</a>
                <a href="#" id="login-modal-open" class="btn" style="margin-bottom: 10px;">Login</a>
              <?php elseif($acc_switch == 'account'):?>
                <a href="#" id="add-modal-open" class="btn btn-primary" style="margin-bottom: 10px; margin-left: 10px">Atualizar dados</a>
                <a href="main/logout" class="btn" style="margin-bottom: 10px;">Logout</a>
              <?php endif;?>
            </h1>
          </div>
        </div>
        <div class="row">
          <div class="span8">
            <h3 align="center">Atuais inscritos</h3>
            <?if(!empty($users)): ?>
            <table class="table">
              <?foreach($users as $user):?>
                <tr>
                  <td>
                    <?if(!empty($user->twitter)):?>
                    <a href="http://twitter.com/<?=$user->twitter?>">
                      <?=$user->name?> - 
                      @<?=$user->twitter?>
                    </a>
                    <?else:?>
                      <?=$user->name?>
                    <?endif;?>
                  </td>
                </tr>

              <?endforeach;?>
            </table>
            <?else:?>
            <div class="alert">
              <strong>Ninguém se registrou ainda...</strong>
            </div>
            <?endif;?>
          </div>
          <div class="span4">
            <h3 align="center">Informações</h3>
            <p>Sobre o Amigo Chocolate do SBL: </p>
<p>- Se o amigo morar na mesma cidade, dá para comprar em qualquer loja física ou via internet. Mas a entrega seria pelos Correios?</p>
<p>- Se o amigo morar no mesmo estado, dá para comprar em qualquer loja física ou via internet e enviar pelos Correios. OK.</p>
<p>- Se o amigo morar noutro estado, temos sites como os da Americanas e Submarino. Inclusive isso já foi citado e disseram que o ovo chega intacto. OK.</p>

<p>Outras questões:</p>
<p>- Sendo baseado no Amigo Secreto, suponho que ele seja... err... secreto. Logo, teríamos que compartilhar os endereços entre os participantes antes de sortear quem vai presentear quem. Ou algo assim.</p>
<p>- Questões adicionais, anyone?</p>
          </div>
        </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <?php include('modals.php'); ?>
  </body>
</html>
