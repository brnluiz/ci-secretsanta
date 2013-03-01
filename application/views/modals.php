<div id="addUserModal" class="modal hide fade" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <?if($acc_switch != 'account'):?><h3 id="addUserModalLabel">Inscrição</h3>
    <?else:?><h3 id="addUserModalLabel">Minha conta</h3>
    <?endif;?>
    <div id="addUserModalalert" style="display: block; margin-top: 10px;  margin-bottom: -10px"></div>
  </div>
  <div class="modal-body">
    <?=form_open('main/save');?>
    <?if($acc_switch != 'account'):?>
        <p>Preencha o formulário abaixo se desejar participar do amigo secreto da "Páscoa do SBL"</p>
    <?else:?>
        <p>Atualize os dados abaixo</p>
    <?endif;?>
      <?foreach($input as $i): ?>
        <?=form_input($i)?>
      <?endforeach?>
      <?=form_password($pswd)?>
      <br/>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <button class="btn btn-primary" id="addUserModalSave">Salvar</button>
  </div>
</div>

<div id="loginModal" class="modal hide fade" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="loginModalLabel">Login</h3>
    <div id="loginModalalert" style="display: block; margin-top: 10px; margin-bottom: -10px"></div>
  </div>
  <div class="modal-body">
    <br/>
    <?=form_open('main/login');?>
        <?=form_input(array('name'=>'email','class'=>'span6','placeholder'=>'E-mail'))?>
        <?=form_password(array('name'=>'pswd','class'=>'span6','placeholder'=>'Senha'))?>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <button class="btn btn-primary" id="loginModalSave">Login</button>
  </div>
</div>

<script>
$(document).ready(function(){
  $('#add-modal-open').click(function(){
    $('#addUserModal').modal('show');
  });

  $('#login-modal-open').click(function(){
    $('#loginModal').modal('show');
  });

  $('#addUserModal form').submit(function(){save();});
  $('#addUserModal form input').keydown(function(event){if(event.keyCode == 13) save();});
  $('#addUserModalSave').click(function(){save();});

  $('#loginModal > .modal-body > form').submit(function(){login();});
  $('#loginModal form input').keydown(function(event){if(event.keyCode == 13) login();});
  $('#loginModalSave').click(function(){login();});
});

function save()
{
  $.ajax({
    url: 'main/save',
    data: $('#addUserModal form').serializeArray(),
    type: "POST",
    success: function(data){
      $('#addUserModalalert').html(data).slideDown(200,function() {
        $('#addUserModalalert').delay(3000).slideUp(200);
      });
      return false;
    },
    error: function(data){
      $('#addUserModalalert').html(data).slideDown(200,function() {
        $('#addUserModalalert').delay(3000).slideUp(200);
      });
      return false;
    }
  });
  return false;
}
function login()
{
  $.ajax({
    url: 'main/login',
    data: $('#loginModal form').serializeArray(),
    type: "POST",
    success: function(data){
      $('#loginModalalert').html(data).slideDown(200,function() {
        $('#loginModalalert').delay(3000).slideUp(200);
      });
      return false;
    },
    error: function(data){
      $('#loginModalalert').html(data).slideDown(200,function() {
        $('#loginModalalert').delay(3000).slideUp(200);
      });
      return false;
    }
  });
  return false;
}
</script>