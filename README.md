# 💣 Buy Now Regret Later – Vulnerable WebApp Lab

This is a custom (and poorly) built vulnerable PHP + MySQL application designed to practice Web application security, testing and exploitation.
---
## 🧩 Features
- 👤 **User Accounts**
  - Register and log in as a user
  - Edit profile, bio, and email
  - Reset password and OTP system

- 🛒 **Shopping System**
  - Add products to cart
  - View cart and subtotal
  - Purchase items using virtual balance

- ✍️ **Product Reviews**
  - Users can leave reviews on products
  - View all feedback for each item

- 🖼️ **Profile Pictures**
  - Upload and change profile images

- 🛠️ **Admin Panel**
  - Manage all products and users
  - View submitted reviews

- 📊 **Bank & Balance Tracking**
  - Virtual bank system
  - Track total items purchased

- 🌐 **REST-style API Endpoints**
  - JSON responses for product reviews
  - AJAX-based review submission and removal

---

---

## ⚙️ Setup (via Docker)

### 1. **Clone the Repository**
```bash
git clone https://github.com/your-username/buy-now-regret-later.git
cd buy-now-regret-later
```
### 2. **Build and Run with Docker**
```bash
docker compose build
docker compose up
```
### 3. **Access the App**
1. WebApp: http://localhost:8080/src/login.php (Poor development decisions I know)
2. phpMyAdmin: http://localhost:8081
   User: user
   Password: password
3. Import buy_now_db.sql to the database


This project is intentionally vulnerable and should be used for educational purposes only. DO NOT deploy it on public servers.
Feel free to use, modify and throw it around the internet.

---
Made with ❤️ by PJ
