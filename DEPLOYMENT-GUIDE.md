# 🚀 Sakura Server Deployment Guide

## Files to Upload to Sakura Server

### Required Files:
```
📁 Your Sakura Server Root Directory
├── index.html (main portfolio)
├── contact-handler.php (PHP email handler)
├── 📁 assets/
│   ├── 📁 css/
│   ├── 📁 js/
│   └── 📁 img/
├── english-page.html
├── works01.html → works08.html
└── manifest.webmanifest
```

### Optional Testing Files:
- `test-form.php` (for testing on live server)
- `test-contact.html` (HTML test form)

## Step-by-Step Deployment

### 1. Access Your Sakura Server
- Login to Sakura server control panel
- Access file manager or use FTP/SFTP

### 2. Upload Files
- Upload all files from `public/` folder to your domain root
- Maintain folder structure exactly as shown above

### 3. Configure Email Settings
Edit `contact-handler.php` line 32:
```php
$to = "your-actual-email@domain.com"; // Change this!
```

### 4. Test on Live Server
1. Visit your domain: `https://yourdomain.com`
2. Test contact form submission
3. Check if emails are received

### 5. Troubleshooting
If emails don't work:
- Check Sakura server email settings
- Verify PHP mail() function is enabled
- Check spam/junk folder

## Email Configuration Notes

### Basic Setup (Current):
Uses PHP `mail()` function - works on most shared hosting

### Advanced Setup (Optional):
For better email delivery, consider:
- SMTP configuration
- Email service integration (SendGrid, etc.)

## Security Checklist
- ✅ Form validation implemented
- ✅ Input sanitization added
- ✅ No sensitive data in code
- ⚠️ Consider adding CAPTCHA for production

## WordPress Alternative
If you want WordPress instead:
1. Install WordPress on Sakura server
2. Convert HTML theme to WordPress theme
3. Use Contact Form 7 plugin

---
**Ready to deploy? Follow steps 1-4 above!** 🚀