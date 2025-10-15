# Jadwal Taklim

<div align="center">

**Platform untuk menemukan jadwal kajian dan taklim di masjid-masjid sekitar Anda.**

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3-4FC08D?style=flat&logo=vue.js)](https://vuejs.org)
[![Inertia.js](https://img.shields.io/badge/Inertia.js-Latest-9553E9?style=flat)](https://inertiajs.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)

**[Demo](#) • [Documentation](PROJECT_CONTEXT.md) • [Report Bug](https://github.com/akbarabustang/jadwal-taklim/issues) • [Request Feature](https://github.com/akbarabustang/jadwal-taklim/issues)**

---

### ⭐ If you find this project useful, please consider giving it a star! ⭐

**Created with ❤️ by [Akbar Abustang](https://github.com/akbarabustang)**

---

</div>

## ✨ Features

### 🌐 Public Features

**Homepage**
- Display upcoming jadwal taklim with complete information
- Ustadz name, schedule, mosque location, kajian title
- Card-based modern design
- Quick access to all schedules

**Complete Schedule Page**
- Comprehensive table view of all schedules
- Advanced filtering:
  - Filter by kajian category (Tafsir, Hadits, Fiqih, Akhlaq, etc.)
  - Filter by city/location
  - Real-time search by title, ustadz name, or mosque name
- Pagination for easy navigation
- Active filter badges
- Clear filter functionality

**Ustadz Profile Pages**
- Dedicated pages for each ustadz
- List of all schedules by ustadz
- Contact information

**SEO & Performance**
- Meta descriptions and keywords
- Open Graph tags for social media sharing
- Twitter Card support
- Server-side rendering with Inertia.js
- Dynamic page titles
- Responsive design (mobile, tablet, desktop)

### 🔐 Admin Panel Features

**Authentication & Security**
- Secure login/logout system (Laravel Breeze)
- Admin middleware for route protection
- Role-based access control (is_admin flag)
- Password visibility toggle
- Session management
- CSRF protection

**Admin Dashboard**
- Real-time statistics:
  - Total schedules count
  - Active schedules
  - Upcoming schedules
  - Category distribution
- Recent schedules overview
- Category statistics with progress bars
- Quick action buttons
- Modern green-themed UI

**Schedule Management (CRUD)**
- **Create**: Add new schedules with comprehensive form
  - Schedule details (title, description)
  - Ustadz information
  - Mosque details (name, address, city)
  - Date and time selection
  - Frequency (once, daily, weekly, monthly)
  - Category selection
  - Contact information
  - Active/inactive status
- **Read**: View all schedules with:
  - Search functionality
  - Status filter (active/inactive)
  - Sortable columns
  - Pagination
- **Update**: Edit existing schedules
  - Pre-filled form data
  - Validation on update
- **Delete**: Remove schedules
  - Modern confirmation modal
  - Soft delete protection

**User Experience**
- Flash messages for success/error feedback
- Loading indicators with blur overlay
- Page transition animations
- Responsive admin interface
- Breadcrumb navigation
- Intuitive layout

**Error Pages**
- Custom 404 (Page Not Found)
- Custom 403 (Access Denied)
- Modern design matching app theme

## 🛠 Tech Stack

- **Backend**: Laravel 12 (Latest)
- **Frontend**: Inertia.js + Vue 3
- **Styling**: Tailwind CSS
- **Database**: MySQL/SQLite
- **Server-Side Rendering**: Inertia.js SSR support

## 🎨 Color Scheme

- **Primary (Orange)**: `#f97316` - Warm and inviting
- **Secondary (Green)**: `#059669` - Islamic/peaceful theme
- **White**: `#FFFFFF` - Clean background

## 📋 Prerequisites

Before you begin, ensure you have the following installed:
- PHP >= 8.2
- Composer
- Node.js >= 20.x
- MySQL or SQLite
- npm or yarn

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd jadwal-taklim
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database**
   
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=jadwal_taklim
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
   
   Or use SQLite (default):
   ```env
   DB_CONNECTION=sqlite
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Build assets**
   ```bash
   npm run build
   ```
   
   For development with hot reload:
   ```bash
   npm run dev
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   
   Open your browser and visit: `http://localhost:8000`

## 🔐 Admin Access

The application includes a complete admin panel for managing schedules.

### Default Admin Credentials

After running the seeders, an admin account is automatically created:

- **Email**: `admin@jadwaltaklim.com`
- **Password**: `password`

### Accessing Admin Panel

1. Navigate to: `http://localhost:8000/login`
2. Enter the admin credentials above
3. After login, you'll be redirected to the admin dashboard
4. Admin routes:
   - Dashboard: `/admin/dashboard`
   - Manage Schedules: `/admin/schedules`
   - Create Schedule: `/admin/schedules/create`
   - Edit Schedule: `/admin/schedules/{id}/edit`

### Security Notes

⚠️ **Important**: Change the default admin password immediately in production!

- Admin routes are protected by authentication middleware
- Only users with `is_admin = true` can access admin panel
- Unauthorized access attempts will result in 403 Forbidden error

## 📝 Database Structure

### Taklim Schedules Table

| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary key |
| title | string | Judul kajian/taklim |
| description | text | Deskripsi kajian |
| ustad_name | string | Nama ustadz/pengisi |
| mosque_name | string | Nama masjid |
| mosque_address | text | Alamat lengkap masjid |
| mosque_city | string | Kota/kabupaten |
| schedule_date | datetime | Tanggal kajian |
| start_time | time | Jam mulai |
| end_time | time | Jam selesai |
| frequency | enum | once, daily, weekly, monthly |
| category | string | Kategori kajian (Tafsir, Hadits, dll) |
| is_active | boolean | Status aktif |
| contact_person | string | Narahubung |
| contact_number | string | Nomor kontak |

## 🎯 Available Routes

### Public Routes
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | / | home | Homepage with upcoming schedules |
| GET | /jadwal | schedule.index | Full schedule table with filters |
| GET | /ustadz/{slug} | ustadz.show | Ustadz profile page |

### Authentication Routes
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | /login | login | Login page |
| POST | /login | - | Process login |
| POST | /logout | logout | Logout user |
| GET | /register | register | Registration page (optional) |

### Admin Routes (Protected)
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | /admin/dashboard | admin.dashboard | Admin dashboard with stats |
| GET | /admin/schedules | admin.schedules.index | List all schedules |
| GET | /admin/schedules/create | admin.schedules.create | Create schedule form |
| POST | /admin/schedules | admin.schedules.store | Save new schedule |
| GET | /admin/schedules/{id}/edit | admin.schedules.edit | Edit schedule form |
| PUT | /admin/schedules/{id} | admin.schedules.update | Update schedule |
| DELETE | /admin/schedules/{id} | admin.schedules.destroy | Delete schedule |

## 🔧 Development Commands

```bash
# Run development server with hot reload
npm run dev

# Build for production
npm run build

# Run Laravel development server
php artisan serve

# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📁 Project Structure

```
jadwal-taklim/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   └── ScheduleController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ScheduleController.php
│   │   │   └── UstadzController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── HandleInertiaRequests.php
│   └── Models/
│       ├── TaklimSchedule.php
│       └── User.php
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_taklim_schedules_table.php
│   │   └── add_is_admin_to_users_table.php
│   └── seeders/
│       ├── AdminUserSeeder.php
│       ├── TaklimScheduleSeeder.php
│       └── DatabaseSeeder.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   ├── Components/
│   │   │   └── LoadingIndicator.vue
│   │   ├── Layouts/
│   │   │   ├── AdminLayout.vue
│   │   │   └── AppLayout.vue
│   │   ├── Pages/
│   │   │   ├── Admin/
│   │   │   │   ├── Dashboard.vue
│   │   │   │   └── Schedules/
│   │   │   │       ├── Index.vue
│   │   │   │       ├── Create.vue
│   │   │   │       └── Edit.vue
│   │   │   ├── Auth/ (Breeze auth pages)
│   │   │   ├── Home.vue
│   │   │   ├── Schedule/
│   │   │   │   └── Index.vue
│   │   │   └── UstadzProfile.vue
│   │   └── app.js
│   └── views/
│       └── app.blade.php
└── routes/
    ├── auth.php
    └── web.php
```

## 🌟 SEO Features

- Meta descriptions and keywords
- Open Graph tags for Facebook
- Twitter Card tags
- Semantic HTML structure
- Server-side rendering with Inertia.js
- Dynamic page titles

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 Roadmap

For detailed project roadmap and development phases, please refer to [PROJECT_CONTEXT.md](PROJECT_CONTEXT.md).

**Upcoming Features:**
- Progressive Web App (PWA) implementation
- Mosque management system
- Ustadz profile management
- Push notifications
- And more!

## 👨‍💻 Author

**Akbar Abustang**
- GitHub: [@akbarabustang](https://github.com/akbarabustang)
- Repository: [jadwal-taklim](https://github.com/akbarabustang/jadwal-taklim)

### ⭐ Show Your Support

If this project helped you, please give it a ⭐️! It motivates me to continue improving and maintaining this project.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

<div align="center">

**Made with ❤️ by Akbar Abustang**

[![GitHub stars](https://img.shields.io/github/stars/akbarabustang/jadwal-taklim?style=social)](https://github.com/akbarabustang/jadwal-taklim/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/akbarabustang/jadwal-taklim?style=social)](https://github.com/akbarabustang/jadwal-taklim/network/members)

</div>
