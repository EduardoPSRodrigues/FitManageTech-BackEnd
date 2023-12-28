![FITNESSE MANAGE TECH](https://github.com/EduardoPSRodrigues/FitManageTech-BackEnd/assets/135388215/2cc28446-6e31-4f5b-ac2c-4c18f0b326f6)

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API FITNESS MANAGE TECH

O FITNESS MANAGE TECH é uma aplicação baseada em uma API REST que integra-se ao banco de dados PostgreSQL. Foi desenvolvida para a gestão de usuários, possibilitando o acesso ao sistema por 24 horas; caso contrário, o token JWT é automaticamente revogado. Além disso, oferece funcionalidades como cadastro e listagem de exercícios, treinos e estudantes, além de recursos adicionais, como o envio de um e-mail de boas-vindas para novos usuários e a geração de um PDF contendo os treinos do estudante.

## 💻 TECNOLOGIAS UTILIZADAS 

Projeto foi desenvolvido utilizando as seguintes tecnologias:

- Linguagem PHP com o framework Laravel na versão 10.
- Banco de dados PostgreSQL.
- Versionamento utilizando GitHub.
- Geração de PDF com a biblioteca [DOMPDF](https://github.com/barryvdh/laravel-dompdf).

## 🔣 ARQUITETURA DO PROJETO

O projeto foi organizado em uma estrutura de pastas, visando aprimorar o controle, a implementação e a manutenção do código.

**Organização das Pastas** 

| Local | Uso |
| ------ | ------ |
| app/Http/Controllers | Gerencia a lógica de controle da aplicação, processando as requisições e fornecendo respostas adequadas. |
| app/Http/Middleware | Implementa camadas intermediárias entre a requisição e a resposta, aplicando lógicas específicas antes ou após a execução das rotas. |
| app/Mail | Armazena os templates e configurações para o envio de e-mails, como o e-mail de boas-vindas aos novos usuários. |
| app/Models | Contém os modelos de dados, representando entidades do sistema e responsáveis pela interação com o banco de dados. |
| app/Traits | Oferece funcionalidades compartilhadas entre diferentes classes, promovendo a reutilização de código. |
| database/migrations | Contém os arquivos de migração do banco de dados, facilitando a criação e manutenção da estrutura de dados. |
| resources/views/emails | Armazena os arquivos de visualização dos templates. |
| resources/views/pdfs | Responsável pela geração e manipulação de arquivos PDF, especialmente os relacionados aos treinos dos estudantes. |
| routes | Agrupa as definições de rotas da aplicação, direcionando as requisições HTTP para as ações apropriadas nos controllers. |

## 📅 CRONOGRAMA

Dessa forma, o cronograma oferece uma representação visual e organizada das diversas etapas do projeto, proporcionando uma visão abrangente e detalhada da sequência temporal do projeto.

| Data | Atividades |
 ------ | ------ |
| 16/12/2023 | Início do desenvolvimento do projeto, instalação das dependências e criação da conexão ao BD e do repositório no GitHub. |
| 17/12/2023  | Criação do controller e da tabela do cadastro do usuário; atualização da timezone do projeto. |
| 18/12/2023 | Funcionalidade para realizar o login do usuário e a atualização do tempo de expiração do token. |
| 19/12/2023 | Funcionalidade para gerar o dashboard do usuário e para realizar o cadastro, a listagem e a deleção de exercícios. |
| 21/12/2023 | Funcionalidade para realizar o cadastro, a listagem e a deleção de estudantes. |
| 22/12/2023 | Funcionalidade para realizar a atualização do estudante e para realizar o cadastro dos treinos. |
| 23/12/2023 | Funcionalidade para realizar a listagem dos treinos do estudante e para listar também o treino do estudante através do ID. |
| 26/12/2023 | Funcionalidade para realizar a exportação do treino em PDF. |
| 27/12/2023 | Funcionalidade para enviar um e-mail de boas-vindas ao usuário cadastrado no sistema. |
| 28/12/2023 | Formatação da documentação do Readme. |
| 29/12/2023 | Preparação do vídeo de apresentação e envio do projeto no AVA.  |

## ▶️ COMO EXECUTAR O PROJETO

- Clonar o repositório https://github.com/EduardoPSRodrigues/FitManageTech-BackEnd

- Criar uma base de dados no PostgreSQL com o nome **academia_api**.

- Depois de clonar o repositório, abra o projeto e no terminal execute o comando:

```
composer install
```

- Abra o arquivo .env na raiz do projeto e configure os seguintes parâmetros:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=academia_api
DB_USERNAME=admin
DB_PASSWORD=admin
```

- Para utilizar o e-mail é necessário configurar as linhas 31 a 35 do arquivo .env:

```
MAIL_MAILER=smtp
MAIL_HOST= (Seus dados de e-mail)
MAIL_PORT= (Seus dados de e-mail)
MAIL_USERNAME= (Seus dados de e-mail)
MAIL_PASSWORD= (Seus dados de e-mail)
```

- Para instalar a biblioteca de PDF, basta executar o comando:

```
composer require barryvdh/laravel-dompdf
```

- Para deixar a API online, basta executar o comando:

```
php artisan serve
```

### OBSERVAÇÕES

- Depois de fazer todos os passos acima, caso esteja utilizando o programa Docker com o DBeaver para acessar o banco de dados, basta abrir o PowerShell como administrador e executar o seguinte comando no terminal:

```
docker run --name academia -e POSTGRESQL_USERNAME=admin -e POSTGRESQL_PASSWORD=admin -e POSTGRESQL_DATABASE=academia_api -p 5432:5432 bitnami/postgresql
```

- Com o Docker sendo executado e o DBeaver configurado, abra o projeto e digite o comando:
  
```
php artisan migrate
```

## 💻 DEMONSTRAÇÃO DA API 

#### S01 - Cadastro de Usuário

```http
  POST http://127.0.0.1:8000/api/users
```

| Parâmetro  | Tipo      | Descrição                          |
| ---------- | --------- | ---------------------------------- |
| name | string | Nome do usuário e obrigatório. |
| email | string | E-mail do usuário válido e obrigatório. |
| date_birth | date_format:Y-m-d | Data de aniversário (Formato: 1990-01-16) e obrigatório. |
| cpf | string | CPF do usuário único, máximo: 14 e obrigatório.  |
| password | string | Senha com mínimo de 8 caracteres, máximo de 32 caracteres e obrigatório. |
| plan_id | integer | Tipo de plano do usuário (Bronze: 1, Prata: 2, Outro: 3 |

Request JSON exemplo
```http
  {
  "name": "Eduardo Phelipe",
  "email": "eduardo@teste.com",
  "date_birth": "1990-01-16",
  "cpf": "108.091.417-01",
  "plan_id": 2
}
```

| Response Status       | Descrição                           |
|  :--------- | :---------------------------------- |
|  201 | Usuário criado com sucesso |
|  400 | Falha ao cadastrar. Dados inválidos|

