# AVALIAÇÃO CRUD DE ESCOLAS
Aplicação Web do tipo monolitica criada com:
- PHP para o backend ^7.4
- HTML, CSS e Javascript pro frontend
- MySQL/MariaDB para o banco de dados

## Funcionalidades
- CRUD de Alunos
- CRUD de Professores
- CRUD de Cursos
- CRUD de Usuários
- CRUD de Categorias

## Passo a passo para rodar o projeto
Certifique-se que seu computador tem
- PHP
- MySQL ou MariaDB
- Editor de texto (por exemplo VS code)
- Navegador Web
- Composer (Gerenciador de pacotes do PHP)

#### Clone o projeto
Baixe ou faça o clone do repositorio:
`git clone https://github.com/camylla-araujo/AvCrudPHP.git`

Após isso, entre no diretorio que foi gerado
`cd av-crud-php-oo`

#### Habilitar as extensões do PHP
Abra o diretório de instalação do PHP, encontro o arquivo *php.ini-production*, renomeie-o para *php.ini* e abra-o com algum de editor de texto.

Encontre as seguintes linhas e descomente-as, removendo; que precede a linha.

- pdo_mysql
- curl
- mb_string
- openssl

#### Instalar as dependencias
Dentro do diretório da aplicação execute no terminal:

`composer install`

Certifique-se que um diretório chamado **/vendor** foi criado.

#### Banco de Dados

> O bando de dados é do tipo relacional e contém as tabelas com até 2 níveis de normatização.

...

#### Criando o banco de dados
Entre no seu clinente de banco de dados, e execute o comando:

```sql
CREATE DATABASE db_escola;
```

#### Migrar a estrutura do banco de dados
Ainda dentro do cliente do banco de dados, copie e cole o conteúdo do arquivo
**db.sql** e execute.

Certifique-se que as tabelas foram criadas, executando o comando:

```sql
SHOW TABLES;
```

Se o resultado for a lista de tabelas existentes, estão pronto!

### Executando a aplicação
Para mostrar e testar a aplicação, dentro do terminal execute:
`php -S localhost:8000 -t public`

Agora acesse o endereço http://localhost:8000 em seu navegador