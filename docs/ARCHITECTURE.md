# Arquitetura do Intellecta

O projeto usa PHP puro, sem framework ou bundler, mantendo as URLs existentes no formato `?page=...`.

## Fluxo da aplicação

1. [`public/index.php`](../public/index.php) recebe a requisição.
2. [`src/app/bootstrap.php`](../src/app/bootstrap.php) carrega helpers, rotas e dados.
3. [`src/config/routes.php`](../src/config/routes.php) valida a página e aponta para a view da feature.
4. [`src/components/shell/site.php`](../src/components/shell/site.php) renderiza o shell compartilhado.
5. A view da feature recebe o contexto de dados e renderiza somente a coluna central.

## Organização

- `src/app`: inicialização da aplicação.
- `src/components`: shell e componentes reutilizáveis.
- `src/features`: páginas agrupadas por domínio de produto.
- `src/data`: dados demonstrativos separados por domínio.
- `src/config`: configuração e allowlist de rotas.
- `src/utils`: funções utilitárias.
- `assets/css`: entrada de estilos e camadas visuais.
- `assets/js`: ponto de entrada para scripts compartilhados e módulos futuros.

## Regras de manutenção

- Preserve os nomes das rotas públicas.
- Escape conteúdo dinâmico com `e()`.
- Prefira componentes compartilhados a HTML duplicado.
- Mantenha a identidade visual definida em `assets/css/app.css`.
- O estado atual é demonstrativo e vive em memória do navegador/sessão; não há autenticação ou banco real.
