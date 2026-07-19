# Sheaf UI Components

A collection of open source UI components built with Blade, Alpine.js, and Livewire for Laravel applications.

## Philosophy

We believe developers shouldn't waste time copy-pasting code from documentation or hunting through GitHub repositories for UI components. Sheaf UI streamlines your workflow by delivering production-ready components directly into your codebase with simple CLI commands.

Our philosophy centers on:
- **Enhanced Developer Experience**: Skip the copy-paste workflow entirely
- **Component Ownership**: Once installed, components are fully yours to customize
- **Laravel-First**: Built specifically for Laravel developers using familiar technologies
- **Open Source**: Community-driven development with transparent, accessible code

## Purpose

Sheaf UI exists to solve the common pain points Laravel developers face when building user interfaces:

- **Eliminate Copy-Paste Friction**: No more switching between documentation and your IDE
- **Accelerate Development**: Get from idea to implementation faster
- **Maintain Consistency**: Use battle-tested, production-ready components
- **Preserve Flexibility**: Components integrate seamlessly with your existing workflow

## Technology Stack

All components are built using:
- **Blade**: Laravel's templating engine for clean, maintainable markup
- **Alpine.js**: Lightweight JavaScript framework for reactive behavior
- **Livewire**: Full-stack framework for dynamic Laravel applications
- **Tailwind CSS**: Utility-first CSS framework for styling

Components support both Alpine.js and Livewire, allowing you to use one or both technologies based on your project needs.

## Installation & Usage

### CLI Tool

Install the Sheaf UI CLI tool in your Laravel project:

```bash
composer require sheaf/cli
```

Then install components with simple artisan commands:

```bash
php artisan sheaf:install button
php artisan sheaf:install modal
php artisan sheaf:install dropdown
```

### Platform & Documentation

Visit our platform at [sheafui.dev](https://sheafui.dev) for:
- Complete component documentation
- Live interactive examples
- Installation guides
- Customization tutorials

## Repository Structure

This repository contains the source code for all Sheaf UI components. Each component includes:
- Blade template files
- Alpine.js/Livewire integration
- Tailwind CSS styling
- Documentation and examples

## License

Sheaf UI is open source software licensed under the [MIT License](LICENSE).

---

**Ready to enhance your Laravel development workflow?** Visit [sheafui.dev](https://sheafui.dev) or install the CLI to get started.

## SheafUI MCP

Connect an MCP-compatible coding client to `https://sheafui.dev/mcp/sheafui`.

The server is public and read-only. It provides authoritative component APIs, complete UI patterns, and dependency-safe installation plans. All current components are Free and do not require a token.

For a build request, use the MCP workflow in this order:

1. Search the catalog.
2. Inspect the exact component or pattern records.
3. Plan the UI from catalog records.
4. Create an installation plan.

The MCP server does not write local files or execute commands. Your coding client remains responsible for running approved installation commands and applying changes in your project.
