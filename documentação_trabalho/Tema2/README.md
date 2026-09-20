# Tema exemplo 2 — VetCare

## Descrição

A **VetCare** é uma aplicação Web para apoio à gestão de uma clínica veterinária.

Os visitantes podem consultar informação geral sobre a clínica, os serviços disponíveis e outras informações públicas.

Os utilizadores autenticados podem consultar os seus animais, visualizar informação associada aos mesmos e acompanhar as respetivas consultas.

Os administradores podem gerir os animais registados, veterinários, consultas, espécies e serviços disponibilizados pela clínica.

A aplicação deverá distinguir conteúdo público de funcionalidades reservadas a utilizadores autenticados.

### Perfis

Serão utilizados dois roles:

* `admin` — pode gerir os dados da clínica, animais, veterinários, consultas e serviços;
* `user` — representa o tutor/proprietário dos animais e pode consultar os seus animais e respetivas consultas.

Não são utilizadas permissõess individuais.

## Modelo de dados sugerido

Uma possível estrutura seria:

| Tabela | Finalidade |
| --- | --- |
| `users` | Utilizadores da aplicação e tutores dos animais |
| `pets` | Animais registados na clínica |
| `species` | Espécies dos animais |
| `veterinarians` | Veterinários da clínica |
| `appointments` | Consultas dos animais |
| `services` | Serviços prestados pela clínica |
| `notes` | Notas associadas a diferentes entidades |

Além destas existirá a tabela pivot:

```text
appointment_service
````

Relações principais:

```text
User 1 -------- N Pet

Species 1 ----- N Pet

Pet 1 --------- N Appointment

Veterinarian 1 - N Appointment

Appointment N -- N Service
                |
        appointment_service


Pet 1 --------- N Note
Appointment 1 - N Note
                  ↑
            relação polimórfica
```

Um utilizador com role `user` representa o tutor dos animais.

Cada animal pertence a um utilizador e a uma espécie.

Um animal poderá possuir várias consultas ao longo do tempo e cada consulta será realizada por um veterinário.

Uma consulta poderá ainda incluir vários serviços e o mesmo serviço poderá ser utilizado em várias consultas, originando uma relação N:N entre `appointments` e `services`.

A relação polimórfica poderá ser implementada através de:

```text
notes
-----
id
user_id
body
noteable_id
noteable_type
timestamps
```

Assim, uma nota poderá pertencer, por exemplo, a um `Pet` ou a um `Appointment`.

---

# Templates HTML fornecidos aos alunos

Os seguintes templates são deliberadamente escritos em **HTML normal**, sem Blade.

Existe repetição do menu, mensagens, rodapé e estrutura das páginas. Essa repetição é intencional: uma das tarefas do grupo será transformar estes ficheiros numa estrutura Blade reutilizável.

Os exemplos de CRUD são fornecidos apenas para o recurso **Animais (`pets`)**. Os ficheiros constituem apenas um ponto de partida para o desenvolvimento da aplicação.

O grupo deverá:

* transformar os ficheiros HTML em views Blade;
* criar um layout comum;
* remover código repetido;
* integrar Bootstrap e restantes assets através do Vite;
* substituir os dados estáticos por informação proveniente da base de dados;
* implementar as rotas, controllers, models, migrations e seeders necessários;
* adaptar e desenvolver a interface de acordo com a sua visão da aplicação.

Os restantes recursos deverão ser desenvolvidos pelo grupo seguindo os mesmos princípios.

