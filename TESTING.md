# Testes no projeto

O projeto usa PHPUnit para Laravel e Vitest com Testing Library para React.

## Preparação

```bash
nvm use
npm install
composer install
```

## Comandos

```bash
php artisan test
npm test
npm run test:watch
npm run typecheck
npm run build
```

## Onde criar os primeiros testes

- Fluxos Laravel e contratos Inertia: `tests/Feature`
- Regras PHP isoladas: `tests/Unit`
- Componentes React: arquivos `*.test.tsx` próximos ao componente
- Configuração global do React: `resources/js/test/setup.ts`

## Exemplos disponíveis

- `tests/Feature/AppointmentFlowTest.php` valida a página Inertia, os dados enviados ao React, o cadastro e os erros de validação.
- `resources/js/Features/Appointments/components/AppointmentList.test.tsx` valida a renderização de dados reais do domínio e o estado vazio.
