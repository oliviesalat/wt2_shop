## Online Shop (Pure PHP Demo)

This project is a simple training online shop built **in plain PHP without any frameworks**.  
The main idea is to show how you can build a small web application using a single front controller `public/index.php` as the **only entry point**, and then dispatch requests to action handlers and page scripts.

### Project goals

- **Plain PHP**: no Laravel/Symfony or other heavy frameworks, only standard PHP, Composer and a few libraries.
- **Single entry point**: all routing and request handling starts in `public/index.php`.
- **Simple architecture** with a minimal set of layers:
  - `public/` — public directory with `index.php` and generated order PDFs;
  - `app/pages/` — page scripts (views + a bit of logic);
  - `app/actions/` — action handlers for forms and user actions (login, registration, cart, orders, admin, etc.);
  - `app/templates/` — shared layout pieces (header/footer);
  - `config/` — database configuration and the `Database` class;
  - `app/bootstrap.php` — application bootstrap (session, Composer autoload, `.env` loading, etc.).

### Main endpoints

All requests go through `public/index.php`, which:

- checks `$_GET['action']` for form/actions;
- uses `$_SERVER['REQUEST_URI']` to decide which page to include.

**GET routes (pages):**

- **`/`**  
  Home page (`app/pages/home.php`). Simple welcome screen with a link to products.

- **`/products`**  
  Products listing (`app/pages/products.php`).  
  - Supports pagination with `?page=N` (0-based).
  - Shows products with name, description, price and category.

- **`/product?product_id={id}`**  
  Product details page (`app/pages/product.php`).  
  - Displays single product info.  
  - If the user is logged in, shows an **Add to Cart** form posting to `/?action=add_to_cart`.

- **`/cart`**  
  Cart page (`app/pages/cart.php`).  
  - Shows current cart items for the logged-in user.  
  - Allows changing quantity via `/?action=edit_quantity`.  
  - Allows removing an item via `/?action=remove_from_cart`.  
  - Contains a form to place an order via `/?action=place_order`.

- **`/auth_page`**  
  Login page (`app/pages/auth.php`).  
  - Shows login form posting to `/?action=auth`.  
  - If already logged in, redirects to `/profile`.

- **`/registration_page`**  
  Registration page (`app/pages/registration.php`).  
  - Displays a registration form that is processed by `/?action=register`.

- **`/profile`**  
  Simple profile page (`app/pages/profile.php`).  
  - Requires the user to be logged in.  
  - Greets the user by email and offers a logout link `/?action=logout`.

- **`/orders_page`**  
  Orders listing for the current user (`app/pages/orders_page.php`).  
  - Shows user orders with creation date and total price.  
  - For each order, if a PDF invoice exists, provides a link to download it from `/orders/{filename}.pdf`.

- **`/admin_panel`**  
  Admin page (`app/pages/admin_panel.php`).  
  - Contains a form to create new products (handled by `/?action=add_product`).  
  - Access control is based on `$_SESSION['role_id']`.

- **`/order_success`**  
  Order success page (`app/pages/order_success.php`).  
  - Shown after a successful order placement.  
  - If a generated PDF invoice exists, shows a download button.

**Action endpoints (`/?action=...`):**

These are POST-style actions routed by `public/index.php` to `app/actions/*.php`.

- **`/?action=auth`** → `app/actions/auth.php`  
  Handles user login:
  - Fetches the user from DB by email.
  - Verifies password with `password_verify`.  
  - Sets `$_SESSION['is_logged']`, `$_SESSION['user_id']`, `$_SESSION['email']`, `$_SESSION['role_id']`.  
  - Redirects to `/profile` or back to `/auth_page` with an error.

- **`/?action=register`** → `app/actions/register.php`  
  Handles registration:
  - Inserts new user with `password_hash(...)`.  
  - Renders a simple "you have successfully registered" message and a link back to the login page.

- **`/?action=logout`** → `app/actions/logout.php`  
  Clears session login state and redirects to `/`.

- **`/?action=add_to_cart`** → `app/actions/cart_action.php` (uses `Cart` class)  
  Adds a product to the current user's cart with a given quantity.  
  - Enforces a maximum of 5 different items per cart.  
  - On success redirects to `/cart`, on limit error redirects back to the product page with an error message.

- **`/?action=remove_from_cart`** → `app/actions/cart_action.php`  
  Removes an item from the cart for the current user and redirects back to `/cart`.

- **`/?action=edit_quantity`** → `app/actions/cart_action.php`  
  Updates quantity for a cart item and redirects back to `/cart`.

- **`/?action=place_order`** → `app/actions/place_order.php`  
  Places an order for the current user's cart:
  - Wraps DB operations in a transaction.  
  - Inserts a row into `orders` and corresponding rows into `order_items`.  
  - Clears the cart via `Cart::delete_cart`.  
  - Generates a PDF invoice using `FPDF` and stores it in `public/orders/`.  
  - Saves the file name in `$_SESSION['order_pdf']` and redirects to `/order_success`.

- **`/?action=add_product`** → `app/actions/add_product.php`  
  Adds a new product to the database (used from `/admin_panel`).

### Database access

- The `Database` class in `config/Database.php` is a small wrapper around `mysqli` that provides:
  - `db_connect()` — lazy connection using credentials from `.env`;
  - `db_fetch_all()` — fetch multiple rows as an array of associative arrays;
  - `db_fetch_single()` — fetch a single row as an associative array;
  - `insert()` — helper for `INSERT` queries returning affected rows.
- Connection settings are read from `.env` (see `.env.example`).

### Users, products, cart and orders

- **Users & auth**: basic registration and login with hashed passwords and session-based auth.
- **Products & categories**: stored in `products` and `categories` tables (see `shop.sql`) and displayed via `/products` and `/product`.
- **Cart**:
  - Encapsulated in the `Cart` class (`app/actions/Cart.php`).
  - Lets users add items, change quantities and remove items.
- **Orders & invoices**:
  - Orders are stored in `orders` and `order_items`.  
  - A PDF invoice is generated for each order and can be downloaded later from `/orders_page` or `/order_success`.

### Requirements

- PHP 8.1+ (recommended)
- MySQL / MariaDB
- Composer

### Installation & running

1. **Clone the repository**:

```bash
git clone <your-repo-url> onlineshop
cd onlineshop
```

2. **Install dependencies with Composer**:

```bash
composer install
```

3. **Configure environment**:

- Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

- Set database connection variables:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USER=root
DB_PASS=
DB_NAME=shop
```

4. **Create database schema**:

- Create the database `shop` (or the name you set in `.env`).
- Import `shop.sql` into that database (via phpMyAdmin, Adminer or `mysql` CLI).

5. **Run the built-in PHP server** (for development):

```bash
php -S localhost:8000 -t public
```

Then open `http://localhost:8000/` in your browser.

### Architecture idea

- The web server (or `php -S`) points to `public/` as the document root.
- All requests hit `public/index.php`, which:
  - includes `app/bootstrap.php` (session, autoload, `.env`, DB);
  - inspects `$_GET['action']` for action handlers;
  - uses the request path to include the appropriate script from `app/pages/`.

This keeps the application centered around **a single entry point**, while all routing and logic are implemented manually in plain PHP without a full-stack framework.



