# 3D Models Guide

This guide explains how to add and manage 3D models for your Product 3D Viewer module.

## Supported Formats

The module uses Google's Model Viewer, which supports:

- **GLB** (Binary glTF) - Recommended
- **GLTF** (JSON glTF with separate bin/textures)

## Model Requirements

### File Size
- Keep models under 10MB for optimal loading
- For larger models, consider using Draco compression

### Optimization Tips
1. **Reduce polygon count**: Aim for 50k-100k triangles for web viewing
2. **Compress textures**: Use 2048x2048 or smaller textures
3. **Use Draco compression**: Reduces file size by 90%
4. **Optimize materials**: Use PBR materials (Metallic-Roughness workflow)

## Where to Place Models

Place your 3D model files in:
```
product3dviewer/models/
```

## File Structure

```
product3dviewer/models/
├── chair.glb              # 3D model file
├── chair-poster.jpg       # Poster image (loading preview)
├── lamp.glb
├── lamp-poster.jpg
├── sofa.glb
└── sofa-poster.jpg
```

## How to Add a New Product

### Step 1: Prepare Your Model

1. Export your 3D model as GLB format from:
   - Blender: File > Export > glTF 2.0 (.glb/.gltf)
   - Maya: Use glTF export plugin
   - 3ds Max: Use Babylon.js exporter
   - SketchUp: Use glTF exporter extension

2. Optimize the model using:
   - [glTF Pipeline](https://github.com/CesiumGS/gltf-pipeline)
   - [glTF-Transform](https://gltf-transform.donmccurdy.com/)

### Step 2: Create a Poster Image

Create a poster image (preview while loading):

```bash
# Use any image editor to create a 1024x1024 preview
# Or take a screenshot of your model
```

### Step 3: Upload Files

1. Upload your `.glb` file to `product3dviewer/models/`
2. Upload your poster image to `product3dviewer/models/`

### Step 4: Update Template

Edit `views/templates/hook/product3dviewer.tpl`:

```smarty
<div class="product3d-item">
    <div class="product3d-viewer-wrapper">
        <model-viewer
            src="{$module_dir}models/your-model.glb"
            alt="3D Model Description"
            {if $auto_rotate}auto-rotate{/if}
            {if $camera_controls}camera-controls{/if}
            shadow-intensity="1"
            loading="lazy"
            poster="{$module_dir}models/your-model-poster.jpg"
            class="product3d-model">
            <div class="progress-bar hide" slot="progress-bar">
                <div class="update-bar"></div>
            </div>
        </model-viewer>
    </div>
    <div class="product3d-info">
        <h3>Your Product Name</h3>
        <p>Your product description</p>
    </div>
</div>
```

## Model Viewer Attributes

### Essential Attributes

- `src`: Path to your GLB file
- `alt`: Description for accessibility
- `poster`: Preview image shown while loading

### Optional Attributes

- `auto-rotate`: Automatically rotate the model
- `camera-controls`: Enable user interaction (zoom, rotate, pan)
- `shadow-intensity`: Control shadow darkness (0-1)
- `exposure`: Control lighting brightness (0-2)
- `camera-orbit`: Set initial camera position (e.g., "45deg 55deg 2.5m")
- `environment-image`: Use HDR environment for better lighting
- `ar`: Enable AR mode (for mobile devices)

## Example: Advanced Configuration

```html
<model-viewer
    src="{$module_dir}models/product.glb"
    alt="Premium Chair"
    poster="{$module_dir}models/product-poster.jpg"

    auto-rotate
    camera-controls

    shadow-intensity="1"
    shadow-softness="0.8"

    exposure="1"
    environment-image="neutral"

    camera-orbit="45deg 75deg 3m"
    min-camera-orbit="auto auto 1m"
    max-camera-orbit="auto auto 10m"

    ar
    ar-modes="webxr scene-viewer quick-look"

    loading="lazy">
</model-viewer>
```

## Where to Find Free 3D Models

- [Sketchfab](https://sketchfab.com/) - Downloadable GLB models
- [Poly Haven](https://polyhaven.com/) - Free CC0 models
- [Kenney](https://kenney.nl/assets) - Game assets
- [Free3D](https://free3d.com/) - Various formats
- [TurboSquid Free](https://www.turbosquid.com/Search/3D-Models/free) - Free models

## Troubleshooting

### Model Not Loading

1. Check file path is correct
2. Ensure file is actually GLB format
3. Check browser console for errors
4. Verify file permissions (should be readable by web server)

### Model Appears Black

- Add `environment-image="neutral"` attribute
- Check if model has proper materials
- Increase `exposure` value

### Model Too Small/Large

- Adjust `camera-orbit` attribute
- Set `min-camera-orbit` and `max-camera-orbit` for boundaries

### Poor Performance

- Reduce polygon count
- Compress textures
- Use Draco compression
- Enable `loading="lazy"` attribute

## Converting Models to GLB

### From FBX (using Blender):

```bash
# Install Blender, then:
1. File > Import > FBX (.fbx)
2. Select your model
3. File > Export > glTF 2.0 (.glb/.gltf)
4. Choose "GLB" format
5. Enable "Apply Modifiers" and "Export Selected"
6. Export
```

### From OBJ (using online converter):

1. Visit [https://products.aspose.app/3d/conversion/obj-to-glb](https://products.aspose.app/3d/conversion/obj-to-glb)
2. Upload your OBJ file
3. Convert to GLB
4. Download the result

## Best Practices

1. **Always test on mobile devices** - Performance varies
2. **Use poster images** - Improves perceived loading time
3. **Compress large models** - Use Draco or optimize geometry
4. **Set appropriate camera bounds** - Prevent users from zooming too far
5. **Consider lazy loading** - Don't load all models immediately
6. **Provide fallback content** - For browsers without WebGL support

## Resources

- [Model Viewer Documentation](https://modelviewer.dev/)
- [glTF 2.0 Specification](https://github.com/KhronosGroup/glTF)
- [Draco 3D Compression](https://google.github.io/draco/)
- [glTF Validator](https://github.khronos.org/glTF-Validator/)
