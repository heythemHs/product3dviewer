{*
* Product 3D Viewer - Home Page Display
*
* @author    Claude AI
* @copyright 2025
* @license   AFL - Academic Free License (AFL 3.0)
*}

<div class="product3d-viewer-section">
    <div class="container">
        <div class="product3d-header">
            <h2 class="product3d-title">{$title|escape:'htmlall':'UTF-8'}</h2>
            {if $subtitle}
                <p class="product3d-subtitle">{$subtitle|escape:'htmlall':'UTF-8'}</p>
            {/if}
        </div>

        <div class="product3d-gallery">
            {* Example Product 1 *}
            <div class="product3d-item">
                <div class="product3d-viewer-wrapper">
                    <model-viewer
                        src="{$module_dir}models/product.glb"
                        alt="3D Product Model"
                        {if $auto_rotate}auto-rotate{/if}
                        {if $camera_controls}camera-controls{/if}
                        shadow-intensity="1"
                        loading="lazy"
                        class="product3d-model">
                        <div class="progress-bar hide" slot="progress-bar">
                            <div class="update-bar"></div>
                        </div>
                    </model-viewer>
                </div>
                <div class="product3d-info">
                    <h3>Product Model</h3>
                    <p>Explore this product in 3D</p>
                </div>
            </div>

            {* Example Product 2 *}
            <div class="product3d-item">
                <div class="product3d-viewer-wrapper">
                    <model-viewer
                        src="{$module_dir}models/product.glb"
                        alt="3D Product Model"
                        {if $auto_rotate}auto-rotate{/if}
                        {if $camera_controls}camera-controls{/if}
                        shadow-intensity="1"
                        loading="lazy"
                        class="product3d-model">
                        <div class="progress-bar hide" slot="progress-bar">
                            <div class="update-bar"></div>
                        </div>
                    </model-viewer>
                </div>
                <div class="product3d-info">
                    <h3>Product Model</h3>
                    <p>View this product from every angle</p>
                </div>
            </div>

            {* Example Product 3 *}
            <div class="product3d-item">
                <div class="product3d-viewer-wrapper">
                    <model-viewer
                        src="{$module_dir}models/product.glb"
                        alt="3D Product Model"
                        {if $auto_rotate}auto-rotate{/if}
                        {if $camera_controls}camera-controls{/if}
                        shadow-intensity="1"
                        loading="lazy"
                        class="product3d-model">
                        <div class="progress-bar hide" slot="progress-bar">
                            <div class="update-bar"></div>
                        </div>
                    </model-viewer>
                </div>
                <div class="product3d-info">
                    <h3>Product Model</h3>
                    <p>Interact with this product in 3D</p>
                </div>
            </div>
        </div>

        <div class="product3d-controls-info">
            <p><i class="material-icons">touch_app</i> Click and drag to rotate • Scroll to zoom • Right-click to pan</p>
        </div>
    </div>
</div>
