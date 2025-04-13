# 📚 Auto Seat Reservation for Imam Khomeini Library (Mashhad)

This project is built to **automatically reserve a seat** at the **Imam Khomeini Library in Mashhad** every day.

It uses **Laravel Dusk** to open a browser, log in to the library system, and complete the reservation — all automatically.

> ⚠️ **Currently, the bot does not work due to security and privacy reasons**.  
> The bot requires the library's username and password, which cannot be shared here for privacy and security purposes. Once the credentials are provided, it will work as intended, making daily reservations automatically.


---

## 🛠️ Built With

- **Laravel** – main framework
- **Laravel Dusk** – for browser automation
- **Blade** – for the admin panel UI
- **Tailwind CSS** – for styling

---


## 💡 How It Works

1. Opens the library main page using headless browser
2. Click on login button 
3. Logs in using your username & password
4. Opens reservation page
5. Selects the day
6. Selects the seat and completes the reservation  
7. Can be scheduled to run automatically every day

---

## 🚀 Quick Setup

```bash
git clone https://github.com/yourusername/your-repo.git
cd your-repo
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan dusk(to run manualy)

