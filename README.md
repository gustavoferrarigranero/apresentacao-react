# Projeto inicial — Agenda com Laravel + Blade

Aplicação funcional usada como ponto de partida da aula “React no Ecossistema Laravel”. Ela mantém a interface em Blade, usa navegação tradicional e concentra as regras no backend.

## Executar

```bash
composer setup
php artisan migrate:fresh --seed
composer dev
```

Acesse `http://localhost:8000/agenda`.

## Testes

```bash
composer test
```
