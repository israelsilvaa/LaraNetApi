## Instalação e configuração de dependências/variáveis de ambiente do sistema.

### `Xampp v3.3` - [Download⬇️](https://www.apachefriends.org/download.html)     

1. **A instalação no windows é simples, basta ir clicando next:**
   
        Ao final basta definir o php como Variável de ambiente.
        - pesquise por "Editar as variáveis de ambiente do sistema".
        - Na aba "Avançado" > botão "Variáveis de ambiente...".
        - Abaixo de "Variáveis do sistema" clique na variável "Path".
        - adicione um novo com o local onde vc instalou o xampp (exemp: C:\xampp\php).
        - Acessando o terminal, o comando `php -v` deve retornar a versão .

        - Edite o arquivo `php.ini` (localizado em `C:\xampp\php\php.ini`) .
        - e descomente as seguintes linhas removendo o `;`
    ```ini
    ;extension=zip 
    ```

### `Composer v2.5` - [Download⬇️](https://getcomposer.org/download/) 

1. Apos ter o xampp instalado e ter definido o php como variável de ambiente, basta executar o composer e dar next 
    
        - Acessando o terminal, o comando `composer -v` deve retornar a versão.

### `Node ^v18.18.0` - [Download⬇️](https://nodejs.org/dist/v18.18.0/node-v18.18.0-x64.msi)

1. **A instalação no windows é também simples, basta ir clicando next:**
      
        - Acessando o terminal, o comando `node -v` deve retornar a versão .

### `.env` 

        - Crie um arquivo `.env` na pasta raiz do projeto e cole tudo de `.env.example`  
        - A seguir configure as variáveis:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nome_do_banco_de_dados
DB_USERNAME=seu_usuario  
DB_PASSWORD=sua_senha   
```
   
[Voltar a pagina principal](/README.md)
