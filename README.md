# Ngọc Rồng Online (NRO) — Community Web Portal & Card Billing Gateway (Gốc)

[![PHP](https://img.shields.io/badge/PHP-7.4%2B%20%2F%208.x-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![AJAX](https://img.shields.io/badge/Frontend-AJAX%20%2F%20jQuery-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![CSS3](https://img.shields.io/badge/Styles-CSS3%20Sprites-1572B6?logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)

> A lightweight, responsive web portal, automated scratch card billing gateway, and community engagement hub for **Ngọc Rồng Online (Dragon Boy)** private game servers.

---

## 1. System Architecture

```mermaid
flowchart TD
    subgraph Client["Player Browser"]
        Home["Homepage & Game Info (index.php)"]
        Recharge["Card & ATM Recharge (napthe.php, napatm.php)"]
        Exchange["Gold Bar Exchange (doi_thoi_vang.php)"]
        GiftCode["GiftCode & Events (giftcode_mtv.php)"]
        Leaderboard["Live Rankings (bxh.php)"]
    end

    subgraph SecurityLayer["Security & Validation"]
        IpFilter["Anti-Clone Multi-Account Filter (checkIPclone.php)"]
        ProfanityFilter["Chat & Name Profanity Check (profanity.txt)"]
    end

    subgraph WebCore["Portal Processing (PHP Core)"]
        Config["Configuration & DB Connection (config.php, set.php)"]
        AjaxHandler["Asynchronous Request Handler (ajax/)"]
        CallbackEngine["Payment Callback & Webhook Verification (callback.php)"]
    end

    subgraph ThirdParty["External Services"]
        BillingGateway["Card Charging Telco Partner (API Callback)"]
    end

    subgraph Database["Database Tier (MySQL)"]
        GameDb[("Game Accounts & Transaction Logs")]
    end

    Client --> SecurityLayer
    SecurityLayer --> WebCore
    Recharge -->|Submit Card Serial/Pin| BillingGateway
    BillingGateway -->|Webhook POST| CallbackEngine
    CallbackEngine --> GameDb
    WebCore --> GameDb
    Leaderboard --> GameDb
    Exchange --> GameDb
    GiftCode --> GameDb
```

---

## 2. Key Modules & Features

* **Automated Card & ATM Billing**:
  * Seamless scratch card redemption (`napthe.php`) with asynchronous verification via external telco API webhooks (`callback.php`).
  * In-game currency (`Vàng`, `Ngọc`) instantly credited to player game accounts with comprehensive transaction logging (`lich-su-nap.php`).
* **Gold Bar Conversion System (`doi_thoi_vang.php`)**:
  * Exchange in-game currency into tradeable gold bars with transaction validation (`goldbar_callback.php`).
* **Giftcode & Event Management**:
  * Real-time giftcode redemption system (`giftcode_mtv.php`, `danhsach_gift.php`).
  * Social share event tracking (`su_kien_share.php`) rewarding players for viral promotions.
* **Security & Anti-Abuse**:
  * IP cloning detection (`checkIPclone.php`) limiting automated multi-account farming.
  * Keyword profanity filtering (`profanity.txt`) to protect community discussions.
* **Sprite & Game Asset Showcase**:
  * Embedded animation sprites (`animation/`), item icons (`item/`), and character previews extracted directly from game assets.

---

## 3. Tech Stack

| Domain | Technology |
| :--- | :--- |
| **Backend** | PHP 7.4+ / 8.x |
| **Database** | MySQL / MariaDB (PDO / MySQLi) |
| **Frontend** | HTML5, CSS3, JavaScript, jQuery / AJAX |
| **Web Server** | Apache (URL rewriting via `.htaccess`) |

---

## 4. Getting Started

### Prerequisites
- PHP 7.4+ with `curl`, `pdo_mysql`, `json` extensions
- MySQL 5.7+ / MariaDB 10.4+
- Web server (Apache, Nginx, or XAMPP)

### Setup Instructions
1. Clone the repository into your web directory:
   ```bash
   git clone https://github.com/btoan2802/web_nro_goc.git
   ```
2. Copy the sample configuration:
   ```bash
   cp cauhinh.example.php config.php
   ```
3. Edit `config.php` and configure:
   - MySQL host, database name, user, and password.
   - Telco charging partner API ID and Secret Key.
4. Access the web portal at `http://localhost/web_nro_goc`.

---

## 5. Author & License

- **Author**: Nguyễn Bảo Toàn ([@btoan2802](https://github.com/btoan2802))
- **License**: Educational / Proprietary
