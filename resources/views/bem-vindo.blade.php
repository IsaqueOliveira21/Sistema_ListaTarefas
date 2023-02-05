Site da Aplicacao

@auth <!-- TUDO QUE ESTIVER ENTRE AS TAGS AUTH SO SERAO EXIBIDOS SE O USUARIO ESTIVER LOGADO -->
    <h1>USUARIO AUTENTICADO</h1>
    <p>ID: {{Auth::user()->id}}</p>
    <p>Nome: {{Auth::user()->name}}</p>
    <p>E-mail: {{Auth::user()->email}}</p>
@endauth

@guest <!-- TUDO QUE ESTIVER ENTRE AS TAGS GUEST SO SERAO EXIBIDOS A USUARIOS QUE NAO ESTIVEREM LOGADOS -->
    <h1>BEM VINDO AO NOSSO SITE!</h1>
@endguest
