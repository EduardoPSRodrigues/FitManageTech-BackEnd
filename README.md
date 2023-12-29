<div align="center">
<img src="public/Ola.png" width="900px" alt="Ola" />
</div>

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

## ✳️ DEMONSTRAÇÃO DA API 

#### S01 - Cadastro de Usuário - Rota Pública

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

JSON Content
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
|  --------- | ---------------------------------- |
|  201 | Usuário criado com sucesso |
|  400 | Falha ao cadastrar. Dados inválidos|

#### Após realizar o cadastro do usuário, o mesmo recebe um e-mail de boas vindas especificando o tipo de plano e o limite de cadastro de estudantes.

<div align="center">
<img src="public/Email de Boas Vindas.png" width="700px" alt="Email de boas-vindas" />
</div>

##
#### S02 - Login - Rota Pública

```http
  POST http://127.0.0.1:8000/api/login
```

| Parâmetro  | Tipo      | Descrição                          |
| ---------- | --------- | ---------------------------------- |
| email | string | E-mail do usuário válido e obrigatório. |
| password | string | Senha obrigatória. |


JSON Content
```http
{
"email": "eduardo@teste.com",
"password": "12345678"
}
```

JSON Response
```http
{
  "message": "Autorizado",
  "status": 200,
  "data": {
    "name": "Eduardo Phelipe",
    "token": "62|n7112mmyFI7aV5bfKNwpO1zGkysWOQK2Bd1TN68g0f420033"
  }
}
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Usuário logado com sucesso |
|  401 | Não autorizado. Credenciais incorretas|

#### A partir desse momento se faz necessário o uso do token em todas as rotas, pois as rotas são privadas. Vale ressaltar que o token tem validade de 24 horas.

##
#### S03 - Dashboard - Rota Privada

Colar o token em Auth -> Bearer

À medida que o usuário cadastra exercícios e estudantes, o sistema atualiza o Dashboard e impede o registro de novos estudantes se o limite do plano for atingido.

```http
  GET http://127.0.0.1:8000/api/dashboard
```

JSON Response
```http
{
  "registered_students": 0,
  "registered_exercises": 0,
  "current_user_plan": "PLANO PRATA",
  "remaining_students": 20
}
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Dados do dashboard |
|  401 | Não autorizado.|

##
#### S04 - Cadastro de exercícios - Rota Privada

Colar o token em Auth -> Bearer

```http
  POST http://127.0.0.1:8000/api/exercises
```

| Parâmetro  | Tipo      | Descrição                          |
| ---------- | --------- | ---------------------------------- |
| description | string | O exercício é obrigatório e possui o máximo de 255 caracteres |

JSON Content
```http
{
"description": "Supino"
}
```

JSON Response
```http
{
  "description": "Supino",
  "id": 30
}
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  201 | Exercício criado com sucesso. |
|  400 | Falha ao cadastrar. Dados inválidos. |
|  409 | Conflito. O exercício já existe para este usuário.|

##
#### S05 - Listagem de exercícios - Rota Privada

Colar o token em Auth -> Bearer

```http
  GET http://127.0.0.1:8000/api/exercises
```

JSON Response
```http
[
  {
    "id": 32,
    "description": "Abdominal"
  },
  {
    "id": 31,
    "description": "Flexão"
  },
  {
    "id": 30,
    "description": "Supino"
  }
]
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Resposta com os dados. |
|  500 | Token inválido. |


##
#### S06 - Deleção de exercícios - Rota Privada

Colar o token em Auth -> Bearer

```http
  DELETE http://127.0.0.1:8000/api/exercises/30
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  204 | Exercício deletado com sucesso. |
|  403 | O usuário não pode deletar esse exercício. |
|  404 | Exercício não encontrado no banco de dados. |
|  409 | Conflito. Não é permitido deletar o exercício, pois está vinculado a um treino.|
|  500 | Token inválido. |

##
#### S07 - Cadastro de estudante - Rota Privada

Colar o token em Auth -> Bearer

```http
  POST http://127.0.0.1:8000/api/students
```

| Parâmetro  | Tipo      | Descrição                          |
| ---------- | --------- | ---------------------------------- |
| name | string | O nome é obrigatório e possui o máximo de 255 caracteres |
| email | string | O e-mail é obrigatório, válido, único e possui o máximo de 255 caracteres |
| date_birth | date | A data é obrigatória e no formato yyyy-mm-dd |
| cpf | string | O CPF é obrigatório, mín:11, máx:14 caracteres e único |
| contact | string | O contato é obrigatório e possui o máximo de 20 caracteres |
| city | string | A cidade possui o máximo de 50 caracteres, é opcional e pode ser nulo |
| neighborhood | string | O bairro possui o máximo de 50 caracteres, é opcional e pode ser nulo |
| number | string | O número possui o máximo de 30 caracteres, é opcional e pode ser nulo |
| street | string | A rua possui o máximo de 30 caracteres, é opcional e pode ser nulo |
| state | string | O estado possui o máximo de 2 caracteres, é opcional e pode ser nulo |
| cep | string | O cep possui o máximo de 20 caracteres, é opcional e pode ser nulo |


JSON Content
```http
{
    "name": "Henrique Douglas",
    "email": "henrique@example.com",
    "date_birth": "1996-02-22",
    "cpf": "111.222.333-44",
    "contact": "(78) 901-2345",
    "cep": "98765-432",
    "street": "Maple Avenue",
    "state": "IL",
    "neighborhood": "Downtown",
    "city": "Chicago",
    "number": "3839"
}
```

JSON Response
```http
{
  "name": "Henrique Douglas",
  "email": "henrique@example.com",
  "date_birth": "1996-02-22",
  "cpf": "111.222.333-44",
  "contact": "(78) 901-2345",
  "cep": "98765-432",
  "street": "Maple Avenue",
  "state": "IL",
  "neighborhood": "Downtown",
  "city": "Chicago",
  "number": "3839",
  "id": 162
}
```

#### Foi implementado um Middleware, com o nome ValidateLimitStudentsToUser, para fazer o controle do limite de cadastro dos estudantes de acordo com o plano do usuário.

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  201 | Estudante criado com sucesso. |
|  400 | Falha ao cadastrar. Dados inválidos. |
|  403 | Não é possível cadastrar um novo estudante, pois atingiu o limite do plano.|

##
#### S08 - Listagem de estudantes - Rota Privada

Colar o token em Auth -> Bearer

```http
  GET http://127.0.0.1:8000/api/students?search
```

JSON Response
```http
[
  {
    "id": 163,
    "name": "Afonso Padilha",
    "email": "afonso@example.com",
    "date_birth": "1996-02-22",
    "cpf": "222.333.444-55",
    "contact": "(11) 102-4526",
    "city": "São Paulo",
    "neighborhood": "Centro",
    "number": "12",
    "street": "Avenida Paulista Avenue",
    "state": "SP",
    "cep": "98765-432"
  },
  {
    "id": 162,
    "name": "Henrique Douglas",
    "email": "henrique@example.com",
    "date_birth": "1996-02-22",
    "cpf": "111.222.333-44",
    "contact": "(78) 901-2345",
    "city": "Chicago",
    "neighborhood": "Downtown",
    "number": "3839",
    "street": "Maple Avenue",
    "state": "IL",
    "cep": "98765-432"
  }
]
```

#### Ao utilizar o Query Parameters é possui filtrar o resultado através do nome, CPF ou e-mail do estudante.

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Resposta com os dados. |
|  500 | Token inválido. |


##
#### S09 - Deleção de estudante - Rota Privada

Colar o token em Auth -> Bearer

```http
  DELETE http://127.0.0.1:8000/api/students/163
```

#### Utiliza-se o Soft Delete para fazer a deleção do estudante.

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  204 | Estudante deletado com sucesso. |
|  403 | O usuário não pode deletar esse estudante. |
|  404 | O estudante não está cadastrado no banco de dados. |
|  500 | Token inválido. |


##
#### S010 - Atualização de estudante - Rota Privada

Colar o token em Auth -> Bearer

```http
  PUT http://127.0.0.1:8000/api/students/162
```

| Parâmetro  | Tipo      | Descrição                          |
| ---------- | --------- | ---------------------------------- |
| name | string | O nome possui o máximo de 255 caracteres e é opcional |
| email | string | O e-mail é válido, único, possui o máximo de 255 caracteres e é opcional |
| date_birth | date | A data possui o formato yyyy-mm-dd e é opcional |
| cpf | string | O CPF possui o mín:11, máx:14 caracteres e único e é opcional |
| contact | string | O contato possui o máximo de 20 caracteres e é opcional |
| city | string | A cidade possui o máximo de 50 caracteres, é opcional e pode ser nulo |
| neighborhood | string | O bairro possui o máximo de 50 caracteres, é opcional e pode ser nulo |
| number | string | O número possui o máximo de 30 caracteres, é opcional e pode ser nulo |
| street | string | A rua possui o máximo de 30 caracteres, é opcional e pode ser nulo |
| state | string | O estado possui o máximo de 2 caracteres, é opcional e pode ser nulo |
| cep | string | O cep possui o máximo de 20 caracteres, é opcional e pode ser nulo |


JSON Content
```http
{
 "name": "Henrique Douglas Pereira da Costa Neto"
}
```

JSON Response
```http
{
  "id": 162,
  "name": "Henrique Douglas Pereira da Costa Neto",
  "email": "henrique@example.com",
  "date_birth": "1996-02-22",
  "cpf": "111.222.333-44",
  "contact": "(78) 901-2345",
  "city": "Chicago",
  "neighborhood": "Downtown",
  "number": "3839",
  "street": "Maple Avenue",
  "state": "IL",
  "cep": "98765-432"
}
```

#### É possível atualizar todos ou apenas um campo do estudante.

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Estudante atualizado com sucesso. |
|  404 | Falha em atualizar: O usuário não tem permissão ou o estudante não está cadastrado no banco de dados.|

##
#### S11 - Cadastro de treinos - Rota Privada

Colar o token em Auth -> Bearer

```http
  POST http://127.0.0.1:8000/api/workouts
```

| Parâmetro  | Tipo      | Descrição                          |
| ---------- | --------- | ---------------------------------- |
| student_id | integer | O id do estudante é obrigatório |
| exercise_id | integer |  O id do exercício é obrigatório |
| repetitions | integer | A repetição é obrigatória |
| weight | numeric | O peso é obrigatório |
| break_time | integer | O tempo de pausa é obrigatório |
| day | enum | O dia é obrigatório e as opções são: SEGUNDA, TERÇA, QUARTA, QUINTA, SEXTA, SÁBADO, DOMINGO |
| observations | string | As observações são opcionais e pode ser nula |
| time | integer | O tempo de execução é obrigatório |

JSON Content
```http
{
  "student_id": "162",
  "exercise_id": "34",
  "repetitions": "10",
  "weight": "8",
  "break_time": "2",
  "day": "DOMINGO",
  "observations": "Unilateral",
  "time": "1"
}
```

JSON Response
```http
{
  "exercise_id": "34",
  "repetitions": "10",
  "weight": "8",
  "break_time": "2",
  "observations": "Unilateral",
  "time": "1"
}
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  201 | Treino criado com sucesso. |
|  409 | O treino já está cadastrado para este dia. |
|  409 | O usuário não tem permissão para cadastrar um treino para esse aluno ou o exercício é inválido. |
|  500 | Token inválido. |

##
#### S12 - Listagem dos treinos do estudante - Rota Privada

Colar o token em Auth -> Bearer

```http
  GET http://127.0.0.1:8000/api/students/workouts?student_id=162
```

#### Passar o student_id via Query Parameters.

JSON Response
```http
{
  "student_id": "162",
  "student_name": "Henrique Douglas Pereira da Costa Neto",
  "workouts": {
    "SEGUNDA": [
      {
        "workout_details": {
          "exercise_id": 31,
          "repetitions": 10,
          "weight": "2",
          "break_time": 1,
          "observations": null,
          "time": 1
        },
        "exercise_details": {
          "id": 31,
          "description": "Flexão"
        }
      }
    ],
    "TERÇA": [
      {
        "workout_details": {
          "exercise_id": 35,
          "repetitions": 10,
          "weight": "10",
          "break_time": 1,
          "observations": "Drop 7",
          "time": 1
        },
        "exercise_details": {
          "id": 35,
          "description": "Halter"
        }
      }
    ],
    "QUARTA": [
      {
        "workout_details": {
          "exercise_id": 35,
          "repetitions": 10,
          "weight": "10",
          "break_time": 1,
          "observations": "Drop 7",
          "time": 1
        },
        "exercise_details": {
          "id": 35,
          "description": "Halter"
        }
      }
    ]
  }
}
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Resposta com os dados. |
|  403 | O usuário não tem permissão para visualizar essas informações. |
|  401 | Não autenticado. |

##
#### S13 - Listagem dos dados do estudante - Rota Privada

Colar o token em Auth -> Bearer

```http
  GET http://127.0.0.1:8000/api/students/162
```

JSON Response
```http
{
  "id": 162,
  "name": "Henrique Douglas Pereira da Costa Neto",
  "email": "henrique@example.com",
  "date_birth": "1996-02-22",
  "cpf": "111.222.333-44",
  "contact": "(78) 901-2345",
  "city": "Chicago",
  "neighborhood": "Downtown",
  "number": "3839",
  "street": "Maple Avenue",
  "state": "IL",
  "cep": "98765-432"
}
```

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Resposta com os dados. |
|  404 | O estudante não foi encontrado. |
|  500 | Token inválido. |

##
#### S14 - Exportação dos Treinos em PDF - Rota Privada

Colar o token em Auth -> Bearer

```http
  GET http://127.0.0.1:8000/api/students/export?student_id=162
```

#### Ao utilizar a extensão vscode-pdf (autor: tomoki1207) será possível salvar ou visualizar o arquivo gerado.

| Response Status       | Descrição                           |
|  --------- | ---------------------------------- |
|  200 | Resposta com os dados. |
|  403 | O usuário não tem permissão para visualizar essas informações. |
|  500 | Token inválido. |

<div align="center">
<img src="public/" width="700px" alt="Print do arquivo em PDF" />
</div>


