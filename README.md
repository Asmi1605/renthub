# RentHub – Laravel-Based Multi-Item Rental Platform

**RentHub** is a full-stack Laravel application designed for renting various items like cars, cameras, electronics, and more. Whether you're a vendor renting out items or a customer looking to book them, RentHub provides a smooth and intuitive platform.

## 🌟 Key Features
- 🧍 User authentication & profile management  
- 🧾 Vendor dashboard to list rentable items  
- 📦 Categorized listings (cars, cameras, electronics, etc.)  
- 🗓️ Booking system with availability tracking  
- 💬 Contact and messaging system (optional add-on)  
- 💳 Payment gateway integration (in progress/optional)  
- 🔐 Admin panel for managing users and items  
- 🎯 Built with Laravel, Vite, Bootstrap, and MySQL

## 🔧 Tech Stack
- **Backend**: Laravel  
- **Frontend**: Blade, Bootstrap, Vite  
- **Database**: MySQL  
- **Tooling**: XAMPP, Composer, npm

## ⚙️ Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/YourUsername/renthub.git
Navigate to the project folder:

bash
cd renthub
Install dependencies:

bash
composer install
Copy the example environment file:

bash
cp .env.example .env
Generate the application key:

bash
php artisan key:generate
Set up the database (make sure MySQL is running and the database is created):

bash
php artisan migrate --seed
Install frontend dependencies and run the development server:

bash
npm install && npm run dev
Serve the application:

bash
php artisan serve
🔐 Make sure your MySQL has a database named renthub_db and update the .env file with your database credentials.

🎓 Ideal For:
Final year B.Tech projects

Laravel practice for MERN/Full Stack devs

Startups offering item rental services

📝 Contributing
Feel free to fork the repo, create issues, and submit pull requests. Contributions are always welcome!

