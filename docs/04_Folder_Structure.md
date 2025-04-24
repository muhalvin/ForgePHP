# Folder Structure

The default structure of a ForgePHP project is:

```
forgephp/
├── app/
│   └── Models/
├── cli/
│   ├── create_model.php
│   ├── create_migration.php
├── config/
│   └── autoload.php
├── database/
│   └── migrations/
├── public/
│   └── index.php
├── views/
├── forge (CLI Entry Point)
```

- `app/Models`: Your application models
- `cli/`: ForgePHP CLI command scripts
- `config/`: Configuration files
- `database/migrations/`: Migration files
- `public/`: Web root directory
- `views/`: Blade-like PHP views
- `forge`: The CLI script
