# Blog Theme - Unified Design Documentation

## Overview

Your blog now has a **unified, modern theme** with consistent styling across all pages including:

- Blog homepage and article pages
- Authentication pages (login/register)
- Portfolio pages
- Pricing pages
- All other blog pages

## Color Scheme

### Primary Colors

```
Primary Blue:        #0d6efd
Primary Dark:        #0b5ed7
Primary Darker:      #0a58ca
```

### Secondary Colors

```
Secondary Gray:      #6c757d
Accent Purple:       #667eea
Dark Background:     #212529
```

### Status Colors

```
Success (Green):     #198754
Warning (Yellow):    #ffc107
Danger (Red):        #dc3545
Info (Cyan):         #0dcaf0
```

## Key Features

### 1. **Gradient Effects**

- Navigation bars use blue gradients
- Buttons feature smooth gradient backgrounds
- Footer has dark gradient styling
- Smooth transitions on hover

### 2. **Consistent Typography**

- All headings use the same font family
- Proper font weights for hierarchy (700 for headings, 600 for labels)
- Responsive font sizes across all devices

### 3. **Button Styles**

All buttons now follow the same design pattern:

```html
<!-- Primary Button (Blue Gradient) -->
<button class="btn btn-primary">Click Me</button>

<!-- Secondary Button (Gray) -->
<button class="btn btn-secondary">Secondary</button>

<!-- Link Button -->
<a href="#" class="btn btn-link">Link Button</a>
```

### 4. **Card Components**

Cards feature:

- Clean borders with subtle shadows
- Smooth hover animations
- Gradient headers with white text
- Consistent padding and spacing

```html
<div class="card">
    <div class="card-header">Card Title</div>
    <div class="card-body">
        <p>Card content goes here</p>
    </div>
</div>
```

### 5. **Alert/Notification Styles**

```html
<!-- Success Alert -->
<div class="alert alert-success">Success message</div>

<!-- Danger Alert -->
<div class="alert alert-danger">Error message</div>

<!-- Info Alert -->
<div class="alert alert-info">Information message</div>

<!-- Warning Alert -->
<div class="alert alert-warning">Warning message</div>
```

### 6. **Form Elements**

All form controls have:

- Rounded corners (8px)
- Subtle borders and shadows
- Blue focus states
- Consistent padding

```html
<form>
    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" />
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

## CSS Files Structure

### Public CSS Files (Served to Browser)

```
public/css/
├── styles.css           # Bootstrap base + overrides (10,848 lines)
├── theme-custom.css     # Unified theme variables & custom styles
└── auth.css             # Authentication page styles (unified theme)
```

### Resources Files (Laravel Source)

```
resources/css/
├── app.css              # Custom theme variables for Blade templates
├── styles.css           # (generated from build process)
└── app.js               # JavaScript entry point
```

## Applying the Theme

### For Blade Templates

The theme is automatically applied via the layout file:

```blade
@extends('layouts.app')
@section('content')
<section class="py-5">
    <h1 class="text-primary">Welcome</h1>
    <button class="btn btn-primary">Click Me</button>
</section>
@endsection
```

### For Static HTML Pages

Make sure these CSS files are linked:

```html
<link href="css/styles.css" rel="stylesheet" />
<link href="css/theme-custom.css" rel="stylesheet" />
```

## CSS Custom Properties (Variables)

All theme colors are defined as CSS variables for easy customization:

```css
:root {
    --primary-color: #0d6efd;
    --primary-dark: #0b5ed7;
    --primary-darker: #0a58ca;
    --secondary-color: #6c757d;
    --accent-color: #667eea;
    --dark-bg: #212529;
    --light-bg: #f8f9fa;
    --text-dark: #212529;
    --text-light: #6c757d;
    --border-radius: 0.5rem;
    --transition-speed: 0.3s;
}
```

To override, simply redefine in your own CSS file loaded **after** theme-custom.css.

## Common Patterns

### Hero Section

```html
<section class="hero-section">
    <h1>Your Hero Title</h1>
    <p>Hero subtitle text</p>
</section>
```

### Navigation

Uses Bootstrap navbar with unified theme:

```html
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Brand</a>
    </div>
</nav>
```

### Card Grid

```html
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Title</div>
            <div class="card-body">Content</div>
        </div>
    </div>
</div>
```

## Responsive Design

The theme is fully responsive with breakpoints:

- **Mobile**: < 576px
- **Tablet**: 576px - 768px
- **Desktop**: 768px - 992px
- **Large**: 992px - 1200px
- **XL**: > 1200px

Font sizes and spacing automatically adjust for smaller screens.

## Hover Effects

### Cards

```css
.card:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    transform: translateY(-4px);
}
```

### Buttons

```css
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
}
```

### Links

```css
a:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}
```

## Customization Guide

### To Change Primary Color:

1. Update the CSS variable in theme-custom.css:

```css
:root {
    --primary-color: #yourhexcolor;
    --primary-dark: #yourdarkcolor;
    --primary-darker: #yourdarkestcolor;
}
```

2. All components using `--primary-color` will automatically update

### To Add Custom Styles:

Create a new CSS file after the theme files:

```html
<link href="css/styles.css" rel="stylesheet" />
<link href="css/theme-custom.css" rel="stylesheet" />
<link href="css/your-custom.css" rel="stylesheet" />
<!-- Your overrides -->
```

## Browser Support

The theme is compatible with:

- Chrome/Edge (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance Notes

- Theme uses CSS variables for dynamic theming
- Minimal JavaScript dependencies
- Bootstrap is used as the base framework
- All animations use CSS transforms for smooth 60fps performance
- Gradients are GPU-accelerated

## Troubleshooting

### Colors not applying?

- Ensure theme-custom.css is loaded AFTER styles.css
- Check browser cache (Ctrl+Shift+Delete or Cmd+Shift+Delete)
- Verify CSS classes are spelled correctly

### Styles look different on mobile?

- The responsive design handles this automatically
- Check viewport meta tag is present:
    ```html
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    ```

### Custom colors not working?

- Make sure you're using CSS variables from the :root
- Or override specific classes directly

## Files Modified/Created

1. ✅ Created: `/public/css/theme-custom.css` - Main unified theme
2. ✅ Updated: `/public/css/auth.css` - Auth page styles (unified)
3. ✅ Updated: `/resources/css/app.css` - Custom variables for Blade
4. ✅ Updated: `/resources/views/layouts/app.blade.php` - Added theme CSS link

## Next Steps

1. Review your pages in a browser
2. Test responsive design on mobile devices
3. Customize colors if needed (see Customization Guide)
4. Add any additional page-specific overrides in separate CSS files

---

**Theme Version**: 1.0  
**Last Updated**: March 2026  
**Status**: Live & Ready to Use
