# DevCMS

A modern web application built with [Laravel 11](https://laravel.com/) tailored for game-related CMS features, including user authentication, ticketing, permissions, badges, news publishing, and more.

---

## 🔧 Prerequisites

Before running this Laravel project, make sure the following tools are installed:

### 🐘 PHP & Composer

**Install PHP (v8.2+) and Composer:**

### 💡 Install Homebrew (macOS only)

If you don’t have Homebrew yet, install it first:

```/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"```

#### On macOS (with Homebrew):
```
brew install php
brew install composer
```

## 🚀 Features

- 🔐 Authentication with Laravel Jetstream
- 🎫 Support Ticket System (User & Housekeeping side)
- 📰 News & Article Management
- 🏷️ Badge Display and Management
- ⚙️ Housekeeping Panel with rank-based permissions
- 📦 Caching (Database/Redis ready)
- 💬 Word filter, bans, and chat log viewer
- 💸 Store with cryptocurrency payment support (NOWPayments)
- 🖼️ Asset and Image Sync from external sources (e.g., HabboAssets)
- 🌐 Group Forums (Nitro integration-ready)
- 🛠️ Maintenance Mode with bypass for staff
- 🌍 Localization-ready
- 🔐 Email verification, rank-based access, and more

---

## 📦 Requirements

- PHP >= 8.2
- Composer
- MySQL or MariaDB
- Node.js & NPM
- Laravel CLI
- Git

---

## ⚙️ Installation

1. **Clone the repository**
   ```git clone git@github.com:rbegin95/DevCMS.git```
   ```cd DevCMS```
   

3. **Install backend dependencies**
   ```composer install```

4. **Install frontend dependencies and compile assets**
   ```
   npm install
   npm run dev
   ```

5. **Create environment file**
   ```
   cp .env.example .env
   ```

6. **Set application key**
   ```
   php artisan key:generate
   ```

7. **Configure your `.env`**
   Update database, mail, and any other required variables.

8. **Run migrations and seeders**
   ```
   php artisan migrate --seed
   ```

9. **Run the server**
   ```
   php artisan serve
   ```

---

## 🛠 Housekeeping Tools

Staff panel under `/housekeeping` includes:

- Support ticket handling
- Rank & permission editing
- Crypto store logging
- Badge syncing
- Site settings (maintenance, tabs)
- User bans and chat logs
- Activity logs
- Inventory review and moderation

---

## 🔒 Authentication

Laravel Jetstream handles:
- Registration/login
- Email verification
- Session control
- Password resets

---

## 🧪 Testing

To run tests:
```
php artisan test
```
---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## 📄 License

MIT License. See [`LICENSE`](LICENSE) for details.

---

## 👤 Maintainer

- **Richard Begin** – [@chunk082](https://github.com/chunk082)

