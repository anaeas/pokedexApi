<form class="text-center mt-5" method="POST" action="/cadastro">
    @csrf
    <h1 class="text-primary mb-4">Cadastro de Treinador</h1>
    <div class="form-group">
        <label for="nome">Nome do Treinador</label>
        <input type="text" class="form-control" name="nome" id="nome">
    </div>
    <div class="form-group">
        <label for="email">E-mail do Treinador</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="senha">Senha do Treinador</label>
        <input type="password" class="form-control" name="senha" id="senha">
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
