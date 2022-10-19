<h2><?=esc($title)?></h2>

<?=session()->getFlashdata('error')?><!--Função é usada para relatar erros relacionados a proteção CSRF-->
<?=service('validation')->listErrors()?><!--Função é usada para relatar erros relacionados a validação do formulario-->

<form action="/news/create" method="post">
    <?=csrf_field()?><!-- Função cria uma entrada oculta com um token CSRF que ajuda a proteger contra alguns ataques comuns-->
    <label for="title">Title</label>
    <input type="input" name="title"/><br/>

    <label for="body">Text</label>
    <textarea name="body" cols="45" rows="4"></textarea><br/>

    <input type="submit" name="submit" value="Create news item"/>

</form>
