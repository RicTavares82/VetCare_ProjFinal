# VetCare

## Descrição

O VetCare é uma aplicação Web para apoio à gestão de uma clínica veterinária. Foi desenvolvida no âmbito da UC0604 – Aplicação Web com Laravel.

A aplicação permite gerir informação sobre animais, tutores, espécies, veterinários, consultas, serviços e notas. Os tutores autenticados podem consultar apenas os seus próprios animais. O administrador tem acesso à gestão dos dados da clínica.

## Autor

- Ricardo Tavares

## Tecnologias utilizadas

- PHP 8.5
- Laravel 13
- SQLite
- Eloquent ORM
- Blade
- Bootstrap
- Vite
- Spatie Laravel Permission

## Funcionalidades

### Área pública

- Consulta da página inicial da clínica sem autenticação.
- Acesso à página de login.

### Autenticação e perfis

- Login e logout de utilizadores.
- Dois perfis de acesso: `admin` e `user`.
- O perfil `user` só pode consultar os seus próprios animais.
- O perfil `admin` pode consultar todos os animais e aceder às operações de gestão de animais.
- O acesso a operações administrativas é validado no servidor através do middleware de roles.

### Animais

- Listagem de animais.
- Consulta do detalhe de um animal.
- Criação, edição e eliminação de animais para o administrador.

> O detalhe do animal e o restante CRUD estão em desenvolvimento e serão completados antes da entrega final.

### Dados da clínica

O modelo de dados já inclui espécies, veterinários, consultas, serviços e notas. Estes dados são criados pelos seeders e serão usados nas restantes áreas da aplicação à medida que forem desenvolvidas.

## Instalação e execução

### Requisitos

- PHP 8.5 ou superior
- Composer
- Node.js e npm

### Passos

1. Instalar as dependências PHP:

   ```bash
   composer install
   ```

2. Instalar as dependências JavaScript:

   ```bash
   npm install
   ```

3. Criar o ficheiro de configuração, caso ainda não exista:

   ```bash
   copy .env.example .env
   ```

4. Gerar a chave da aplicação:

   ```bash
   php artisan key:generate
   ```

5. Criar as tabelas e inserir os dados de teste:

   ```bash
   php artisan migrate:fresh --seed
   ```

6. Compilar os assets:

   ```bash
   npm run build
   ```

7. Iniciar a aplicação:

   ```bash
   php artisan serve
   ```

Para desenvolvimento, em vez do passo 6, pode ser usado:

```bash
npm run dev
```

## Utilizadores de teste

Todos os utilizadores de teste têm a password `password`.

| Nome | Email | Role |
| --- | --- | --- |
| Administrador | admin@vetcare.pt | admin |
| Ana Silva | ana@email.pt | user |
| João Santos | joao@email.pt | user |
| Maria Costa | maria@email.pt | user |

## Modelo de dados

As tabelas principais da aplicação são:

| Tabela | Descrição |
| --- | --- |
| `users` | Utilizadores da aplicação e tutores dos animais. |
| `species` | Espécies dos animais. |
| `pets` | Animais registados na clínica. |
| `veterinarians` | Veterinários da clínica. |
| `appointments` | Consultas dos animais. |
| `services` | Serviços prestados pela clínica. |
| `notes` | Notas associadas a animais ou consultas. |
| `appointment_service` | Tabela pivot entre consultas e serviços. |

As relações implementadas são:

- Um utilizador pode ter vários animais.
- Uma espécie pode estar associada a vários animais.
- Um animal pode ter várias consultas.
- Um veterinário pode realizar várias consultas.
- Uma consulta pode ter vários serviços e um serviço pode estar em várias consultas.
- Uma nota pode estar associada a um animal ou a uma consulta através de uma relação polimórfica.

### Diagrama da base de dados

```text
User 1 -------- N Pet N -------- 1 Species
                    |
                    | 1
                    |
                    N
              Appointment N -------- 1 Veterinarian
                    |
                    | N
                    |
                    N
                 Service

Appointment N -------- N Service
              appointment_service

Pet 1 -------- N Note
Appointment 1 - N Note
                  |
                  +-- relação polimórfica (noteable)
```

## Migrations e seeders

As migrations criam as tabelas do domínio da aplicação e as tabelas necessárias ao package Spatie Laravel Permission. Os seeders inserem dados de teste para roles, utilizadores, espécies, animais, veterinários, serviços, consultas e notas.

O ficheiro `DatabaseSeeder` executa os seeders pela ordem necessária para respeitar as relações entre os dados.

## Fontes e apoios utilizados

- Conteúdos, exemplos e enunciados fornecidos na UC00604 (videos gravados em aulas, exercicios de projetos feitos em aula).
- Documentação oficial do Laravel: https://laravel.com/docs
- Documentação oficial do Bootstrap: https://getbootstrap.com/docs
- Documentação do package Spatie Laravel Permission: https://spatie.be/docs/laravel-permission
- Ferramentas de Inteligência Artificial, usadas pontualmente para esclarecer conceitos, escrever este README, interpretar erros e rever soluções. O código foi analisado, adaptado e compreendido pelo autor.

## Funcionalidades futuras

- Concluir o ecrã de detalhe dos animais.
- Permitir que cada tutor consulte as consultas dos seus animais.
- Adicionar validação completa e mensagens de feedback a todos os formulários.
- Implementar pesquisa, filtros, paginação e ordenação nas listagens.
- Adicionar imagens aos animais.

## Declaração de originalidade

Eu, Ricardo Tavares, declaro que este projeto foi desenvolvido por mim no âmbito da UC00604.

Declaro também que as fontes externas, ferramentas e apoios relevantes utilizados foram identificados neste README. Não copiei código de outros colegas ou grupos e apenas utilizei ficheiros existentes e pré fornecidos pelo Formador para usar neste trabalho.

Qualquer exemplo ou apoio externo utilizado foi analisado, adaptado e compreendido por mim. A utilização de ferramentas de Inteligência Artificial foi pontual e não substituiu o meu trabalho de desenvolvimento e aprendizagem.

Assumo a responsabilidade pela estrutura, funcionamento e opções técnicas adotadas neste projeto.
