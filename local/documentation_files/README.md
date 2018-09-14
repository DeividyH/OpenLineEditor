# README #

### Pre-requisitos ###

* Servidor HTTP com banco de dados (recomendado: Xampp).
* Conexão com internet para visualização dos mapas no sistema.
* Editor de texto para o desenvolvimento (recomendado: VS Code ,Sublime ou Atom).

### Como fazer o *deploy* da aplicação? ###

* Criar uma base de dados chamada openlineeditor
* Importar o banco de dados por meio do arquivo openlineeditor.sql, presente neste repositório, na base de dados criada anteriormente ou migrar os dados dos modelos por meio do comando: "php artisan migrate" ([ver documentacao do Laravel](https://laravel.com/docs/5.2/migrations)).
* Colocar a pasta "www", presente neste repositório, no diretório para exibição do conteúdo web do seu servidor HTTP escolhido (exemplo Xampp: "$ xampp/htdocs/").
* Alterar as informacoes referentes ao acesso ao banco de dados no arquivo ".env" dentro da pasta "www".
* Acessar pelo browser o diretório public do sistema (exemplo: "http://localhost/www/public/").


### Duvidas? ###

* Contato no e-mail: deividy_henrique@hotmail.com
                     udo@pucpcaldas.br 