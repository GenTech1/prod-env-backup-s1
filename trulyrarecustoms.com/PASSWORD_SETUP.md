# Truly Rare Customs - Password Access Setup

## Environment Variable Setup

To set up password protection for the site, you need to set the `SITE_ACCESS_PASSWORD` environment variable.

### For Apache/.htaccess:
Add this to your .htaccess file or server configuration:
```
SetEnv SITE_ACCESS_PASSWORD "your_password_here"
```

### For Docker:
Add to your docker-compose.yml or Dockerfile:
```yaml
environment:
  - SITE_ACCESS_PASSWORD=your_password_here
```

### For Linux/bash:
```bash
export SITE_ACCESS_PASSWORD="your_password_here"
```

### For Windows:
```cmd
set SITE_ACCESS_PASSWORD=your_password_here
```

## How It Works

1. Visitors access `starter.php` first
2. They enter the password stored in the environment variable
3. Upon successful authentication, a session is created
4. They are redirected to the main site
5. All protected pages check for valid session

## Protecting Pages

Include this at the top of any page you want to protect:
```php
<?php include 'auth_check.php'; ?>
```

## Security Notes

- Change the default password to something secure
- Use HTTPS in production
- Consider implementing additional security measures like rate limiting
- Regularly rotate passwords