# Prerequisites
- On Windows: Install WSL2 https://learn.microsoft.com/en-us/windows/wsl/install
- Docker Desktop
- PHP
- Composer

# Development

1. Clone Repository
```
https://github.com/f0reclone/wbh-lernplattform.git
```
2. Go to repository
```
cd wbh-lernplattform
```
3. Install dependencies
```
composer install
```
4. Start Container
```
// Via Sail
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
sail up -d

// Via docker-compose / same as sail
docker-compose up -d
```

If the container started successfully, you can reach it on http://localhost/
5. Add hosts
```
// Unix
sudo vi /etc/hosts

// Windows
open C:\Windows\System32\drivers\etc\hosts

// Add line
127.0.0.1 wbh.test
```

6. Install node modules
```
// Use npm
npm install

// Use pnpm (faster)
pnpm install
```

7. Run FE with hot reload
```
// Use npm
npm run dev

// Use pnpm (faster)
pnpm run dev
```

Your app is now available on http://wbh.test






