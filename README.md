# Product 3D Viewer for PrestaShop 8

A modern, interactive 3D product viewer module for PrestaShop 8 that allows customers to view products in stunning 3D directly on your store's front page and product pages.

![PrestaShop Version](https://img.shields.io/badge/PrestaShop-8.0+-brightgreen)
![License](https://img.shields.io/badge/License-AFL%203.0-blue)
![Version](https://img.shields.io/badge/Version-1.0.0-orange)

## Features

- **Interactive 3D Models**: Rotate, zoom, and pan product models
- **Auto-Rotation**: Optional automatic rotation for showcase
- **Mobile-Friendly**: Fully responsive design with touch controls
- **Lazy Loading**: Optimized loading for better performance
- **AR Support**: View products in Augmented Reality (AR) on compatible devices
- **Easy Configuration**: Simple admin panel for settings
- **Customizable**: Modify templates and styles to match your theme
- **Multiple Hooks**: Display on home page, product pages, or custom locations
- **Progress Indicators**: Loading bars for better user experience
- **Google Model Viewer**: Built on reliable, well-maintained technology

## Screenshots

### Front Page Display
The module displays an elegant 3D product showcase on your home page with a beautiful gradient background and interactive viewers.

### Product Page Integration
Add 3D models to individual product pages with AR support and advanced controls.

### Admin Configuration
Easy-to-use settings panel in your PrestaShop back office.

## Requirements

- PrestaShop 8.0 or higher
- PHP 7.2 or higher
- Modern web browser with WebGL support
- 3D models in GLB or GLTF format

## Installation

### Method 1: Manual Installation

1. **Download the module**
   ```bash
   git clone https://github.com/yourusername/product3dviewer.git
   ```

2. **Upload to PrestaShop**
   - Copy the `product3dviewer` folder to your PrestaShop installation:
     ```
     /path/to/prestashop/modules/product3dviewer/
     ```

3. **Install via Back Office**
   - Log in to PrestaShop admin panel
   - Go to `Modules` > `Module Manager`
   - Search for "Product 3D Viewer"
   - Click `Install`
   - Click `Configure` to access settings

### Method 2: ZIP Installation

1. Create a ZIP file of the `product3dviewer` folder
2. In PrestaShop admin, go to `Modules` > `Module Manager`
3. Click `Upload a module`
4. Select the ZIP file and upload
5. Install and configure

## Configuration

### Admin Settings

After installation, configure the module:

1. Go to `Modules` > `Module Manager`
2. Find "Product 3D Viewer" and click `Configure`
3. Available settings:

   - **Enable 3D Viewer**: Turn the module on/off
   - **Section Title**: Main heading for the 3D viewer section
   - **Section Subtitle**: Descriptive text below the title
   - **Auto Rotate**: Automatically rotate 3D models
   - **Camera Controls**: Allow users to control the camera

4. Click `Save` to apply changes

## Adding 3D Models

### Quick Start

1. **Prepare Your Models**
   - Export or convert to GLB format
   - Optimize for web (under 10MB recommended)

2. **Upload Models**
   - Place `.glb` files in: `product3dviewer/models/`
   - Add poster images: `product3dviewer/models/your-model-poster.jpg`

3. **Update Template**
   - Edit `views/templates/hook/product3dviewer.tpl`
   - Add your model references

### Detailed Instructions

See [MODELS.md](product3dviewer/MODELS.md) for comprehensive documentation on:
- Supported formats
- Model optimization
- Adding new products
- Best practices
- Free model resources

## Usage

### Home Page Display

The module automatically displays on the home page via the `displayHome` hook. The 3D viewer section shows multiple products in a grid layout.

### Product Page Display

The module displays on product pages via the `displayProductAdditionalInfo` hook, showing a single 3D model with AR support.

### Custom Placement

To display the 3D viewer in other locations, you can use PrestaShop hooks:

```php
{hook h='displayProductAdditionalInfo'}
```

Or create a custom hook in your theme template:

```smarty
{hook h='displayHome' mod='product3dviewer'}
```

## Customization

### Modifying Styles

Edit the CSS file to match your theme:
```
product3dviewer/views/css/product3dviewer.css
```

Colors, fonts, and layouts can be customized to fit your brand.

### Changing Templates

Modify template files to change structure:
- Home page: `views/templates/hook/product3dviewer.tpl`
- Product page: `views/templates/hook/product3d_single.tpl`

### Adding JavaScript Functions

Extend functionality in:
```
product3dviewer/views/js/product3dviewer.js
```

## Browser Compatibility

- Chrome 60+
- Firefox 55+
- Safari 11+
- Edge 79+
- Opera 47+
- iOS Safari 11+
- Chrome for Android 60+

## Performance Tips

1. **Optimize Models**: Keep under 10MB, use Draco compression
2. **Use Lazy Loading**: Models load only when visible
3. **Poster Images**: Provide preview images for faster perceived loading
4. **CDN Hosting**: Host large models on a CDN
5. **Compress Textures**: Use optimized image formats

## Troubleshooting

### Models Not Displaying

1. Check file paths in templates
2. Verify GLB files are in `product3dviewer/models/`
3. Check browser console for errors
4. Ensure WebGL is enabled in browser

### Performance Issues

1. Reduce model polygon count
2. Compress textures
3. Enable lazy loading
4. Use smaller model files

### Module Not Installing

1. Check PrestaShop version (8.0+)
2. Verify file permissions (755 for directories, 644 for files)
3. Check PHP error logs
4. Clear PrestaShop cache

## Development

### File Structure

```
product3dviewer/
├── config.xml                          # Module configuration
├── index.php                           # Security file
├── product3dviewer.php                 # Main module class
├── MODELS.md                           # 3D models guide
├── models/                             # 3D model files directory
│   ├── README.md                       # Models directory guide
│   ├── .gitkeep                        # Keep directory in git
│   └── index.php                       # Security file
├── translations/                       # Language files
│   └── index.php
└── views/
    ├── css/
    │   ├── product3dviewer.css         # Styles
    │   └── index.php
    ├── js/
    │   ├── product3dviewer.js          # JavaScript
    │   └── index.php
    └── templates/
        ├── admin/                      # Admin templates
        │   └── index.php
        └── hook/                       # Front-end templates
            ├── product3dviewer.tpl     # Home page template
            ├── product3d_single.tpl    # Product page template
            └── index.php
```

### Hooks Used

- `displayHome`: Shows 3D viewer on home page
- `displayHeader`: Loads CSS and JavaScript
- `displayProductAdditionalInfo`: Shows 3D viewer on product pages

### Adding New Hooks

Edit `product3dviewer.php` and add:

```php
public function hookYourHookName($params)
{
    // Your hook logic
    return $this->display(__FILE__, 'views/templates/hook/your-template.tpl');
}
```

## Technology Stack

- **Model Viewer**: Google's `<model-viewer>` web component
- **3D Format**: GLB/GLTF 2.0
- **JavaScript**: Vanilla ES6+
- **CSS**: Modern CSS3 with flexbox and grid
- **PrestaShop**: Module API for PS 8.0+

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Support

- **Documentation**: See [MODELS.md](product3dviewer/MODELS.md)
- **Issues**: Report bugs via GitHub Issues
- **Community**: Join PrestaShop forums

## Roadmap

- [ ] Dynamic product model assignment in admin
- [ ] Multiple model variants per product
- [ ] Animation support
- [ ] Environment customization
- [ ] Analytics integration
- [ ] Multi-store compatibility
- [ ] Product customization with 3D preview

## License

This module is licensed under the Academic Free License (AFL 3.0).

## Credits

- **Model Viewer**: [Google Model Viewer](https://modelviewer.dev/)
- **3D Format**: [Khronos glTF](https://www.khronos.org/gltf/)
- **PrestaShop**: [PrestaShop CMS](https://www.prestashop.com/)

## Author

Created with ❤️ for the PrestaShop community

## Version History

### 1.0.0 (2025-11-05)
- Initial release
- Home page 3D viewer display
- Product page integration
- Admin configuration panel
- Auto-rotation and camera controls
- Responsive design
- AR support
- Loading indicators

---

**Note**: This module requires 3D models in GLB format. Sample models are not included due to file size. See [models/README.md](product3dviewer/models/README.md) for instructions on obtaining free 3D models.
