# AuraEvents - Sistema de Gerenciamento de Eventos

## Descrição
AuraEvents é um sistema web simples desenvolvido em PHP para gerenciamento de usuários e eventos. Permite cadastro, listagem, edição e exclusão de usuários e eventos, além de funcionalidades de login/logout e inscrição/desinscrição em eventos. O projeto segue uma estrutura MVC simplificada, com pastas dedicadas para operações CRUD.

## Tecnologias Utilizadas
- **Backend:** PHP
- **Banco de Dados:** MySQL (via XAMPP)
- **Frontend:** HTML, CSS (style.css), JavaScript básico
- **Servidor:** XAMPP (Apache + MySQL)

## Estrutura de Pastas
```
AuraEvents/
├── controller/       # Controladores (eventoscontroller.php, usuariocontroller.php)
├── model/           # Modelos (eventosmodel.php, usuariomodel.php)
├── view/            # Views principais (index.php, admin.php, login.php, etc.)
├── cadastro/        # Páginas de cadastro
├── listagem/        # Páginas de listagem
├── editar/          # Páginas de edição
├── delete/          # Páginas de exclusão
├── db/              # Configuração do banco (database.php)
├── sql_backup/      # Backup SQL (auraevents.sql)
├── style.css        # Estilos globais
└── README.md
```

## Como Configurar e Executar
1. Instale o XAMPP e inicie Apache e MySQL.
2. Copie a pasta `AuraEvents` para `c:/Turma2/xampp/htdocs/`.
3. Importe o banco de dados: Abra phpMyAdmin (http://localhost/phpmyadmin), crie um DB chamado `auraevents` e importe `sql_backup/auraevents.sql`.
4. Acesse http://localhost/AuraEvents/ no navegador.
5. Faça login como admin (verifique credenciais no banco ou cadastre um usuário).

## Como Funciona
- **Fluxo MVC:** As views chamam controladores, que interagem com modelos para CRUD no banco via `db/database.php`.
- **Usuários:** Cadastro (`cadastrousuario.php`), listagem, edição, exclusão, login/logout.
- **Eventos:** Cadastro (`cadastroevento.php`), listagem (`listarevent.php`), edição, exclusão.
- **Inscrição:** 
  - `inscrever.php`: Inscreve usuário em evento.
  - `desinscrever.php`: Remove inscrição.
- **Admin:** Painel em `admin.php` para gerenciar tudo.

### Decisão sobre Inscritos
Optei por **não criar um controller e model específicos para "inscritos"**, pois achei mais viável integrar essa funcionalidade diretamente nos models e controllers existentes de usuários e eventos. Inscrições são relações diretas no banco (tabela pivot users-events), evitando redundância, complexidade desnecessária e mantendo o código simples e escalável.

## Problemas Comuns
- Erros de conexão: Verifique credenciais em `db/database.php`.
- Permissões: Certifique-se de que o usuário do DB tem acesso total.

Qualquer dúvida, revise os arquivos ou o banco SQL!

