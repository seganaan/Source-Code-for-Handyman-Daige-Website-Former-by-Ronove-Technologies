# Handyman Daige Website — Source Code (Former)

> **Status: FORMER website.** This is the source code of the previous Handyman Daige Properties website, designed and built by **Ronove Technologies**. The site was changed in **February 2026** and this version is no longer the live site. The code is kept here as an archive and reference.

---

## About

Handyman Daige Properties is a real-estate and property company. This repository holds the front-end source files that made up its company website: home page, locations, contact page, and the styles, scripts and media that supported them.

The website was originally built on **WordPress (PHP)**. The files in this repository are a **source files dump** of that site, i.e. the static, front-end side of it (HTML, CSS, JavaScript, images and vendor assets), rather than a full WordPress installation.

## Tech stack

| Layer | Technology |
|-------|-----------|
| CMS / platform | WordPress |
| Server-side language | PHP |
| Front end | HTML, CSS, JavaScript |
| Libraries | Third-party assets kept in `vendor/` |

## Repository structure

| Path | Contents |
|------|----------|
| `css/` | Stylesheets |
| `js/` | JavaScript files |
| `images/`, `im/`, `icons/` | Images, graphics and icon assets |
| `fantastic/` | Theme/plugin assets |
| `vendor/` | Third-party libraries |
| `wp-version/` | WordPress-related files |
| `isen.com.ng/` | Assets pulled from the `isen.com.ng` domain |
| `xfile/` | Additional site files |
| `Our-Locations.html` | "Our Locations" page |
| `contact-us.html` | "Contact Us" page |
| `.gitattributes` | Git configuration |

*(More pages and files continue further down the repository root.)*

## Running it locally

Because this is a static dump, you don't need PHP or WordPress to look at it:

1. Clone the repo:
   ```bash
   git clone https://github.com/seganaan/Source-Code-for-Handyman-Daige-Website-Former-by-Ronove-Technologies.git
   cd Source-Code-for-Handyman-Daige-Website-Former-by-Ronove-Technologies
   ```
2. Serve it with any static server, for example:
   ```bash
   python3 -m http.server 8000
   ```
3. Open `http://localhost:8000/` in your browser.

Some pages may look incomplete because dynamic WordPress and PHP features (forms, search, CMS content) are not included.

## Notes

- The original **WordPress database, `wp-config.php` and server-side PHP are not part of this repository.**
- Links, forms and embedded resources may still point to the old domain or to services that no longer exist.
- Branding, text and images belong to **Handyman Daige**. Please don't reuse them without permission.

## Credits

Designed and developed by **Ronove Technologies** (Seganaan) for Handyman Daige Properties.

## License

All rights reserved unless stated otherwise. Third-party libraries in `vendor/` keep their own licenses.
