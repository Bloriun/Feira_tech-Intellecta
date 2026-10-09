# Intellecta

Interface responsiva da rede social de aprendizagem Intellecta, construída em PHP puro com dados demonstrativos. O projeto prioriza uma experiência clara, minimalista e acessível em desktop e celular.

## O que está incluído

- Navegação entre login, cadastro, início, explorar, notificações, conversas e perfil.
- Layout responsivo com navegação móvel, sidebar e painel da Intellecta IA.
- Busca local em pessoas, conversas e publicações.
- Estados interativos para curtidas, formulários, ações rápidas e mensagens.
- Roteamento com allowlist e página 404.
- Escape de conteúdo dinâmico e formulários com labels acessíveis.

> Esta versão ainda é um protótipo front-end: login, persistência, upload e integrações sociais exibem estados demonstrativos e não gravam dados.

## Como executar

Requer PHP 8.0 ou superior:

```powershell
php -S localhost:8000
```

Depois, acesse `http://localhost:8000`. As páginas também podem ser acessadas com `?page=home`, `?page=explore`, `?page=notifications`, `?page=chat` e `?page=profile`.

## Organização para edição

```text
/
├── public/
│   └── index.php             # Entrada pública e passagem de dados para o layout
├── assets/
│   └── css/styles.css        # Sistema visual, responsividade e animações
├── src/
│   ├── bootstrap.php         # Inicialização única da aplicação
│   ├── config/routes.php     # Páginas permitidas e rota padrão
│   ├── data/
│   │   ├── mockData.php      # Agregador dos dados demonstrativos
│   │   └── mock/             # Dados separados por domínio
│   ├── layout/site.php       # Shell, navegação, ícones e JavaScript compartilhado
│   ├── pages/                # Uma página PHP por rota
│   └── utils/helpers.php     # Escape, iniciais e utilitários PHP
└── index.php                 # Atalho para public/index.php
```

### Onde editar

- **Cores, tipografia, espaçamento ou animações:** `assets/css/styles.css`.
- **Menu, logo, ícones, shell ou interações compartilhadas:** `src/layout/site.php`.
- **Uma tela específica:** arquivo correspondente em `src/pages/`.
- **Pessoas, posts, avisos ou mensagens de demonstração:** arquivos em `src/data/mock/`.
- **Novas páginas e rota padrão:** `src/config/routes.php`.
- **Comportamento persistente:** substituir os mocks por uma camada de dados, sem misturar consultas dentro das páginas.
