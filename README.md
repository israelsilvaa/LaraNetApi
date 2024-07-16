# LaraNetApi - Api da aplicação de Redes.

Descrição aqui...

> [!TIP] 
> Enunciado do projeto:
> [Clique aqui](/docs/enunciado_do_projeto.md)

<!-- 
> [!NOTE] Enunciado do desafio
> tetete
> 
> [!TIP]
> Helpful advice for doing things better or more easily.

> [!IMPORTANT]
> Key information users need to know to achieve their goal.

> [!WARNING]
> Urgent info that needs immediate user attention to avoid problems.

> [!CAUTION]
> Advises about risks or negative outcomes of certain actions. -->


## Instruções de execução

Pré-requisitos, instale em ordem (windows) - [Como instalar](/docs/instalacao_dependencias_execucao.md)
1. Xampp v3.3 
2. Composer v2.5 
3. Node v18.X 
 
Após baixar e instalar as dependências, execute os passos:

1. Iniciar o servidor apache do xampp e mysql.

2. **Comandos no terminal (dentro do diretório do projeto):**

   - Composer install

   - php artisan key:generate

   - php artisan migrate
  
   - php artisan db:seed
   
   - php artisan jwt:secret

   - php artisan serve
   
   Em outro terminal, executar:  

   - npm install
   
   - npm install vuex
   
   - npm run dev

Após isso basta clicar no link que aparecera no terminal ou acessar em seu navegador a url: http://127.0.0.1:8000

## Use o acesso abaixo:

login: esocial@teste   
senha: 123123123

  
## Autenticação

Esta API requer autenticação com JSON Web Token para acessar determinados endpoints. Por favor, consulte a documentação para obter detalhes sobre como autenticar suas solicitações: [link para a documentação](/docs/api/instrucoes_de_autenticacao.md).

- **Descrição**: Recurso de registro e login de usuário.
- **Endpoints**:
  - ![POST](https://img.shields.io/badge/HTTP-POST-00CC00)  [ /api/register](/docs/api/instrucoes_de_autenticacao.md)
  - ![POST](https://img.shields.io/badge/HTTP-POST-00CC00)  [ /api/login](/docs/api/instrucoes_de_autenticacao.md)
  - ![POST](https://img.shields.io/badge/HTTP-POST-00CC00)  [ /api/refresh](/docs/api/instrucoes_de_autenticacao.md)
  - ![POST](https://img.shields.io/badge/HTTP-POST-00CC00)  [ /api/logout](/docs/api/instrucoes_de_autenticacao.md)
  - ![POST](https://img.shields.io/badge/HTTP-POST-00CC00)  [ /api/me](/docs/api/instrucoes_de_autenticacao.md)



<!-- > [!NOTE]
> Useful information that users should know, even when skimming content.

> [!TIP]
> Helpful advice for doing things better or more easily.

> [!IMPORTANT]
> Key information users need to know to achieve their goal.

> [!WARNING]
> Urgent info that needs immediate user attention to avoid problems.

> [!CAUTION]
> Advises about risks or negative outcomes of certain actions. -->
