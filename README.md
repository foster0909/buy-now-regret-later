# 💣 Buy Now Regret Later – Vulnerable WebApp Lab

This is a custom (and poorly) built vulnerable PHP + MySQL application designed to practice Web application security, testing and exploitation.
---
## 🧠 Features & Vulnerabilities

- 🔐 **Authentication & Sessions**
  - Weak session management
  - Cookie-based manipulation
  - Role-based access bypass

- 🛒 **Cart & Purchase System**
  - Hidden fields for price manipulation
  - Insufficient authorization on purchase
  - Logic flaws in calculations

- 🧨 **Stored XSS & DOM XSS**
  - Inject JavaScript via product reviews
  - Trigger external beacon requests

- 🕵️ **SQL Injection (Blind & Error-Based)**
  - Blind SQLi on login and review endpoints
  - Extract admin hashes with timing attacks

- 🪝 **Broken Access Control**
  - Edit/delete reviews of other users
  - View cart of a user named Mike
  - Change email of other users

- 🕹️ **Flags & Challenges**
  - Trigger flags by purchasing “suspicious items”
  - Hidden cookies / header manipulation
  - Explore `admin_dashboard.php` to find the final flag

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
4. 

This project is intentionally vulnerable and should be used for educational purposes only. DO NOT deploy it on public servers.
Feel free to use, modify and throw it around the internet.

---
Made with ❤️ by PJ
