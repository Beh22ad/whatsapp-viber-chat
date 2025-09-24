# WordPress Messenger Buttons

This code snippet adds WhatsApp and Viber messenger buttons to the bottom right corner of your WordPress website. The buttons are displayed on top of each other and work on both desktop and mobile devices. When clicked, they open the respective messenger app in a new tab, allowing visitors to contact you directly.

## Features

- Fixed position buttons in the bottom right corner
- Responsive design that works on all devices
- Clean, modern appearance with hover effects
- Messenger name tooltip appears on hover
- Opens messengers in new tabs
- No external dependencies
- Inline SVG icons

## Installation

### Option 1: Using a Child Theme

1. Copy the entire code from `messenger-buttons.php`
2. Navigate to Appearance > Theme Editor in your WordPress dashboard
3. Select your child theme's `functions.php` file
4. **Important**: Remove the opening `<?php` tag from the top of the code before pasting
5. Paste the code at the end of the file
6. Save changes

### Option 2: Using Code Snippets Plugin

1. Install and activate the [Code Snippets](https://wordpress.org/plugins/code-snippets/) plugin
2. Navigate to Snippets > Add New
3. Give your snippet a title (e.g., "Messenger Buttons")
4. Copy the entire code from `messenger-buttons.php`
5. **Important**: Remove the opening `<?php` tag from the top of the code before pasting
6. Paste the remaining code into the snippet editor
7. Save and Activate the snippet

## Configuration

To set up your phone numbers:

Locate these lines near the top:
   ```php
   $whatsapp_number = '1234567890'; // Example: +18006927753
   $viber_number = '1234567890';    // Example:  18006927753