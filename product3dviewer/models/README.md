# 3D Models Directory

This directory contains 3D models that will be displayed by the Product 3D Viewer module.

## Quick Start

1. Place your GLB model files here
2. Add corresponding poster images (JPG/PNG)
3. Update the template file to reference your models

## File Naming Convention

- Model files: `product-name.glb`
- Poster images: `product-name-poster.jpg`

Example:
```
chair.glb
chair-poster.jpg
lamp.glb
lamp-poster.jpg
sofa.glb
sofa-poster.jpg
```

## Getting Sample Models

Since 3D models can be large, they are not included in the repository. You can:

### Option 1: Download Free Sample Models

Visit these sites for free GLB models:

- **Sketchfab**: [https://sketchfab.com/3d-models?features=downloadable&sort_by=-likeCount](https://sketchfab.com/3d-models?features=downloadable&sort_by=-likeCount)
  - Filter by "Downloadable" and choose GLB format
  - Look for furniture, products, or objects

- **Poly Pizza**: [https://poly.pizza/](https://poly.pizza/)
  - Free low-poly models
  - Direct GLB download

- **Google Poly Archive**: Available through third-party mirrors

### Option 2: Create Simple Placeholder Models

Create a simple test file structure:

```
models/
├── placeholder.glb       (Your downloaded model)
├── placeholder-poster.jpg (Screenshot or preview image)
```

### Option 3: Use Model Viewer Example Models

For testing, you can use Google's sample models:

```html
<!-- In your template, temporarily use: -->
src="https://modelviewer.dev/shared-assets/models/Astronaut.glb"
```

## Recommended Models for Testing

Here are some great free models for a furniture store:

1. **Chair**: Search "chair" on Sketchfab - download GLB
2. **Lamp**: Search "lamp" on Sketchfab - download GLB
3. **Sofa**: Search "sofa" on Sketchfab - download GLB

## After Downloading

1. Rename files to match template expectations:
   - `chair.glb`, `lamp.glb`, `sofa.glb`

2. Create poster images:
   - Take a screenshot of the model
   - Resize to 1024x1024 or 512x512
   - Save as JPG: `chair-poster.jpg`, etc.

3. Upload all files to this directory

## Need Help?

See the main MODELS.md file in the module root directory for detailed instructions on:
- Converting models to GLB format
- Optimizing model size
- Adding custom products
- Troubleshooting

## Security Note

This directory contains an `index.php` file to prevent directory listing for security purposes. Do not delete this file.
