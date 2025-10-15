# Jadwal Taklim

Platform untuk menemukan jadwal kajian dan taklim di masjid-masjid sekitar Anda.

## 🎯 Features

### Phase 1: Public Frontend (Current)
- **Homepage**: Menampilkan upcoming jadwal taklim dengan informasi lengkap (nama ustadz, jadwal, lokasi masjid, judul kajian, dll)
- **Jadwal Lengkap**: Halaman tabel yang menampilkan semua jadwal taklim dengan fitur:
  - Filter berdasarkan kategori kajian (Tafsir, Hadits, Fiqih, Akhlaq, dll)
  - Filter berdasarkan kota
  - Pencarian berdasarkan judul, nama ustadz, atau nama masjid
  - Pagination untuk navigasi yang mudah
- **SEO Optimized**: Meta tags, Open Graph, dan Twitter Cards untuk share yang lebih baik
- **Responsive Design**: Tampilan optimal di desktop, tablet, dan mobile

### Phase 2: Admin Panel (Completed)
- **Authentication System**: Login/Logout dengan Laravel Breeze
- **Admin Dashboard**: Statistics dan overview data
- **Schedule Management**: Full CRUD operations untuk jadwal taklim
  - Create: Tambah jadwal baru dengan form lengkap
  - Read: Tabel jadwal dengan search dan filter
  - Update: Edit jadwal yang sudah ada
  - Delete: Hapus jadwal dengan confirmation
- **Admin Middleware**: Route protection untuk keamanan
- **Flash Messages**: Success/error notifications
- **Responsive Admin UI**: Green-themed admin interface

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

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
