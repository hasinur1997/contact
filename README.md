# Contact Plugin for WordPress

A simple and efficient WordPress plugin for managing contacts. This plugin allows users to create, update, delete, and retrieve contacts seamlessly within the WordPress dashboard.

## Features

- Create, update, delete, and fetch contacts
- Seamless integration with WordPress
- Admin panel for managing contacts
- REST API support for external integration

## Installation

### 1. Download and Install
- Download the plugin ZIP file or clone the repository:
```bash
git clone https://github.com/hasinur1997/contact.git
```
- Upload the `contact` folder to the `/wp-content/plugins/` directory.
- Activate the plugin via the WordPress admin panel under **Plugins**.

### 2. Install Dependencies
- Navigate to the plugin directory:
```bash
cd contact
```
- Install PHP dependencies:
```bash
composer install
```
- Install JavaScript dependencies:
```bash
npm install
```
- Build assets:
```bash
npm run start
```

### 3. Configure Settings
- Navigate to **Settings > Contact Plugin** to configure options.
- Set up necessary API keys or customization settings.

## Usage

- Go to **Contacts** in the WordPress dashboard to add, edit, or delete contacts.
- Use the provided shortcodes to display contact lists on pages or posts.
- Utilize the REST API endpoints for programmatic access.

## API Endpoints

| Method | Endpoint               | Description            |
|--------|------------------------|------------------------|
| GET    | `/wp-json/contact/v1/contacts` | Get all contacts  |
| GET    | `/wp-json/contact/v1/contacts/{id}` | Get a contact by ID |
| POST   | `/wp-json/contact/v1/contacts` | Create a new contact |
| PUT    | `/wp-json/contact/v1/contacts/{id}` | Update a contact  |
| DELETE | `/wp-json/contact/v1/contacts/{id}` | Delete a contact  |

## Contributing

Feel free to contribute! Fork the repo, make changes, and submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).
