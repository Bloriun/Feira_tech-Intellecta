# Intellecta

Interface responsiva da rede social de aprendizagem Intellecta, construída em PHP puro com dados demonstrativos. O projeto prioriza uma experiência clara, minimalista e acessível em desktop e celular.

## O que está incluído

- Navegação entre login, cadastro, início, explorar, notificações, conversas, perfil, salvos, tópicos, perfil público e as telas de conta, preferências, privacidade, segurança, ajuda e políticas.
- Layout responsivo com navegação móvel, sidebar e painel da Intellecta IA.
- Busca local em pessoas, conversas e publicações.
- Estados interativos para publicação, curtidas, salvos, seguir, formulários, preferências, ações rápidas e mensagens.
- Roteamento com allowlist e página 404.
- Escape de conteúdo dinâmico e formulários com labels acessíveis.

> Esta versão é uma experiência demonstrável local: não há autenticação ou banco externo. As interações de conta, conversa e perfil são simuladas em memória no navegador.

## Como executar

Requer PHP 8.0 ou superior:

```powershell
php -S localhost:8000 -t public
```

Depois, acesse `http://localhost:8000`. As páginas também podem ser acessadas com `?page=home`, `?page=explore`, `?page=notifications`, `?page=chat`, `?page=profile`, `?page=saved`, `?page=topics`, `?page=public-profile`, `?page=editar-perfil`, `?page=sua-conta`, `?page=informacoes-conta`, `?page=configuracao-senha`, `?page=alterar-senha`, `?page=preferencias`, `?page=privacidade`, `?page=seguranca`, `?page=ajuda`, `?page=termos` e `?page=privacidade-legal`.

## Organização para edição

```text
/
├── public/
│   └── index.php             # Entrada pública e passagem de dados para o layout
├── assets/
│   ├── css/
│   │   ├── app.css           # Sistema visual, responsividade e animações
│   │   └── styles.css        # Entrada de compatibilidade
│   └── js/app.js             # Ponto de entrada para módulos JS
├── src/
│   ├── app/bootstrap.php     # Inicialização única da aplicação
│   ├── config/routes.php     # Páginas permitidas e rota padrão
│   ├── data/
│   │   ├── data.php          # Agregador dos dados demonstrativos
│   │   ├── community/        # Pessoas e publicações
│   │   ├── messaging/        # Conversas
│   │   └── system/           # Notificações
│   ├── components/shell/     # Shell, navegação, ícones e IA
│   ├── features/             # Páginas PHP agrupadas por domínio
│   └── utils/helpers.php     # Escape, iniciais e utilitários PHP
├── docs/                     # Arquitetura, contribuição e guia visual
└── index.php                 # Atalho para public/index.php
```

### Onde editar

- **Cores, tipografia, espaçamento ou animações:** `assets/css/app.css`.
- **Menu, logo, ícones, shell ou interações compartilhadas:** `src/components/shell/site.php`.
- **Uma tela específica:** arquivo correspondente em `src/features/<domínio>/`.
- **Pessoas, posts, avisos ou mensagens de demonstração:** arquivos em `src/data/<domínio>/`.
- **Novas páginas e rota padrão:** `src/config/routes.php`.
- **Decisões de arquitetura e validação:** [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md) e [`docs/CONTRIBUTING.md`](docs/CONTRIBUTING.md).
