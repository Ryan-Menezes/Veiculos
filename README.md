# Loja de Veículos
Uma loja para venda de diversos tipos de veículos
## Configuração
Tenha o [Composer](https://getcomposer.org/) instalado em sua máquina e através de seu terminal entre no diretório do projeto e rode o comando "composer update":
```sh
cd "diretório do projeto"
composer update
```
<br>Vá ao arquivo "schemadb/database.sql" e rode todas as querys que estiverem por lá.<br><br>
Após essa configuração inicial, vá na raiz do projeto e procure pelo arquivo ".env.example" e o renomeie para ".env", no mesmo arquivo altere as constantes do sistema de acordo com a sua necessidade, porém para que o projeto funcione sem problemas informe as configurações de email para que o laravel consiga enviar emails e as configurações de acesso ao banco de dados:
```sh
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=veiculos
DB_USERNAME=root
DB_PASSWORD=
```
```sh
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
```
Por fim acesse o diretório raiz do projeto através de seu terminal e rode o comando "php artisan migrate --seed":
```sh
cd "diretório do projeto"
php artisan migrate --seed
```
## Informações Adicionais
Template do Site: [HVAC](https://themewagon.com/themes/free-bootstrap-4-html5-automotive-business-website-template-hvac/)<br>
Template do Painel: [Laravel-AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)