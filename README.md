# Multi-Tenant Inventory Management System

A production-ready **SaaS backend** built with Laravel 12, designed to serve multiple independent organizations with complete data isolation, role-based access control, and real-time stock monitoring.

---

## Features

- **Multi-Tenancy** — Complete data isolation between tenants via global scopes on all models
- **Authentication** — Token-based auth using Laravel Sanctum
- **Role-Based Access Control** — Three roles (Viewer, Operator, Warehouse Manager) powered by Spatie Laravel Permission
- **Product Management** — Create and list products with pricing and low-stock thresholds
- **Inventory Movement Tracking** — Record inbound/outbound stock movements with validation
- **Low Stock Notifications** — Queue-based job system that notifies warehouse managers automatically
- **RESTful API** — Clean, consistent JSON responses with proper HTTP status codes

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Language | PHP 8.2+ |
| Database | MySQL |
| Authentication | Laravel Sanctum |
| Authorization | Spatie Laravel Permission |
| Queue | Redis / Database |
| Build Tool | Vite |

---

## Database Structure

| Table | Purpose |
|---|---|
| `tenants` | Company/organization accounts |
| `users` | User accounts linked to a tenant |
| `products` | Product catalog per tenant |
| `inventory_movements` | Stock in/out transactions |
| `roles` / `permissions` | RBAC via Spatie |

**Key Relationships:**
- Tenant → Users (1:Many)
- Tenant → Products (1:Many)
- Product → Inventory Movements (1:Many)

---

## API Endpoints

### Authentication
| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/register` | Register new user |
| POST | `/api/login` | Login and receive token |

### Tenants
| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/tenants` | Create a new tenant |

### Products
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/products` | List products (paginated) |
| POST | `/api/products` | Create a product |
| GET | `/api/products/low-stock` | Get products below threshold |

### Inventory
| Method | Endpoint | Description |
|---|---|---|
| POST | `/api/products/{product}/movements` | Record stock movement (in/out) |

### Users
| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/users` | List users (paginated) |
| POST | `/api/users/{user}/assign-role` | Assign role to user |

---

## Design Patterns

- **Global Scopes** — Automatic tenant filtering on every query
- **Service Layer** — Business logic separated from controllers
- **Form Requests** — Centralized validation (RegisterRequest, StoreProductRequest, etc.)
- **API Resources** — Consistent response formatting (UserResource, ProductResource)
- **Job Queue** — Asynchronous low-stock notifications via `LowStockNotificationJob`
- **RBAC** — Role and permission management via Spatie package

---

## Roles & Permissions

| Role | Permissions |
|---|---|
| Viewer | View products |
| Operator | View products, manage inventory movements |
| Warehouse Manager | Full access — products, inventory, users |

---

## Installation

```bash
git clone https://github.com/mahmoud-aljabour/Multi-Tenant-Task
cd Multi-Tenant-Task
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## Author

**Mahmoud Maher Al Jbour**  
Backend Developer | Laravel & PHP Specialist  
[GitHub](https://github.com/mahmoud-aljabour) · [LinkedIn](https://linkedin.com/in/mahmoud-aljabour)
