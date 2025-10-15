# Jadwal Taklim - Project Context

## 📖 Project Overview

**Jadwal Taklim** is a web application designed to help Muslims find and access schedules for Islamic study sessions (taklim/kajian) at mosques across Indonesia. The platform provides an easy-to-use interface for browsing upcoming Islamic lectures and classes.

## 🎯 Project Goals

1. **Centralized Schedule Information**: Provide a single platform where users can find various Islamic study schedules from different mosques
2. **Easy Discovery**: Help users discover kajian based on category, location, and schedule
3. **Community Building**: Connect people with Islamic knowledge and strengthen community bonds

## 📋 Development Phases

### Phase 1: Public Frontend ✅ (Current - COMPLETED)

**Features Implemented:**
- Homepage displaying upcoming taklim schedules (limited to 6 most recent)
- Full schedule page with advanced filtering:
  - Search by title, ustadz name, or mosque name
  - Filter by category (Tafsir, Hadits, Fiqih, Akhlaq, etc.)
  - Filter by city
  - Pagination for easy navigation
- Responsive design for mobile, tablet, and desktop
- SEO optimization with meta tags and Open Graph support
- Server-side rendering capability with Inertia.js

**Key Components:**
- `HomeController.php` - Handles homepage logic and data fetching
- `ScheduleController.php` - Manages schedule listing with filters
- `Home.vue` - Homepage component with card-based layout
- `Schedule/Index.vue` - Full schedule table with filters
- `AppLayout.vue` - Main layout with navigation and footer

### Phase 2: Admin Panel ✅ (COMPLETED)

**Implemented Features:**

1. **Authentication & Authorization**
   - ✅ Admin login/logout with Laravel Breeze
   - ✅ Admin middleware for route protection
   - ✅ Role-based access control (is_admin flag)
   - ✅ Password reset functionality (Breeze default)
   - ✅ Default admin seeder (admin@jadwaltaklim.com / password)

2. **Schedule Management (CRUD)**
   - ✅ Create new taklim schedules with comprehensive form
   - ✅ Edit existing schedules
   - ✅ Delete schedules with confirmation dialog
   - ✅ Activate/deactivate schedules (is_active toggle)
   - ✅ Full form validation with error messages
   - ✅ Search functionality (title, ustadz, mosque)
   - ✅ Status filter (active/inactive)
   - ✅ Pagination for schedule list

3. **Admin Dashboard**
   - ✅ Statistics cards (total, active, upcoming schedules, categories)
   - ✅ Recent schedules list
   - ✅ Category statistics with progress bars
   - ✅ Quick actions for schedule management
   - ✅ Responsive green-themed admin UI

4. **Admin Layout & Navigation**
   - ✅ Dedicated admin layout component
   - ✅ Navigation menu with active state indicators
   - ✅ User dropdown with profile and logout
   - ✅ Flash messages for success/error feedback
   - ✅ Link to view public website

5. **Loading & UX Enhancements**
   - ✅ Modern loading indicator with blur overlay
   - ✅ Page transition animations
   - ✅ Smooth scrolling
   - ✅ Smart loading delay (only shows after 250ms)

**Key Admin Components:**
- `AdminMiddleware.php` - Protects admin routes
- `Admin/DashboardController.php` - Dashboard logic and statistics
- `Admin/ScheduleController.php` - CRUD operations
- `AdminLayout.vue` - Admin layout with navigation
- `Admin/Dashboard.vue` - Dashboard page
- `Admin/Schedules/Index.vue` - Schedule management list
- `Admin/Schedules/Create.vue` - Create schedule form
- `Admin/Schedules/Edit.vue` - Edit schedule form
- `LoadingIndicator.vue` - Modern loading component

### Phase 3: Future Enhancements 🔮 (Planned)

**Proposed Features:**

1. **Mosque Management**
   - Register new mosques
   - Edit mosque information
   - Mosque verification system
   - Associate schedules with mosques

2. **Ustadz/Speaker Management**
   - Add ustadz profiles
   - Edit ustadz information
   - Link ustadz to schedules
   - Track ustadz schedules

3. **Category Management**
   - Add/edit kajian categories
   - Assign icons/colors to categories

4. **User Management**
   - Multi-admin user management
   - Activity logs
   - Permission management

5. **Notifications**
   - Email notifications for new schedules
   - Schedule reminder system
   - Admin notifications for pending approvals

6. **Content Management**
   - Manage static pages (About, Contact, etc.)
   - FAQ management
   - Announcement banners

7. **Import/Export**
   - CSV/Excel import for bulk schedule creation
   - Export schedule data
   - Backup functionality

## 🏗 Architecture

### Technology Stack

**Backend:**
- Laravel 12 (PHP 8.2+)
- MySQL/SQLite database
- Eloquent ORM for database interactions

**Frontend:**
- Inertia.js for SPA-like experience with server-side routing
- Vue 3 (Composition API)
- Tailwind CSS for styling
- Vite for asset bundling

**Key Design Decisions:**
- **Monolithic Architecture**: Single Laravel application serving both frontend and backend
- **Inertia.js**: Chosen for seamless integration between Laravel and Vue without building a separate API
- **Server-Side Rendering**: SEO-friendly with Inertia.js SSR support
- **Component-Based Frontend**: Reusable Vue components for maintainability

### Database Schema

**Main Tables:**

1. **taklim_schedules**
   - Core table storing all schedule information
   - Includes schedule details, location, timing, and metadata
   - Fields: id, title, description, ustad_name, mosque_name, mosque_address, mosque_city, schedule_date, start_time, end_time, frequency, category, is_active, contact_person, contact_number, timestamps

2. **users** (Laravel default)
   - Used for admin authentication in Phase 2

**Future Tables (Phase 2):**
- mosques (separate mosque management)
- ustadz/speakers (dedicated ustadz profiles)
- categories (dynamic category management)
- activity_logs (admin action tracking)

### Key Models & Scopes

**TaklimSchedule Model:**
- `scopeUpcoming()` - Fetch future active schedules ordered by date
- `scopeActive()` - Fetch only active schedules
- Accessors: `formatted_date`, `time_range`

## 🎨 Design System

### Color Palette

**Primary Colors:**
- Orange (#f97316): Warm, inviting, used for primary actions and highlights
- Green (#059669): Islamic theme, peaceful, used for secondary elements
- White (#FFFFFF): Clean backgrounds

**Usage Guidelines:**
- Primary orange for CTAs, links, and important UI elements
- Secondary green for success states, secondary actions
- Gradient combinations for hero sections and feature highlights

### Typography
- Default: System font stack with Figtree as primary font
- Headings: Bold weights for clear hierarchy
- Body: Regular weight for readability

### Component Patterns
- Card-based layouts for schedule items
- Table view for detailed schedule listing
- Filters with real-time search debouncing
- Responsive navigation with mobile menu

## 🔒 Security Considerations

### Current (Phase 1):
- No authentication required for public pages
- XSS protection via Vue's automatic escaping
- CSRF protection on forms (Laravel default)

### Future (Phase 2):
- Role-based access control (RBAC)
- Input validation and sanitization
- Rate limiting on API endpoints
- Secure password storage with bcrypt
- Activity logging for audit trails

## 🚀 Deployment Considerations

### Server Requirements:
- PHP 8.2 or higher
- MySQL 8.0+ or SQLite
- Node.js 20.x for asset compilation
- Composer for dependency management

### Environment Variables:
- `APP_NAME`: Application name
- `APP_ENV`: Environment (local, production)
- `APP_URL`: Application URL
- `DB_*`: Database configuration
- `VITE_*`: Frontend configuration

### Production Checklist:
- [ ] Enable caching (config, routes, views)
- [ ] Set `APP_DEBUG=false`
- [ ] Configure proper database credentials
- [ ] Set up SSL/HTTPS
- [ ] Configure mail driver for notifications (Phase 2)
- [ ] Set up backup strategy
- [ ] Configure queue driver for async jobs (Phase 2)

## 📊 Performance Optimization

### Database:
- Indexed columns: schedule_date, is_active, category, mosque_city
- Eager loading relationships to avoid N+1 queries
- Query result caching for frequently accessed data

### Frontend:
- Lazy loading for route components
- Image optimization
- CSS/JS minification in production
- Debounced search inputs

### Future Enhancements:
- Redis cache for schedule data
- Queue jobs for heavy operations
- CDN for static assets

## 🧪 Testing Strategy (Future)

### Unit Tests:
- Model methods and scopes
- Form validation rules
- Helper functions

### Feature Tests:
- Schedule CRUD operations
- Filter and search functionality
- Authentication and authorization

### Browser Tests:
- User flows (browsing, filtering, searching)
- Responsive design testing
- Cross-browser compatibility

## 📝 Code Standards

### Laravel/PHP:
- Follow PSR-12 coding standards
- Use type hints for parameters and return types
- Meaningful variable and method names
- Comments for complex logic

### Vue/JavaScript:
- Composition API for new components
- Props validation with types
- Composables for reusable logic
- Clear component naming conventions

### Git Workflow:
- Feature branches for new development
- Descriptive commit messages
- Pull requests for code review (if team)

## 🔄 Future Enhancements

### Public Features:
- User accounts for saved favorites
- Schedule reminders/notifications
- Share schedules on social media
- Print-friendly schedule views
- Calendar integration (Google Calendar, iCal)
- Maps integration for mosque locations
- Mobile app (PWA)

### Admin Features:
- Schedule approval workflow
- Recurring schedule templates
- Multi-language support
- Advanced analytics and reporting
- Email campaigns for schedules
- API for third-party integrations

## 📞 Support & Maintenance

### Version Control:
- Git repository with clear branching strategy
- Regular commits with meaningful messages

### Documentation:
- Keep README.md updated
- Document new features and changes
- API documentation (for Phase 2)

### Monitoring (Production):
- Error logging (Laravel Log)
- Performance monitoring
- Uptime monitoring
- Database backup automation

---

**Last Updated**: October 15, 2025  
**Current Phase**: Phase 2 (Admin Panel) - COMPLETED  
**Next Milestone**: Phase 3 (Future Enhancements)

## 🔑 Quick Start for Admins

**Default Admin Login:**
- URL: `http://localhost:8000/login`
- Email: `admin@jadwaltaklim.com`
- Password: `password`

⚠️ **Security Note**: Change default credentials in production!
